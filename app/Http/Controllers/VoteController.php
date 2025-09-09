<?php

namespace App\Http\Controllers;

use App\Models\{
    WalletTransaction,
    User
};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Elliptic\EC;
use kornrunner\Keccak;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use GuzzleHttp\Client;
use Web3p\EthereumTx\Transaction;
use Web3p\EthereumUtil\Util;

class VoteController extends Controller
{
    
    public function index()
    {
        $user = Auth::user();
        $transactions = WalletTransaction::all();

        $balance = 0;

        if ($user->blockchain_address) {

            $network = env('SONIC_NETWORK', 'testnet');
            
            if($network == 'mainnet')
            {
                $rpcUrl = env('SONIC_MAINNET_RPC');
            }else{
                $rpcUrl = env('SONIC_TESTNET_RPC');
            }

            try {

                $client = new Client([
                    'verify' => false, // só para testes
                ]);

                $response = $client->post($rpcUrl, [
                    'headers' => [
                        'Content-Type' => 'application/json',
                        'Accept'       => 'application/json',
                    ],
                    'body' => json_encode([
                        "jsonrpc" => "2.0",
                        "method"  => "eth_getBalance",
                        "params"  => [$user->blockchain_address, "latest"],
                        "id"      => 1,
                    ]),
                ]);

                $body = $response->getBody()->getContents();
                $data = json_decode(trim($body), true);

                if (isset($data['result'])) {
                    $weiHex = $data['result'];            // "0x16345785d8a0000"
                    $weiDec = hexdec($weiHex);            // para valores pequenos funcionar
                    // para grandes números, usar BCMath:
                    $weiDec = gmp_strval(gmp_init($weiHex, 16), 10);

                    // converter Wei → Sonic (18 casas decimais)
                    $balance = bcdiv($weiDec, bcpow('10', '18'), 18);
                }
                
            } catch (\Exception $e) {
                Log::error('Erro ao consultar saldo: ' . $e->getMessage());
                $balance = 0;
            }

        }

        return view('wallet.index', [
            'user' => $user,
            'balance' => $balance,
            'transactions' => $transactions
        ]);
        
    }



    private function getNonce(string $address): string
    {

        $network = env('SONIC_NETWORK', 'testnet');
        
        if($network == 'mainnet')
        {
            $rpcUrl = env('SONIC_MAINNET_RPC');
        }else{
            $rpcUrl = env('SONIC_TESTNET_RPC');
        }

        $client = new Client([
            'verify' => false, // só para testes
        ]);

        $response = $client->post($rpcUrl, [
            'headers' => [
                'Content-Type' => 'application/json',
                'Accept'       => 'application/json',
            ],
            'body' => json_encode([
                "jsonrpc" => "2.0",
                "method"  => "eth_getTransactionCount",
                "params"  => [$address, 'pending'],
                "id"      => 1,
            ]),
        ]);

        $body = $response->getBody()->getContents();
        $data = json_decode(trim($body), true);
        $hex  = 0;

        if (isset($data['result'])) {
            $hex = $data['result'];
        }

        return hexdec($hex);

    }

    private function getGasPrice(): int
    {

        $network = env('SONIC_NETWORK', 'testnet');
        
        if($network == 'mainnet')
        {
            $rpcUrl = env('SONIC_MAINNET_RPC');
        }else{
            $rpcUrl = env('SONIC_TESTNET_RPC');
        }

        $client = new Client([
            'verify' => false, // só para testes
        ]);

        $response = $client->post($rpcUrl, [
            'headers' => [
                'Content-Type' => 'application/json',
                'Accept'       => 'application/json',
            ],
            'body' => json_encode([
                "jsonrpc" => "2.0",
                "method"  => "eth_gasPrice",
                "params"  => [],
                "id"      => 1,
            ]),
        ]);

        $body = $response->getBody()->getContents();
        $data = json_decode(trim($body), true);

        if (!isset($data['result'])) {
            throw new \Exception('Erro ao buscar gasPrice');
        }
        
        if (isset($data['result'])) {
            $weiHex = $data['result'];            // "0x16345785d8a0000"
            $weiDec = hexdec($weiHex);            // para valores pequenos funcionar
            // para grandes números, usar BCMath:
            $gas = gmp_strval(gmp_init($weiHex, 16), 10);
        }else{
             throw new \Exception('Erro ao buscar gasPrice');
        }

        return $gas;

    }

    private function buildTransaction(int $nonce, string $to, string $valueWei, string $data, string $gasPriceWei, string $gasLimitDec): Transaction
    {
        return new Transaction([
            'nonce'    => $nonce,                            // int
            'to'       => $to,
            'value'    => $this->toHex($valueWei),
            'data'     => $data,                             // 0x...
            'gas'      => $this->toHex($gasLimitDec),
            'gasPrice' => $this->toHex($gasPriceWei),
            'chainId'  => 14601,                             // Sonic testnet (ajuste se mainnet)
        ]);
    }

    private function sendTransaction(string $signedTx): string
    {

        $network = env('SONIC_NETWORK', 'testnet');
        
        if($network == 'mainnet')
        {
            $rpcUrl = env('SONIC_MAINNET_RPC');
        }else{
            $rpcUrl = env('SONIC_TESTNET_RPC');
        }

        $client = new Client([
            'verify' => false, // só para testes
        ]);

        $response = $client->post($rpcUrl, [
            'headers' => [
                'Content-Type' => 'application/json',
                'Accept'       => 'application/json',
            ],
            'body' => json_encode([
                "jsonrpc" => "2.0",
                "method"  => "eth_sendRawTransaction",
                "params"  => ['0x' . $signedTx],
                "id"      => 1,
            ]),
        ]);

        $body = $response->getBody()->getContents();
        $data = json_decode(trim($body), true);

        if (isset($data['error'])) {
            throw new \Exception("Erro ao enviar transação: " . $data['error']['message']);
        }

        if (!isset($data['result'])) {
            throw new \Exception("Resposta inválida do RPC ao enviar transação.");
        }

        return $data['result'];

    }

    public function refreshTransactions()
    {
        
        $pending = WalletTransaction::where('status', 'pending')->get();

        foreach ($pending as $tx) {
            $status = $this->checkTransactionStatus($tx->tx_hash);

            if ($status === 'success') {
                $tx->status = 'success';
            } elseif ($status === 'error') {
                $tx->status = 'error';
            }
            $tx->save();
        }

        return redirect()->route('wallet')->with('success', 'Transações atualizadas!');
    }

    private function checkTransactionStatus(string $txHash): string
    {
        $network = env('SONIC_NETWORK', 'testnet');
        
        if($network == 'mainnet')
        {
            $rpcUrl = env('SONIC_MAINNET_RPC');
        }else{
            $rpcUrl = env('SONIC_TESTNET_RPC');
        }

        $client = new Client([
            'verify' => false, // só para testes
        ]);

        $response = $client->post($rpcUrl, [
            'headers' => [
                'Content-Type' => 'application/json',
                'Accept'       => 'application/json',
            ],
            'body' => json_encode([
                "jsonrpc" => "2.0",
                "method"  => "eth_getTransactionReceipt",
                "params"  => [$txHash],
                "id"      => 1,
            ]),
        ]);

        $body = json_decode($response->getBody()->getContents(), true);

        if (isset($body['result']) && $body['result'] !== null) {
            return $body['result']['status'] === '0x1' ? 'success' : 'error';
        }

        return 'pending';
    }

    private function toHex(string $decimal): string
    {
        // decimal (string) -> 0xHEX (suporta big numbers)
        if ($decimal === '' || $decimal === '0') return '0x0';
        return '0x' . gmp_strval(gmp_init($decimal, 10), 16);
    }

    private function hexToDec(string $hex): string
    {
        // 0xHEX -> decimal string
        $hex = strtolower($hex ?? '0x0');
        if (strpos($hex, '0x') === 0) $hex = substr($hex, 2);
        if ($hex === '' ) return '0';
        return gmp_strval(gmp_init($hex, 16), 10);
    }

    private function weiToEth(string $wei, int $decimals = 18): string
    {
        // só para exibir: divide por 10^18
        return bcdiv($wei, bcpow('10', (string)$decimals), $decimals);
    }

    private function rpcUrl(): string ///remover
    {
        $network = env('SONIC_NETWORK', 'testnet');
        return $network === 'mainnet'
            ? env('SONIC_MAINNET_RPC')
            : env('SONIC_TESTNET_RPC');
    }

    private function rpcCall(string $method, array $params = [])///remover
    {
        $client = new Client(['verify' => false]); // só dev
        $res = $client->post($this->rpcUrl(), [
            'headers' => ['Content-Type' => 'application/json', 'Accept' => 'application/json'],
            'body' => json_encode([
                'jsonrpc' => '2.0',
                'method'  => $method,
                'params'  => $params,
                'id'      => 1,
            ]),
        ]);

        $body = json_decode($res->getBody()->getContents(), true);
        if (isset($body['error'])) {
            throw new \Exception($body['error']['message']);
        }
        return $body['result'] ?? null;
    }

    private function estimateGas(string $from, string $to, string $data, string $valueWei = '0'): string
    {
        $params = [[
            'from'  => $from,
            'to'    => $to,
            'data'  => $data,
            'value' => $this->toHex($valueWei),
        ], 'latest'];

        try {
            $hex = $this->rpcCall('eth_estimateGas', $params);

            \Log::debug('eth_estimateGas result', [
                'params' => $params,
                'hex'    => $hex,
            ]);

            if (!$hex) {
                throw new \Exception('estimateGas sem retorno');
            }

            return $this->hexToDec($hex);

        } catch (\Throwable $e) {
            \Log::error('Erro no estimateGas', [
                'msg' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            // opcional: repropaga exceção ou retorna default
            throw $e;
        }
    }

    private function methodSelector(string $signature): string
    {
        // use o util do web3p pra evitar dependência extra
        $util = new Util();
        $hash = $util->sha3($signature);          // ex: 'submitVote(string,string)'
        return '0x' . substr($hash, 0, 8);
    }

    private function pad32(string $hexNoPrefix): string
    {
        return str_pad($hexNoPrefix, 64, '0', STR_PAD_LEFT);
    }

    private function encodeStringArg(string $s): string
    {
        // codifica string como: [len(32b)] [data right-padded para múltiplo de 32]
        $bytes   = bin2hex($s);                    // sem 0x
        $len     = (int) (strlen($bytes) / 2);     // bytes
        $lenHex  = $this->pad32(dechex($len));

        // pad para múltiplo de 32 bytes
        $mod       = $len % 32;
        $padBytes  = $mod === 0 ? 0 : (32 - $mod);
        $paddedHex = $bytes . str_repeat('0', $padBytes * 2);

        return $lenHex . $paddedHex;              // retorna só o "tail" do arg dinâmico
    }

    private function encodeSubmitVote(string $projectName, string $voteFor): string
    {
        // function submitVote(string,string)
        $selector = $this->methodSelector('submitVote(string,string)'); // 0x....

        $arg1Tail = $this->encodeStringArg($projectName);               // len+data padded
        $arg2Tail = $this->encodeStringArg($voteFor);

        $headSizeBytes = 32 * 2;                // 2 args dinâmicos => 64 bytes => 0x40
        $offset1       = $this->pad32(dechex($headSizeBytes)); // 0x40

        $arg1TailBytes = strlen($arg1Tail) / 2; // já inclui len(32) + dados padded
        $offset2       = $this->pad32(dechex($headSizeBytes + $arg1TailBytes));

        // Monta data: selector + head(2*32) + tail1 + tail2
        $dataNo0x = substr($selector, 2)
                . $offset1
                . $offset2
                . $arg1Tail
                . $arg2Tail;

        return '0x' . $dataNo0x;
    }

    private function encodeVoteCostCall(): string
    {
        // function VOTE_COST() view returns (uint256)
        return $this->methodSelector('VOTE_COST()'); // só selector
    }

    private function callVoteCost(string $contract): string
    {
        $data = $this->encodeVoteCostCall(); // 0x...
        $res = $this->rpcCall('eth_call', [[
            'to'   => $contract,
            'data' => $data
        ], 'latest']);

        // retorno é uint256 codificado: 32 bytes (0x...).
        return $this->hexToDec($res ?? '0x0'); // decimal string (wei)
    }

    // === AÇÃO: enviar voto no backend ===
    public function submitVoteBackend(Request $request)
    {

        $user = Auth::user();

        if (!$user->blockchain_address || !$user->private_key) {
            return back()->withErrors('Carteira não configurada.');
        }

        $contract = '0xb5022A7D7F5c2a7862b0C63FFfe01b2Ed6EAEfdf'; // seu contrato

        try {

            // 1) custo do voto (wei)
            $voteCostWei = $this->callVoteCost($contract);

            // 2) dados (ABI) do submitVote(string,string)
            $data = $this->encodeSubmitVote(
                $request->project_name,
                $request->vote_for
            );

            // 3) nonce / gasPrice / estimateGas
            $nonce       = $this->getNonce($user->blockchain_address);
            $gasPriceWei = $this->getGasPrice();

            //dd($user->blockchain_address, $contract, $data, $voteCostWei);
            
            $gasLimitDec = $this->estimateGas($user->blockchain_address, $contract, $data, $voteCostWei);

            // 4) monta e assina
            $tx = $this->buildTransaction(
                $nonce,
                $contract,
                $voteCostWei,   // payable value
                $data,
                $gasPriceWei,
                $gasLimitDec
            );

            $privateKey = decrypt($user->private_key);          // sem 0x
            $signed     = $tx->sign(ltrim($privateKey, '0x'));  // assina
            $txHash     = $this->sendTransaction($signed);      // envia

            // 5) log no banco
            WalletTransaction::create([
                'user_id'    => $user->id,
                'to_address' => $contract,
                'amount'     => $this->weiToEth($voteCostWei), // só para exibir
                'tx_hash'    => $txHash,
                'status'     => 'pending',
            ]);

            return view('sucesso_voto', [
                'contract' => $contract,
                'address'  => $user->blockchain_address,
                'txHash'   => $txHash,
                'project_name'  => $request->project_name,
                'vote_for'      => $request->vote_for
            ]);

        } catch (\Exception $e) {
            Log::error('Falha no voto: ' . $e->getMessage());
            return back()->withErrors('Falha ao enviar voto: ' . $e->getMessage());
        }
    }


}
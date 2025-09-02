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

class WalletController extends Controller
{
    
    public function index()
    {
        $user = Auth::user();
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
            'balance' => $balance
        ]);
        
    }

    public function store(Request $request)
    {

        /** @var User $user */
        $user = Auth::user(); // pega usuário logado

        // gera par de chaves usando curva secp256k1
        $ec = new EC('secp256k1');
        $keyPair = $ec->genKeyPair();

        $privateKey = $keyPair->getPrivate('hex');

        // chave pública completa
        $publicKey = $keyPair->getPublic(false, 'hex');
        $publicKey = substr($publicKey, 2); // remove prefixo 0x04

        // gera endereço Ethereum
        $hash = Keccak::hash(hex2bin($publicKey), 256);
        $address = '0x' . substr($hash, 24);

        // salva no banco de forma segura
        $user->blockchain_address = $address;
        $user->private_key = encrypt($privateKey); // nunca salve em texto puro
        $user->save();

        return response()->json([
            'message' => 'Wallet gerada com sucesso!',
            'address' => $address,
        ]);
    }

    public function transfer(Request $request)
    {
        $request->validate([
            'to_address' => 'required|string|starts_with:0x|size:42',
            'amount' => 'required|numeric|min:0.000000000000000001',
            'password' => 'required|string',
        ]);

        $user = Auth::user();

        // confirma senha do Laravel
        if (!Hash::check($request->password, $user->password)) {
            return back()->withErrors('Senha incorreta.')->withInput();
        }

        if (!$user->blockchain_address || !$user->private_key) {
            return back()->withErrors('Carteira não configurada.');
        }

        // try {
            

            $nonce      = $this->getNonce($user->blockchain_address);            
            $gasPrice   = $this->getGasPrice();
            $value      = (int)bcmul($request->amount, bcpow('10', '18')); // Wei
            $tx         = $this->buildTransaction($nonce, $request->to_address, $value, $gasPrice);
            
            $signedTx = $tx->sign(decrypt($user->private_key));

            $txHash = $this->sendTransaction($signedTx);

            if ($txHash) {
                WalletTransaction::create([
                    'user_id'    => $user->id,
                    'to_address' => $request->to_address,
                    'amount'     => $request->amount,
                    'tx_hash'    => $txHash,
                    'status'     => 'pending',
                ]);
            }
            
            return redirect()->route('wallet')->with('success', "Transação enviada! Hash: $txHash");

        // } catch (\Exception $e) {
        //     Log::error("Erro na transferência: " . $e->getMessage());
        //     return back()->withErrors("Erro: " . $e->getMessage());
        // }
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

    private function buildTransaction(int $nonce, string $to, int $amount, int $gasPrice): Transaction
    {

        return new Transaction([
            'nonce' => $nonce,
            'to' => $to,
            'value' => '0x' . dechex($amount),
            'gas' => '0x5208', // 21000 gas
            'gasPrice' => '0x' . dechex($gasPrice),
            'chainId'  => 14601,
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

}
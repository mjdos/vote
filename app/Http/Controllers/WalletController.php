<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Elliptic\EC;
use kornrunner\Keccak;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

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

                $response = Http::post($rpcUrl, [
                    "jsonrpc" => "2.0",
                    "method" => "eth_getBalance",
                    "params" => [$user->blockchain_address, "latest"],
                    "id" => 1
                ]);

              
                if ($response->ok() && isset($response['result'])) {
                    // resultado vem em hexadecimal (Wei)
                    $weiHex = $response['result'];
                    $weiDec = hexdec($weiHex);

                    // converte Wei → Sonic (18 casas decimais)
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

}
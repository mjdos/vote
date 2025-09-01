<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Elliptic\EC;
use kornrunner\Keccak;
use Web3\Web3;
use Web3\Providers\HttpProvider;
use Web3\RequestManagers\HttpRequestManager;
use Illuminate\Support\Facades\Log;

class WalletController extends Controller
{

    public function index()
    {
        $user = Auth::user();

        if ($user->blockchain_address) {

            $network = env('SONIC_NETWORK', 'testnet');
            
            if($network == 'mainnet')
            {
                $rpcUrl = env('SONIC_MAINNET_RPC');
            }else{
                $rpcUrl = env('SONIC_TESTNET_RPC');
            }

            $web3 = new Web3(new HttpProvider(new HttpRequestManager($rpcUrl, 10)));

            $balance = 0;

            $web3->eth->getBalance($user->blockchain_address, function ($err, $data) use (&$balance) {
                if ($err !== null) {

                    Log::error('Erro ao consultar saldo: ' . $err->getMessage());
                    $balance = 0;
                    return;
                }

                // saldo vem em Wei (1 ETH = 10^18 Wei)
                $balance = $data ? (int) $data->toString() : 0;
            });

            /*
                return response()->json([
                    'address' => $user->blockchain_address,
                    'balance_wei' => $balance,
                    'balance_eth' => $balance > 0 ? $balance / 1e18 : 0,
                    'network' => $network,
                ]);
            */
        
        }else{

            $balance = 0;

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
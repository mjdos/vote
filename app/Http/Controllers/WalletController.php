<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Elliptic\EC;
use kornrunner\Keccak;

class WalletController extends Controller
{

    public function index()
    {
        $user = Auth::user();
        return view('wallet.index', [
            'user' => $user,
        ]);
    }

    public function store(Request $request)
    {
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

## Projeto Vote

Projeto feito em Laravel para votação usando blockchain.


$ composer update

$ php artisan migrate

$ php artisan key:generate

$ composer require laravel/breeze --dev

$ php artisan breeze:install blade

### WEB3
$ composer require web3p/web3.php


### .ENV
'locale' => 'pt_BR',            // idioma padrão
'fallback_locale' => 'en',      // se faltar tradução em pt_BR, usa inglês
'faker_locale' => 'pt_BR',      // opcional: seeds/factory em pt-BR
'timezone' => 'America/Sao_Paulo', // opcional


### Dependências para blockchain
composer require web3p/ethereum-util
composer require kornrunner/secp256k1
composer require kornrunner/keccak
composer require web3p/ethereum-tx

### Ligar extensão
ext-gmp

### Ajustar o .env
SONIC_NETWORK=testnet
SONIC_MAINNET_RPC=https://rpc.soniclabs.com
SONIC_TESTNET_RPC=https://rpc.testnet.soniclabs.com

<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
require 'vendor/autoload.php';
use Web3\Web3;
use Web3\Contract;
use Web3\Providers\HttpProvider;
use Web3\RequestManagers\HttpRequestManager;


//isso aqui o infura server como um no da blockchain etherum
$web3 = new Web3('https://goerli.infura.io/v3/2ed5a6862d094462b80099336832982f');
$eth = $web3->eth;
$address = '0x39D1275cd84F8dA04808D0d9F6EbbB1e804B54fd'; // Your account address goes here

$eth->getBalance($address, function ($err, $balance) {
    if ($err !== null) {
        echo 'Error: ' . $err->getMessage();
        return;
    }
    echo 'Balance: ' . $balance . PHP_EOL;
});

 $abi = '[
            {
                "inputs": [
                    {
                        "internalType": "uint256",
                        "name": "ad",
                        "type": "uint256"
                    },
                    {
                        "internalType": "string",
                        "name": "assunto2",
                        "type": "string"
                    },
                    {
                        "internalType": "string",
                        "name": "tipo",
                        "type": "string"
                    },
                    {
                        "internalType": "string",
                        "name": "assunto",
                        "type": "string"
                    },
                    {
                        "internalType": "string",
                        "name": "nome",
                        "type": "string"
                    },
                    {
                        "internalType": "string",
                        "name": "cpf",
                        "type": "string"
                    },
                    {
                        "internalType": "string",
                        "name": "dataEvento",
                        "type": "string"
                    },
                    {
                        "internalType": "string",
                        "name": "infoAdicional",
                        "type": "string"
                    },
                    {
                        "internalType": "string",
                        "name": "dataInicio",
                        "type": "string"
                    },
                    {
                        "internalType": "string",
                        "name": "dataFim",
                        "type": "string"
                    },
                    {
                        "internalType": "string",
                        "name": "assinatura",
                        "type": "string"
                    }
                ],
                "name": "adding_values",
                "outputs": [],
                "stateMutability": "nonpayable",
                "type": "function"
            },
            {
                "inputs": [
                    {
                        "internalType": "uint256",
                        "name": "adr",
                        "type": "uint256"
                    }
                ],
                "name": "getRegistro",
                "outputs": [
                    {
                        "components": [
                            {
                                "internalType": "string",
                                "name": "tipo",
                                "type": "string"
                            },
                            {
                                "internalType": "string",
                                "name": "assunto",
                                "type": "string"
                            },
                            {
                                "internalType": "string",
                                "name": "assunto2",
                                "type": "string"
                            },
                            {
                                "internalType": "string",
                                "name": "infoAdicional",
                                "type": "string"
                            },
                            {
                                "internalType": "string",
                                "name": "nome",
                                "type": "string"
                            },
                            {
                                "internalType": "string",
                                "name": "cpf",
                                "type": "string"
                            },
                            {
                                "internalType": "string",
                                "name": "dataEvento",
                                "type": "string"
                            },
                            {
                                "internalType": "string",
                                "name": "dataInicio",
                                "type": "string"
                            },
                            {
                                "internalType": "string",
                                "name": "dataFim",
                                "type": "string"
                            },
                            {
                                "internalType": "string",
                                "name": "assinatura",
                                "type": "string"
                            },
                            {
                                "internalType": "uint8",
                                "name": "marks",
                                "type": "uint8"
                            }
                        ],
                        "internalType": "struct ValidacaoDocumentos.Documento",
                        "name": "",
                        "type": "tuple"
                    }
                ],
                "stateMutability": "view",
                "type": "function"
            },
            {
                "inputs": [
                    {
                        "internalType": "uint256",
                        "name": "",
                        "type": "uint256"
                    }
                ],
                "name": "registros",
                "outputs": [
                    {
                        "internalType": "uint256",
                        "name": "",
                        "type": "uint256"
                    }
                ],
                "stateMutability": "view",
                "type": "function"
            },
            {
                "inputs": [
                    {
                        "internalType": "uint256",
                        "name": "",
                        "type": "uint256"
                    }
                ],
                "name": "validacaoDocumento",
                "outputs": [
                    {
                        "internalType": "string",
                        "name": "tipo",
                        "type": "string"
                    },
                    {
                        "internalType": "string",
                        "name": "assunto",
                        "type": "string"
                    },
                    {
                        "internalType": "string",
                        "name": "assunto2",
                        "type": "string"
                    },
                    {
                        "internalType": "string",
                        "name": "infoAdicional",
                        "type": "string"
                    },
                    {
                        "internalType": "string",
                        "name": "nome",
                        "type": "string"
                    },
                    {
                        "internalType": "string",
                        "name": "cpf",
                        "type": "string"
                    },
                    {
                        "internalType": "string",
                        "name": "dataEvento",
                        "type": "string"
                    },
                    {
                        "internalType": "string",
                        "name": "dataInicio",
                        "type": "string"
                    },
                    {
                        "internalType": "string",
                        "name": "dataFim",
                        "type": "string"
                    },
                    {
                        "internalType": "string",
                        "name": "assinatura",
                        "type": "string"
                    },
                    {
                        "internalType": "uint8",
                        "name": "marks",
                        "type": "uint8"
                    }
                ],
                "stateMutability": "view",
                "type": "function"
            }
        ]';
        $ContratoAddress = '0x638Fcc9619c491aebf567899Ef8FeCA503da24e1';
        //   const contract = web3.eth.Contract(abi).at(address);

$contract = new Contract($web3->provider, $abi);
  $ad = get('ad');
         $assunto2 = '';
         $tipo = '';
         $assunto = '';
         $nome = '';
         $cpf = '';
         $dataEvento = '';
         $infoAdicional = '';
         $dataInicio = '';
         $dataFim = '';
         $assinatura = '';
echo ('Contrato aqui em baixo');
print_r($contract);
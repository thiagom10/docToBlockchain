<?php
/**
 * This file is part of simple-web3-php package.
 *
 * (c) Alex Cabrera
 *
 * @author Alex Cabrera
 * @license MIT
 */

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');


//[INFURA START] DEFINE ONLY IF YOU ARE USING INFURA
//in case you are using infura, you can set these values (or *)
define('INFURA_PROJECT_ID', '2ed5a6862d094462b80099336832982f');
define('INFURA_PROJECT_SECRET', '55340658289c446d926dfcd2c7612ba8');
define('ETHEREUM_NET_NAME', 'sepolia'); //ropsten , mainnet
//[INFURA END]

//REAL endpoint, this is what is really used internally
define('ETHEREUM_NET_ENDPOINT', 'https://'.ETHEREUM_NET_NAME.'.infura.io/v3/'.INFURA_PROJECT_ID);


define('SWP_Contract_Address','0xF387cb3f1869D78564b5869A3f93a14D78D37bf2');


$SWP_Contract_ABI = '[
	{
		"inputs": [
			{
				"internalType": "string",
				"name": "_tipoDocumento",
				"type": "string"
			},
			{
				"internalType": "uint256",
				"name": "_codTipo",
				"type": "uint256"
			},
			{
				"internalType": "string",
				"name": "_nomePessoa",
				"type": "string"
			},
			{
				"internalType": "string",
				"name": "_dados",
				"type": "string"
			},
			{
				"internalType": "uint256",
				"name": "_validade",
				"type": "uint256"
			}
		],
		"name": "addDados",
		"outputs": [],
		"stateMutability": "nonpayable",
		"type": "function"
	},
	{
		"inputs": [],
		"stateMutability": "nonpayable",
		"type": "constructor"
	},
	{
		"anonymous": false,
		"inputs": [
			{
				"indexed": true,
				"internalType": "address",
				"name": "oldOwner",
				"type": "address"
			},
			{
				"indexed": true,
				"internalType": "address",
				"name": "newOwner",
				"type": "address"
			}
		],
		"name": "OwnerSet",
		"type": "event"
	},
	{
		"anonymous": false,
		"inputs": [
			{
				"indexed": true,
				"internalType": "uint256",
				"name": "_memberId",
				"type": "uint256"
			}
		],
		"name": "savingsEvent",
		"type": "event"
	},
	{
		"inputs": [
			{
				"internalType": "uint256",
				"name": "",
				"type": "uint256"
			}
		],
		"name": "documentos",
		"outputs": [
			{
				"internalType": "uint256",
				"name": "id",
				"type": "uint256"
			},
			{
				"internalType": "uint256",
				"name": "codTipo",
				"type": "uint256"
			},
			{
				"internalType": "string",
				"name": "tipoDocumento",
				"type": "string"
			},
			{
				"internalType": "string",
				"name": "nomePessoa",
				"type": "string"
			},
			{
				"internalType": "string",
				"name": "dados",
				"type": "string"
			},
			{
				"internalType": "uint256",
				"name": "validade",
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
				"name": "_memberId",
				"type": "uint256"
			}
		],
		"name": "get",
		"outputs": [
			{
				"components": [
					{
						"internalType": "uint256",
						"name": "id",
						"type": "uint256"
					},
					{
						"internalType": "uint256",
						"name": "codTipo",
						"type": "uint256"
					},
					{
						"internalType": "string",
						"name": "tipoDocumento",
						"type": "string"
					},
					{
						"internalType": "string",
						"name": "nomePessoa",
						"type": "string"
					},
					{
						"internalType": "string",
						"name": "dados",
						"type": "string"
					},
					{
						"internalType": "uint256",
						"name": "validade",
						"type": "uint256"
					}
				],
				"internalType": "struct StorageDocs.Documento",
				"name": "",
				"type": "tuple"
			}
		],
		"stateMutability": "view",
		"type": "function"
	},
	{
		"inputs": [],
		"name": "getDados",
		"outputs": [
			{
				"internalType": "uint256[]",
				"name": "",
				"type": "uint256[]"
			},
			{
				"internalType": "string[]",
				"name": "",
				"type": "string[]"
			},
			{
				"internalType": "string[]",
				"name": "",
				"type": "string[]"
			},
			{
				"internalType": "string[]",
				"name": "",
				"type": "string[]"
			}
		],
		"stateMutability": "view",
		"type": "function"
	},
	{
		"inputs": [],
		"name": "getLastId",
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
		"inputs": [],
		"name": "getMembers",
		"outputs": [
			{
				"components": [
					{
						"internalType": "uint256",
						"name": "id",
						"type": "uint256"
					},
					{
						"internalType": "uint256",
						"name": "codTipo",
						"type": "uint256"
					},
					{
						"internalType": "string",
						"name": "tipoDocumento",
						"type": "string"
					},
					{
						"internalType": "string",
						"name": "nomePessoa",
						"type": "string"
					},
					{
						"internalType": "string",
						"name": "dados",
						"type": "string"
					},
					{
						"internalType": "uint256",
						"name": "validade",
						"type": "uint256"
					}
				],
				"internalType": "struct StorageDocs.Documento[]",
				"name": "",
				"type": "tuple[]"
			}
		],
		"stateMutability": "view",
		"type": "function"
	},
	{
		"inputs": [],
		"name": "memberCount",
		"outputs": [
			{
				"internalType": "uint256",
				"name": "",
				"type": "uint256"
			}
		],
		"stateMutability": "view",
		"type": "function"
	}
]';

define('SWP_Contract_ABI', $SWP_Contract_ABI);


//SIGNING
define('SWP_ADDRESS', '0x39D1275cd84F8dA04808D0d9F6EbbB1e804B54fd');
define('SWP_PRIVATE_KEY', 'db241027cc55b89e0cc99be3054a51b6111d30cbe63af4aaf55f9835eddad0ea');
<?php
include_once("vendor/autoload.php");
include_once("config.php");


// Report simple running errors
error_reporting(E_ERROR );

//Carregando a biblioteca Sweb3,
use SWeb3\SWeb3;
$sweb3 = new SWeb3(ETHEREUM_NET_ENDPOINT);

//Atribuindo informações às variaveis

//Endereço da carteira
$from_address = '0x39D1275cd84F8dA04808D0d9F6EbbB1e804B54fd';
//Chave privada relativa a carteira
$from_address_private_key = 'db241027cc55b89e0cc99be3054a51b6111d30cbe63af4aaf55f9835eddad0ea';
$sweb3->setPersonalData($from_address, $from_address_private_key);
$sweb3->chainId = '11155111 ';//Sepolia
$res = $sweb3->call('eth_blockNumber', []);


//echo'<pre>';print_r($res);echo'</pre>';

use SWeb3\SWeb3_Contract;



$datetime = new DateTime(date('Y-m-d H:i:s'));
$dados='{ "tipoDocumento": "'.$_GET['tipoDocumento'].'",
  "numeroDocumento": "'.substr($_GET['cpf'],0,3).'.###.###-'.substr($_GET['cpf'],9,2).'",
  "curso": "'.$_GET['curso'].'",
  "tipoAcervo": "Comprovante de Matricula",
  "matricula":"'.$_GET['matricula'].'"}';

$timestamp= $datetime->format('U');
//Inicializando a instancia do contrato
$contract = new SWeb3_contract($sweb3, SWP_Contract_Address, $SWP_Contract_ABI); //'0x2222...' is contract address

//pegando o ultimo id
$res = $contract->call('getLastId');
//echo 'Last id aqui:';
//echo'<pre>';print_r($res);echo'</pre>';
//echo 'NOme aqui:' .$_GET['nome'];

//get the nonce
 $extra_data = ['nonce' => $sweb3->personal->getNonce()];

 $sn = explode(" ",$_GET['nome']);
 $y=count($sn)-1;
 for($h=0;$h<=$y;$h++){
     $nc.=strtoupper($sn[$h]{0});
   //  echo 'NC aqui'.$nc;
 }
// echo 'NC aqui: '.$nc.'<br>';
 //Chamando a função do contrato inteligente
$res = $contract->send('addDados',['Comprovante de Matricula','1',$nc,$dados,$timestamp],$extra_data);

//echo'<pre>';print_r($extra_data);echo'</pre>';
echo ($res->result);



<?php
/**
 * This file is part of simple-web3-php package.
 *
 * (c) Alex Cabrera
 *
 * @author Alex Cabrera
 * @license MIT
 */

namespace SWeb3;

//ini_set('display_errors', '1');
//ini_set('display_startup_errors', '1');

include_once("../vendor/autoload.php");
include_once("config.php");

use stdClass;
use SWeb3\SWeb3;
use SWeb3\SWeb3_Contract;
use phpseclib\Math\BigInteger as BigNumber;

//IMPORTANT
//Remember that this is an example showing how to execute the common features of calling / getting state from the ethereum rpc api
//This code does not represent a clean / efficient / performant aproach to implement them in a production environment


$extra_curl_params = [];
//INFURA ONLY: Prepare extra curl params, to add infura private key to the request
$extra_curl_params[CURLOPT_USERPWD] = ':'.INFURA_PROJECT_SECRET;

//initialize SWeb3 main object
$sweb3 = new SWeb3(ETHEREUM_NET_ENDPOINT, $extra_curl_params);

//we are not sending signed transactions here, so we don't need to set a private key
$sweb3->setPersonalData(SWP_ADDRESS, SWP_PRIVATE_KEY);

//general ethereum block information
//$res = $sweb3->call('eth_blockNumber', []);
//PrintCallResult('eth_blockNumber', $res);

//CONTRACT

//initialize contract from address and ABI string
$contract = new SWeb3_contract($sweb3, SWP_Contract_Address, SWP_Contract_ABI);

////GETTERS - direct public variables

//$res = $contract->call('public_uint');
//PrintCallResult('public_uint', $res);
//
//$res = $contract->call('public_int');
//PrintCallResult('public_int', $res);
//
//$res = $contract->call('public_string');
//PrintCallResult('public_string', $res);
//
//
////GETTERS
//
////returns tuple[]
//$res = $contract->call('GetAllTuples_B');
//PrintCallResult('GetAllTuples_B', $res);
//
////input uint
////returns tuple
//$res = $contract->call('GetTuple_A', [3]);
//PrintCallResult('GetTuple_A', $res);
//
////input tuple
////returns boo
///
$sweb3->setPersonalData(SWP_ADDRESS, SWP_PRIVATE_KEY);

//enable batching

if($_GET['add']=='ok') {

    $send_data = [];
    $send_data['_tipoDocumento'] = "Declaracao3";
    $send_data['_id'] = 0;
    $send_data['_nomePessoa'] = "Nome da Pessoa aqui3";
    $send_data['_dados'] = 'Dados aqui3';


    $extra_data = ['nonce' => $sweb3->personal->getNonce()];
    $result = $contract->send('addMember', $send_data, $extra_data);
    echo '<pre>';
    print_r($result);
    echo '</pre>';
}
//enable batching
$sweb3->batch(true);

//we need the nonce for signing the send eth transaction
$sweb3->call('eth_gasPrice');
$sweb3->call('eth_getTransactionCount', [$sweb3->personal->address, 'pending']);
$res = $sweb3->executeBatch();
PrintCallResult('Gas price & nonce:', $res);
$sweb3->batch(false);
//$callData = [new stdClass()];
//////tuple(uint256, string, string[])
//$callData[0]->string_tipo = 'Tipo de documento 4';
//$callData[0]->uint_b = 4;
//$callData[0]->string_nome = "Thiago Marques 4";
//$callData[0]->string_nome = "Dados do thiago Marques 4";
//
//$res = $contract->send('addMember', $callData,$extra_data);
////PrintCallResult('Adicionado: ', $res);


//
////input string[]
////returns tuple[]
//$res = $contract->call('GetTuples_B', [['text1', 'text2']]); // *info_bit*
//PrintCallResult('GetTuples_B', $res);
//
//// *info_bit*
////ideally all $callData in $contract->call should be wrapped in an array.
////However we added some "security" to add the wrapping array before encoding the data
//
////input string[][]
////returns tuple[][]
//$res = $contract->call('Mirror_StringArray', [['text1', 'text22'], ['text333', 'text4444'], ['text55555', 'text666666']]);
//PrintCallResult('Mirror_StringArray', $res);
//
//
//EVENTS

//$res = $contract->call('getMembers');
//echo '<pre>';
//print_r($res);
//echo '</pre>';

$res = $contract->getLogs();
echo '<br><br><b>Logs: </b>';
echo '<pre>';
print_r($res);
echo '</pre>';

//general ethereum block information
$res = $sweb3->call('eth_blockNumber', []);
PrintCallResult('eth_blockNumber', $res);

//EXIT
exit(0);



function PrintCallResult($callName, $result)
{
    echo "<br/> Call -> <b>". $callName . "</b><br/>";

    echo "Result -> " . PrintObject($result) . "<br/>";
}


function PrintObject($x)
{
    if ($x instanceof BigNumber)
    {
        return $x . '';
    }

    if (is_object($x)) {
        $x = (array)($x);
    }

    if (is_array($x))
    {
        $text = "[";
        $first = true;
        foreach($x as $key => $value)
        {
            if ($first)  	$first = false;
            else 			$text .= ", ";

            $text .= $key . " : " . PrintObject($value);
        }

        return $text . "]";
    }

    return $x . '';
}
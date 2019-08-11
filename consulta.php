<?php
/**
 * URL interna para consultas de status.
*/
require_once 'config.php';
require_once 'functions.php';

$merchantOrderNumber = 1234; // Dado informado pelo cliente no ato da consulta
//$merchantOrderNumber = $_GET['id_pedido'];

$cabecalhos = array('Cache-Control: no-cache', 'Content-Type: application/json', 'MerchantId: ' . MID);

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, ENDPOINT.'/'.MID.'/'.$merchantOrderNumber);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
curl_setopt($ch, CURLOPT_HTTPHEADER, $cabecalhos);

$response = curl_exec($ch);
curl_close($ch);

$response = json_decode($response);

if(is_array($response)){
    $response = $response[0];
}

/*
RETORNO:
order_number: 1234
amount: 10000
checkout_cielo_order_number: 4a4a566f32d344268fbc1aab3b634f5b
created_date: 07/08/2019 19:00:45
customer_name: FULANO DE TAL
customer_phone: 88888888888
customer_identity: 11111111111
customer_email: aaa@gmail.com
shipping_type: 5
shipping_price: 0
payment_method_type: 1
payment_method_brand: 2
payment_maskedcreditcard: 123456******7890
payment_installments: 1
payment_status: 3
tid: 070820191900463664
test_transaction: True
 */
if (isset($response->Message)) {
    print 'Erro ao conectar com a Cielo: '.$response->Message;
} else {
    if (!empty($response->order_number)) {
        $cielo_order = $response->checkout_cielo_order_number;
        $id_pedido   = $response->order_number;
        $pay_status  = status($response->payment_status);
        $forma_pagamento = pagamento($response->payment_method_type);
        $bandeira_pagamento = bandeira($response->payment_method_brand);
        $quantidade_parcelas = $response->payment_installments;
        
        // Rotinas para persistência em banco de dados e envio de emails ao usuário

        // ao fim, responde o OK para o serviço de notificação finalizar
        echo 'OK';
    }
}
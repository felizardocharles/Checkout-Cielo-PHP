<?php
/**
 * URL chamada pela Cielo ao ser finalizado um pedido no Checkout;
*/
require_once 'functions.php';

/*
RETORNO:
order_number: 1234
amount: 10000
checkout_cielo_order_number: 4a4a566f32d344268fbc1aab3b634f5b
created_date: 07/08/2019 19:00:45
customer_name: CHARLES SÁ
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

if (isset($_REQUEST['order_number'])) {
	$cielo_order = $_REQUEST['checkout_cielo_order_number'];
	$id_pedido   = $_REQUEST['order_number'];
    $pay_status  = status($_REQUEST['payment_status']);
    $forma_pagamento = pagamento($_REQUEST['payment_method_type']);
    $bandeira_pagamento = bandeira($_REQUEST['payment_method_brand']);
    $quantidade_parcelas = $_REQUEST['payment_installments'];

    // Rotinas para persistência em banco de dados e envio de emails ao usuário

    // ao fim, responde o OK para o serviço de mudança finalizar
    echo 'OK';
}
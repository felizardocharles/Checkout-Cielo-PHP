<?php
/**
 * URL chamada pela Cielo ao haver novo status do pedido (aprovado, cancelado, pendente, etc).
*/
require_once 'functions.php';

/* 
RETORNO:
checkout_cielo_order_number: 4a4a566f32d344268fbc1aab3b634f5b
amount: 10000
order_number: 1234
payment_status: 3
test_transaction: True
*/

if (isset($_REQUEST['order_number'])) {
    $cielo_order = $_REQUEST['checkout_cielo_order_number'];
    $id_pedido   = $_REQUEST['order_number'];
    $pay_status  = status($_REQUEST['payment_status']);

    // Rotinas para persistência em banco de dados e envio de emails ao usuário

    // ao fim, responde o OK para o serviço de notificação finalizar
    echo 'OK';
}
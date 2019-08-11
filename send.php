<?php
require_once 'config.php';

/**
 * OS DADOS ABAIXO DEVEM SER ENVIADOS PELA APLICAÇÃO
 */
/*
$merchantOrderNumber = $_GET['id_pedido'];
$produto = $_GET['nome_produto'];
$descricao_produto_opcional = isset($_GET['descricao_produto']) ? $_GET['descricao_produto'] : '';
$valor = $_GET['valor']; // em centavos
$nome_comprador = $_GET['nome_comprador'];
$email_comprador = $_GET['email_comprador'];
$fone_comprador = $_GET['fone_comprador']; //deve conter no mínimo 10 e no máximo 11 caracteres. (APENAS NÚMEROS).
$doc_comprador = $_GET['cpf_comprador']; // CPF ou CNPJ do comprador (APENAS NÚMEROS).
$url_retorno = isset($_GET['url_retorno']) ? $_GET['url_retorno'] : 'www.google.com.br';
// Define para qual url o comprador será enviado após finalizar a compra.
// Uma URL fixa pode ser registrada no Backoffice Checkout, porém é desconsiderada
// caso seja enviado por esse campo.
 *
 */

$merchantOrderNumber = 1234;
$produto = 'Produto de Teste';
$descricao_produto_opcional = '';
$valor = 10000;
$nome_comprador = 'FULANO DE TAL';
$email_comprador = 'aaa@hotmail.com.br';
$fone_comprador ='88888888888';
$doc_comprador = '11111111111';
$url_retorno = 'www.google.com.br';


$cabecalhos[] = array('Cache-Control: no-cache','Content-Type: application/json','MerchantId: ' . MID);

$produtos[] = array(
    'Name' => $produto,
    'Description' => $descricao_produto_opcional,
    'UnitPrice' => $valor,
    'Type' => 'Service',
    'Quantity' => 1
);

//$recorrencia[] =array(
//    'Interval' => 'Monthly',
//    'EndDate' => 'YYYY-MM-DD'
//);

$dados = array(
    'OrderNumber' => $merchantOrderNumber,
    'SoftDescriptor' => MNAME,
    'Cart'=>array(
        'Items' => $produtos
    ),
    'Payment'=>array(
        'MaxNumberOfInstallments' => 1, // nº máximo de parcelas
        'BoletoDiscount' => 0, // Desconto, em porcentagem, para pagamentos a serem realizados com boleto.
        'DebitDiscount' => 0,   // Desconto, em porcentagem, para pagamentos a serem realizados com débito online.
        'FirstInstallmentDiscount' => 0 // Desconto, em porcentagem, para pagamentos a vista no Cartão de crédito
        //'RecurrentPayment' => $recorrencia
    ),
    'Shipping'=>array(
        'Type' => 'WithoutShipping' // aplicável para serviços e produtos digitais
    ),
    'Customer'=>array(
        'FullName' => $nome_comprador,
        'Email' => $email_comprador,
        'Phone' => $fone_comprador,
        'Identity' => $doc_comprador
    ),
    'Options'=>array(
        'AntifraudEnabled' => FALSE,
        'ReturnUrl' => $url_retorno
    )
);

$data = json_encode($dados, true);

if (json_last_error()) {
    print 'ERRO NA CODIFICACAO JSON: ' . json_last_error_msg();
}else{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, ENDPOINT);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $cabecalhos);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

    $response = curl_exec($ch);
    curl_close($ch);

    $response = json_decode($response);

    if(is_array($response)){
        $response = $response[0];
    }

    if (isset($response->Message)) {
        print 'Erro ao conectar com a Cielo: '.$response->Message;
    } else {
        $checkoutUrl = $response->settings->checkoutUrl;

        if (!empty($checkoutUrl)) {
            echo "<script>window.location='{$checkoutUrl}';</script>";
            exit();
        } else {
            print 'Erro ao gerar link de carrinho da Cielo!';
        }
    }
}
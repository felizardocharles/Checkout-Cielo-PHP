<?php
function pagamento($type) {
    if (!$type)
        return;

    switch ($type) {
        case 1:
            $tipo_pgto = 'Cartao de Credito';
            break;
        case 2:
            $tipo_pgto = 'Boleto Bancario';
            break;
        case 3:
            $tipo_pgto = 'Debito Online';
            break;
        case 4:
            $tipo_pgto = 'Cartao de Debito';
            break;
    }

    return $tipo_pgto;
}

function bandeira($brand) {
    if (!$brand)
        return;

    switch ($brand) {
        case 1:
            $bandeira = 'VISA';
            break;
        case 2:
            $bandeira = 'Mastercard';
            break;
        case 3:
            $bandeira = 'American Express';
            break;
        case 4:
            $bandeira = 'Diners';
            break;
        case 5:
            $bandeira = 'Elo';
            break;
        case 6:
            $bandeira = 'Aura';
            break;
        case 7:
            $bandeira = 'JCB';
            break;
    }

    return $bandeira;
}

function banco($bank) {
    if (!$bank)
        return;

    switch ($bank) {
        case 1:
            $banco = 'Banco do Brasil';
            break;
        case 2:
            $banco = 'Bradesco';
            break;
        default:
            $banco = 'N/D';
            break;
    }

    return $banco;
}

function fraude($check) {
    if (!$check)
        return;

    switch ($check) {
        case 1:
            $antifraude = 'Baixo Risco';
            break;
        case 2:
            $antifraude = 'Medio Risco';
            break;
        case 3:
            $antifraude = 'Alto Risco';
            break;
        case 4:
            $antifraude = 'Nao Finalizado';
            break;
        default:
            $antifraude = 'Nao Verificado';
            break;
    }

    return $antifraude;
}

function status($payment) {
    if (!$payment)
        return;

    switch ($payment) {
        case 1:
            $nome = 'Pendente';
            break;
        case 2:
            $nome = 'Pago';
            break;
        case 3:
            $nome = 'Negado';
            break;
        case 4:
            $nome = 'Expirado';
            break;
        case 5:
            $nome = 'Cancelado';
            break;
        case 6:
            $nome = 'Nao finalizado';
            break;
        case 7:
            $nome = 'Autorizado';
            break;
        case 8:
            $nome = 'Estorno';
            break;
        default:
            $nome = 'Pendente';
            break;
    }

    return $nome;
}
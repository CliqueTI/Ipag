<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

use CliqueTI\Ipag\DataTransferObject\BoletoDto;
use CliqueTI\Ipag\DataTransferObject\CustomerDto;
use CliqueTI\Ipag\DataTransferObject\PayLoadDto;
use CliqueTI\Ipag\DataTransferObject\PaymentDto;
use CliqueTI\Ipag\Ipag;
use CliqueTI\Ipag\Url;

include __DIR__."/../vendor/autoload.php";
$order_id = time();

$iPag = Ipag::transaction('API_ID','110B-C8DCF3D9-CD968EDC-FDEE48C2-0779', Url::SANDBOX)->create(PayLoadDto::create(
    $order_id,
    149.90,
    'http://localhost:800/callback',
    PaymentDto::create(
        'boleto',
        'boletopagseguro',
        null,
        null,
        null,
        BoletoDto::create(
            date('Y-m-d', strtotime('+1 days')),
            [
                "Sr. Caixa não receber após o vencimento",
                "Boleto referente ao pedido {$order_id} na plataforma"
            ]
        )
    ),
    CustomerDto::create(
        'John Due',
        '29963525997'
    )
));

if($iPag->error()){
    echo json_encode($iPag->error());
} else {
    echo json_encode($iPag->response());
}
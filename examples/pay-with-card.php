<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

use CliqueTI\Ipag\DataTransferObject\CardDto;
use CliqueTI\Ipag\DataTransferObject\CustomerDto;
use CliqueTI\Ipag\DataTransferObject\PayLoadDto;
use CliqueTI\Ipag\DataTransferObject\PaymentDto;
use CliqueTI\Ipag\Ipag;
use CliqueTI\Ipag\Url;

include __DIR__."/../vendor/autoload.php";

$iPag = Ipag::transaction('API_ID','110B-C8DCF3D9-CD968EDC-FDEE48C2-0779', Url::SANDBOX)->create(PayLoadDto::create(
    time(),
    149.90,
    'http://localhost:8000/callback',
    PaymentDto::create(
        'card',
        'visa',
        1,
        CardDto::create(
            'John Due',
            '4662 6387 7317 6027',
            '03',
            '2024',
            '435'
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
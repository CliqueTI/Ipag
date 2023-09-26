<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

include __DIR__."/../vendor/autoload.php";

use CliqueTI\Ipag\Ipag;

$callback = Ipag::callback(null,json_encode(
    [
        "TipoCartao"        => "C",
        "Data"              => "2023-09-25",
        "NumeroParcelas"    => 1,
        "Operadora"         => 60701190069139,
        "Bandeira"          => 30,
        "Percentual"        => 0,
        "UsuarioBaixa"      => "TOTEM01",
        "Itens" => [
            "FIN_MovimentoFilial"           => 62510466000194,
            "FIN_MovimentoSeq"              => 922665,
            "FIN_MovimentoProgParcela"      => 1,
            "FIN_MovimentoProgSequencia"    => 1
        ]
    ]
))->sendTo('http://179.175.62.113:8089/DelsoftX/servlet/afin_baixartituloscartao_ws');

var_dump($callback);
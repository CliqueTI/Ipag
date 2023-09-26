<?php

namespace CliqueTI\Ipag;

use CliqueTI\Ipag\DataTransferObject\ErrorDto;

abstract class Ipag {

    private string $url;
    private array $headers;
    private string $fields;
    private ?\stdClass $response;

    /**
     * INICIA UMA TRANSAÇÃO
     * @param string $apiId
     * @param string $apiKey
     * @param string $url
     * @return Transaction
     */
    public static function transaction(string $apiId, string $apiKey, string $url): Transaction {
        return new Transaction($apiId, $apiKey, $url);
    }

    public static function callback(?string $private_key, ?string $content) {
        return new Callback($private_key, $content);
    }

    /**
     * RETORNA OS ERROS CASO HOUVEREM
     * @return ErrorDto|null
     */
    public abstract function error(): ?ErrorDto;

    public function __construct(string $apiId, string $apiKey, string $url) {
        $this->url = $url;
        $this->response = new \stdClass();
        $this->headers([
            'Authorization' => "Basic ".base64_encode("{$apiId}:{$apiKey}"),
            'Content-Type'  => "application/json",
            'x-api-version' => 2,
        ]);
    }

    /**
     * ADICIONA VARIOS HEADERS ATRAVES DE UM ARRAY
     * @param array|null $headers
     */
    protected function headers(?array $headers):void {
        if(!$headers){return;}
        foreach ($headers as $k => $v) {
            $this->header($k,$v);
        }
    }

    /**
     * ADICIONA UM HEADER
     * @param string $key
     * @param string|null $value
     */
    protected function header(string $key, string $value=null):void {
        $this->headers[] = "{$key}: {$value}";
    }

    /**
     * ADICIONA OS CAMPOS FORMATO "json" OU "query"
     * @param array|null $fields
     * @param string $format
     */
    protected function fields(?array $fields, string $format="json"): void {
        if($format == "json") {
            $this->fields = (!empty($fields) ? json_encode($fields) : null);
        }
        if($format == "query"){
            $this->fields = (!empty($fields) ? http_build_query($fields) : null);
        }
    }

    /**
     * RETORNA O RESULTADO DA SOLICITAÇÃO HTTP
     * @return \stdClass|null
     */
    public function response(): ?\stdClass {
        return $this->response;
    }

    public function setResponse(object $response) {
        $this->response = $response;
    }

    /**
     * DISPARA A SOLICITAÇÃO HTTP
     * @param string $method
     * @param string $endPoint
     */
    protected function dispatch(string $method, string $endPoint): void {
        $curl = curl_init("{$this->url}/{$endPoint}");
        curl_setopt_array($curl,[
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => $method,
            CURLOPT_POSTFIELDS => $this->fields,
            CURLOPT_HTTPHEADER => $this->headers,
            //CURLOPT_SSL_VERIFYPEER => $this->sslVerifypeer,
            CURLINFO_HEADER_OUT => true
        ]);
        $this->response = json_decode(curl_exec($curl));
        curl_close($curl);
    }

}
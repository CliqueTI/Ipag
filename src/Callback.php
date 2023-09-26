<?php

namespace CliqueTI\Ipag;

use CliqueTI\Ipag\DataTransferObject\ErrorDto;
use CliqueTI\Ipag\DataTransferObject\ErrorMessageDto;

class Callback {

    private string $private_key;
    private ?object $content;
    private object $headers;


    use Traits\Callback;

    public function __construct(?string $private_key=null, ?string $content = null) {
        $this->private_key = $private_key;
        $this->content = json_decode($content);
        $this->headers = (object) getallheaders();
    }

    public function process() {
        try {

            $this->checkSignature();
            return $this->content;

        } catch (\Exception $exception) {
            return ErrorDto::create(
                $exception->getCode(),
                [ErrorMessageDto::create(
                    null,
                    $exception->getMessage()
                )]
            );
        }
    }

    /**
     * Dispara a transação para outro endereço.
     * @param string $url
     * @param string $method
     * @param string $contentType
     * @return object|mixed
     */
    public function sendTo(string $url, string $method = "POST", string $contentType="json"): object {
        $curl = curl_init($url);
        curl_setopt_array($curl,[
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => $method,
            CURLOPT_POSTFIELDS => ($contentType == "json" ? json_encode($this->content) : http_build_query($this->content)),
            CURLOPT_HTTPHEADER => $this->headers,
            //CURLOPT_SSL_VERIFYPEER => $this->sslVerifypeer,
            CURLINFO_HEADER_OUT => true
        ]);
        $response = json_decode(curl_exec($curl));
        curl_close($curl);
        return $response;
    }

}
<?php

namespace CliqueTI\Ipag;

use CliqueTI\Ipag\DataTransferObject\ErrorDto;
use CliqueTI\Ipag\DataTransferObject\ErrorMessageDto;

class Callback {

    private string $private_key;
    private ?object $content;
    private object $headers;


    use Traits\Callback;

    public function __construct(string $private_key, ?string $content = null) {
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
                errorCode: $exception->getCode(),
                errorMessages: [ErrorMessageDto::create(
                    message: $exception->getMessage()
                )]
            );
        }
    }

}
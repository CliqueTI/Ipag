<?php

namespace CliqueTI\Ipag;

use CliqueTI\Ipag\DataTransferObject\ErrorDto;
use CliqueTI\Ipag\DataTransferObject\ErrorMessageDto;
use CliqueTI\Ipag\DataTransferObject\PayLoadDto;
use CliqueTI\Ipag\DataTransferObject\TransactionDto;

class Transaction extends Ipag {

    const ERRORSCODE = [401,403,406];

    public function __construct(string $apiId, string $apiKey, string $url) {
        parent::__construct($apiId, $apiKey, $url);
    }

    public function create(PayLoadDto $payLoadDto): ?self {
        $this->fields(prepareFields($payLoadDto));
        $this->dispatch('POST','/service/payment');
        return $this;
    }

    /**
     * RETORNA OS ERROS CASO HOUVEREM
     * @return ErrorDto|null
     */
    public function error(): ?ErrorDto {

        /* Error */
        if(!empty($this->response()->code)){
            if(is_object($this->response()->message)){
                foreach ($this->response()->message as $field => $message){
                    $errorBag[] = ErrorMessageDto::create(
                        $field,
                        $message[0]
                    );
                }
                return ErrorDto::create(
                    $this->response()->code,
                    $errorBag??null
                );
            } else {
                return ErrorDto::create(
                    $this->response()->code,
                    [ErrorMessageDto::create(
                        $this->response()->message
                    )]
                );
            }
        }

        if(!empty($this->response()->code) && in_array($this->response()->code,self::ERRORSCODE)){
            foreach ($this->response()->message as $field => $message){
                $errorBag[] = ErrorMessageDto::create(
                    $field,
                    $message[0]
                );
            }
            return ErrorDto::create(
                $this->response()->code,
                $errorBag??null
            );
        }

        /* Rule Error */
        if(!empty($this->response()->error)){
            return ErrorDto::create(
                $this->response()->error->code,
                [ErrorMessageDto::create(
                    $this->response()->error->message
                )]
            );
        }

        return null;
    }
}
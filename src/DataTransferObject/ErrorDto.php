<?php

namespace CliqueTI\Ipag\DataTransferObject;

class ErrorDto {
    
    public ?string $errorCode;

    /** @var ErrorMessageDto[]|null */
    public ?array $errorMessages;

    public function __construct(?string $errorCode = null, ?array $errorMessages = null) {
        $this->errorCode = $errorCode;
        $this->errorMessages = $errorMessages;
    }

    /**
     * CRIA UMA BAG DE ERROS
     * @param string|null $errorCode
     * @param ErrorMessageDto[] $errorMessages
     * @return ErrorDto
     */
    public static function create(?string $errorCode = null, ?array $errorMessages = null): self {
        return new self($errorCode,$errorMessages);
    }
}
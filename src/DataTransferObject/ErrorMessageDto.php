<?php

namespace CliqueTI\Ipag\DataTransferObject;

class ErrorMessageDto {
    
    public ?string $field;
    public ?string $message;

    public function __construct(
        ?string $field = null,
        ?string $message = null
    ) {
        $this->field = $field;
        $this->message = $message;
    }

    /**
     * CRIA UMA MENSAGEM DE ERRO
     * @param string|null $field
     * @param string|null $message
     * @return ErrorMessageDto
     */
    public static function create(
        ?string $field = null,
        ?string $message = null
    ) {
        return new self($field, $message);
    }

}
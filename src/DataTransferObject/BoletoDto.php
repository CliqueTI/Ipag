<?php

namespace CliqueTI\Ipag\DataTransferObject;

class BoletoDto {

    public string $due_date;
    public ?array $instructions;

    public function __construct(string $due_date, ?array $instructions=null) {
        $this->due_date = $due_date;
        $this->instructions = $instructions;
    }

    /**
     * OBJETO BOLETO DA TRANSAÇÃO
     * @param string $due_date
     * @param array|null $instructions
     * @return BoletoDto
     */
    public static function create(string $due_date, ?array $instructions=null) {
        return new self($due_date, $instructions);
    }

}
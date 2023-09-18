<?php

namespace CliqueTI\Ipag\DataTransferObject;

class PaymentDto {

    public string $type;
    public string $method;
    public ?string $installments;
    public ?CardDto $card;
    public ?int $pix_expires_in;
    public ?BoletoDto $boleto;

    public function __construct(
        string $type,
        string $method,
        ?string $installments = null,
        ?CardDto $card = null,
        ?int $pix_expires_in = null,
        ?BoletoDto $boleto = null
    ) {
        $this->type = $type;
        $this->method = $method;
        $this->installments = $installments;
        $this->card = $card;
        $this->pix_expires_in = $pix_expires_in;
        $this->boleto = $boleto;
    }

    /**
     * OBJETO PAYMENT DA TRANSAÇÃO
     * @param string $type
     * @param string $method
     * @param string|null $installments
     * @param CardDto|null $card
     * @param int|null $pix_expires_in
     * @param BoletoDto|null $boleto
     * @return PaymentDto
     */
    public static function create(
        string $type,
        string $method,
        ?string $installments = null,
        ?CardDto $card = null,
        ?int $pix_expires_in = null,
        ?BoletoDto $boleto = null
    ) {
        return new self($type, $method, $installments, $card, $pix_expires_in, $boleto);
    }

}
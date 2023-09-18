<?php

namespace CliqueTI\Ipag\DataTransferObject;

class PayLoadDto {

    public ?string $order_id;
    public float $amount;
    public string $callback_url;
    public PaymentDto $payment;
    public CustomerDto $customer;

    public function __construct(
        ?int $order_id,
        float $amount,
        string $callback_url,
        PaymentDto $payment,
        CustomerDto $customer
    ) {
        $this->order_id = $order_id;
        $this->amount = $amount;
        $this->callback_url = $callback_url;
        $this->payment = $payment;
        $this->customer = $customer;
    }

    /**
     * OBJETO DE CRIAÇÃO DE UMA TRANSAÇÃO
     * @param int|null $order_id
     * @param float $amount
     * @param string $callback_url
     * @param PaymentDto $payment
     * @param CustomerDto $customer
     * @return static
     */
    public static function create(
        ?int $order_id,
        float $amount,
        string $callback_url,
        PaymentDto $payment,
        CustomerDto $customer
    ): self {
        return new self($order_id, $amount, $callback_url,$payment,$customer);
    }

}
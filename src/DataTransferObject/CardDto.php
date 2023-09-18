<?php

namespace CliqueTI\Ipag\DataTransferObject;

class CardDto {

    public string $holder;
    public string $number;
    public string $expiry_month;
    public string $expiry_year;
    public string $cvv;

    public function __construct(
        string $holder,
        string $number,
        string $expiry_month,
        string $expiry_year,
        string $cvv
    ) {
        $this->holder = $holder;
        $this->number = $number;
        $this->expiry_month = $expiry_month;
        $this->expiry_year = $expiry_year;
        $this->cvv = $cvv;
    }

    /**
     * OBJETO CARD DA TRANSAÇÃO
     * @param string $holder
     * @param string $number
     * @param string $expiry_month
     * @param string $expiry_year
     * @param string $cvv
     * @return CardDto
     */
    public static function create(
        string $holder,
        string $number,
        string $expiry_month,
        string $expiry_year,
        string $cvv
    ) {
        return new self($holder, $number, $expiry_month, $expiry_year, $cvv);
    }

}
<?php

namespace CliqueTI\Ipag\DataTransferObject;

class CustomerDto {

    public string $name;
    public string $cpf_cnpj;

    public function __construct(
        string $name,
        string $cpf_cnpj
    ) {
        $this->name = $name;
        $this->cpf_cnpj = $cpf_cnpj;
    }

    /**
     * OBJETO CUSTOMER DA TRANSAÇÃO
     * @param string $name
     * @param string $cpf_cnpj
     * @return CustomerDto
     */
    public static function create(
        string $name,
        string $cpf_cnpj
    ) {
        return new self($name, $cpf_cnpj);
    }

}
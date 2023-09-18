<?php

namespace CliqueTI\Ipag\Traits;

trait Callback {

    public function checkSignature(): void {
        $signature = hash_hmac('sha256', json_encode($this->content), $this->private_key);
        if($this->headers->{'X-Ipag-Signature'} != $signature){
            throw new \Exception('Falha na assinatura',406);
        }
    }

}
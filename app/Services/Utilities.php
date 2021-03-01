<?php

namespace App\Services;

class Utilities
{
    public function getCep($cep)
    {
        $cep = preg_replace("/[^0-9]/", "", $cep);
        $url = "http://viacep.com.br/ws/$cep/xml/";

        $retorno = simplexml_load_file($url);

        return $retorno;
    }
}
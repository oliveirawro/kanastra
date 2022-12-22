<?php

namespace app\common;

use Yii;


class Util
{



    public static function formatCPF($data)
    {
        $firstPart     = substr($data, 0, 3);
        $secondPart   = substr($data, 3, 3);
        $thirdPart   = substr($data, 6, 3);
        $forthPart = substr($data, 9, 2);
        $monta_cpf = "$firstPart.$secondPart.$thirdPart-$forthPart";
        return $monta_cpf;
    }



}

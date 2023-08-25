<?php

namespace App\Utils\Enum;

class EnumTypeContact extends EnumeratorType {

    const TYPE_TESTE = 'teste';

    public function values() : array {
        return [
            self::TYPE_TESTE => self::TYPE_TESTE
        ];
    }

}
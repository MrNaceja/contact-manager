<?php

namespace App\Utils\Enum;

class EnumTypeContact extends EnumeratorType {

    const TYPE_TELEFONE = 'Telefone',
          TYPE_EMAIL    = 'Email';

    public function values() : array {
        return [
            self::TYPE_TELEFONE => self::TYPE_TELEFONE,
            self::TYPE_EMAIL    => self::TYPE_EMAIL,
        ];
    }

}
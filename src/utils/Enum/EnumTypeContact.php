<?php

namespace App\Utils\Enum;

class EnumTypeContact extends EnumeratorType {

    const TYPE_TELEFONE = 1, _TYPE_TELEFONE = 'Telefone',
          TYPE_EMAIL    = 2, _TYPE_EMAIL    = 'Email';


    /**
     * {@inheritdoc}
     */
    public static function values() : array {
        return [
            self::_TYPE_EMAIL    => self::TYPE_EMAIL,
            self::_TYPE_TELEFONE => self::TYPE_TELEFONE,
        ];
    }

    /**
     * {@inheritdoc}
     */
    public static function valueToDescription($value) {
        $description = false;
        foreach (self::values() as $typeDescription =>  $type) {
            if ($type == $value) {
                $description = $typeDescription;
            }
        }
        return $description;
    }

}
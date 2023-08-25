<?php

namespace App\Utils\Enum;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\Type;

abstract class EnumeratorType extends Type {

    /**
     * Retornar os valores do enumerado.
     * 
     * @return array
     */
    protected abstract function values() : array;

    /**
     * @inheritdoc
     */
    public function getSQLDeclaration(array $fieldDeclaration, AbstractPlatform $platform)
    {
        $values = array_map(function($val) { return "'".$val."'"; }, $this->values());
        return "ENUM(".implode(", ", $values).")";
    }

    /**
     * @inheritdoc
     */
    public function convertToPHPValue($value, AbstractPlatform $platform) {
        return $value;
    }

    /**
     * @inheritdoc
     */
    public function convertToDatabaseValue($value, AbstractPlatform $platform) {
        if (!in_array($value, $this->values())) {
            throw new \InvalidArgumentException("Invalid '".$this->getName()."' value.");
        }
        return $value;
    }

    /**
     * @inheritdoc
     */
    public function getName() {
        return self::class;
    }

    /**
     * @inheritdoc
     */
    public function requiresSQLCommentHint(AbstractPlatform $platform) {
        return true;
    }

}
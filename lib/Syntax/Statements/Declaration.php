<?php

namespace NielsHoppe\PHPCSS\Syntax\Statements;

class Declaration {

    private $property;
    private $value;

    public function __construct ($property, $value) {

        $this->property = $property;
        $this->value = $value;
    }

    public static function parse ($string) {

        $parts = explode(':', $string);

        if (count($parts) !== 2) {

            throw new \Exception('Invalid Declaration \'' . $string . '\'.');
        }

        $property = trim($parts[0]);
        $value = trim($parts[1]);

        $result = new Declaration($property, $value);

        return $result;
    }

    public function getProperty () {

        return $this->property;
    }

    public function getValue () {

        return $this->value;
    }

    /**
     * @return string
     */

    public function __toString () {

        $value = is_object($this->value) ? $this->value->__toString() : $this->value;

        return sprintf('%s: %s', $this->property, $value);
    }
}
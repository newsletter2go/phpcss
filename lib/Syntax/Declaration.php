<?php

/**
 * class NielsHoppe\PHPCSS\Syntax\Declaration
 */

namespace NielsHoppe\PHPCSS\Syntax;

/**
 * Declaration
 * @see https://www.w3.org/TR/css-syntax-3/#declaration
 */

class Declaration implements Item {

    /**
     * @var string $property  The declared Property
     */
    private $property;

    /**
     * @var string $value  The declared Value
     */
    private $value;

    /**
     * @var bool $important  The important flag
     */
    private $important;

    /**
     * Construct a Declaration from a Property and a Value
     *
     * @param string $property  TODO Restrict to Property as soon as implemented
     * @param string $value  TODO Restrict to Value as soon as implemented
     * @param bool $important  State of the !important flag
     */
    public function __construct ($property, $value, $important = false) {

        $this->property = $property;
        $this->value = $value;
        $this->setImportant($important);
    }

    /**
     * Return property part of this Declaration
     *
     * @return string
     */
    public function getProperty () {

        return $this->property;
    }

    /**
     * Return value part of this Declaration
     *
     * @return string
     */
    public function getValue () {

        return $this->value;
    }

    /**
     * Return state of !important flag of this Declaration
     *
     * @return bool
     */
    public function isImportant () {

        return $this->important;
    }

    /**
     * Set state of !important flag to a given value
     *
     * @param bool $important  State of the !important flag (defaults to true)
     */
    public function setImportant ($important = true) {

        $this->important = boolval($important);
    }

    /**
     * Return string representation
     *
     * @return string
     */
    public function __toString () {

        $value = is_object($this->value) ? $this->value->__toString() : $this->value;

        return trim(sprintf('%s: %s %s', $this->property, $value, $this->important ? '!important' : ''));
    }
}

<?php

/**
 * interface NielsHoppe\PHPCSS\Syntax\Item
 */

namespace NielsHoppe\PHPCSS\Syntax;

/**
 * Items implementing this interface are required to have a method __toString()
 * that will output valid CSS.
 *
 * @see https://www.w3.org/TR/css-syntax-3/#parsing
 */

interface Item {

    /**
     * Return a string representation
     *
     * @return string
     */
    public function __toString ();
}

<?php

namespace NielsHoppe\PHPCSS\Selectors;

/**
 * @see http://www.w3.org/TR/css3-selectors/
 */

class AttributeSelector extends SimpleSelector {

    const MATCH_EXACT       = '=';
    const MATCH_DASH        = '|=';
    const MATCH_INCLUDES    = '~=';
    const MATCH_PREFIX      = '^=';
    const MATCH_SUFFIX      = '$=';
    const MATCH_SUBSTRING   = '*=';

    protected $attribute;
    protected $val;
    protected $operator;

    public function __construct ($attribute, $value = null, $operator = null) {

        $this->attribute = $attribute;

        if (isset($value)) {

            $this->value = $value;

            if (
                $operator == self::MATCH_EXACT ||
                $operator == self::MATCH_DASH ||
                $operator == self::MATCH_INCLUDES ||
                $operator == self::MATCH_PREFIX ||
                $operator == self::MATCH_SUFFIX ||
                $operator == self::MATCH_SUBSTRING
            ) {

                $this->operator = $operator;
            }
            else {

                $this->operator = self::MATCH_EXACT;
            }
        }
        else {

            $this->value = null;
            $this->operator = null;
        }
    }

    public function __toString () {

        $result = $this->attribute;

        if (isset($this->value)) {

            $result .= $this->operator . $this->value;
        }

        return '[' . $result . ']';
    }

    public function toXPath () {

        $templates = array(
            self::MATCH_EXACT => '@%1$s = \'%2$s\'',
            self::MATCH_DASH => '@%1$s = \'%2$s or starts-with(@%1$s, \'%2$s-\')\'',
            self::MATCH_INCLUDES => 'contains(@%1$s, \'%2$s\')', // FIXME: This is wrong!
            self::MATCH_PREFIX => 'starts-with(@%1$s, \'%2$s\')',
            self::MATCH_SUFFIX => 'substring(@%1$s, string-length(@%1$s), ' . strlen($this->value) . ') = \'%2$s\'',
            self::MATCH_SUBSTRING => 'contains(@%1$s, \'%2$s\')'
        );

        $template = $templates[$this->operator];

        return sprintf('[' . $template . ']', $this->attribute, $this->value);
    }
}

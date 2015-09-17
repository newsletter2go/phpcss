<?php

namespace NielsHoppe\PHPCSS\Selectors;

/**
 * @see http://www.w3.org/TR/css3-selectors/
 */

class Selector {

    const DESCENDANT_COMBINATOR = ' '; // also TAB, LINE FEED, CARRIAGE RETURN, FORM FEED
    const CHILD_COMBINATOR = ' > ';
    const GENERAL_SIBLING_COMBINATOR = ' ~ ';
    const ADJACENT_SIBLING_COMBINATOR = ' + ';

    protected $chain; // of one or more sequences of simple selectors separated by combinators

    public function __construct ($chain) {

        $this->chain = $chain;
    }

    /**
     * @see http://www.w3.org/TR/css3-selectors/#specificity
     * @see http://www.w3.org/TR/2009/CR-CSS2-20090908/cascade.html#specificity
     * Specificity of style="" is always 1000
     */

    public function getSpecificity () {

        $specificity = 0;

        foreach ($this->chain as $item) {

            if ($item instanceof IDSelector) {

                $specificity += 100;
            }
            else if (
                $item instanceof ClassSelector ||
                $item instanceof AttributeSelector ||
                $item instanceof PseudoClassSelector
            ) {

                $specificity += 10;
            }
            else if ($item instanceof TypeSelector) {
                // TODO: Account for pseudo-elements

                $specificity += 1;
            }
        }

        return $specificity;
    }

    public function __toString () {

        $result = '';

        foreach ($this->chain as $item) {

            if (is_string($item)) {

                $result .= $item;
            }
            else {

                $result .= $item->__toString();
            }
        }

        return $result;
    }

    public function toXPath () {

        $translate = function ($item) {

            if (is_string($item)) {

                switch ($item) {

                case self::CHILD_COMBINATOR:

                    return '/';

                case self::ADJACENT_SIBLING_COMBINATOR:

                    return '/following-sibling::*[1]/self::';

                case self::GENERAL_SIBLING_COMBINATOR:

                    return ''; // TODO

                case self::DESCENDANT_COMBINATOR:

                    return '//';

                default:

                    // This is an error condition
                    return '';
                }
            }
            else {

                return $item->toXPath();
            }
        };

        $parts = array_map($translate, $this->chain);

        return '//' . implode($parts);
    }
}

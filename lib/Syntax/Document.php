<?php

/**
 * class NielsHoppe\PHPCSS\Syntax\Document
 */

namespace NielsHoppe\PHPCSS\Syntax;

use \NielsHoppe\PHPCSS\Syntax\Rule;
use \NielsHoppe\PHPCSS\Syntax\Rules\ImportRule;

/**
 * Document
 */
class Document implements Item {

    /**
     * @var ImportRule[] $imports  @import (special AtRule)
     */
    private $imports;

    /**
     * @var Rule[] $rules  StyleRule or AtRule (except @import)
     */
    private $rules;

    /**
     * Constructs a new Document
     */
    public function __construct () {

        $this->imports = array();
        $this->rules = array();
    }

    /**
     * Add a new ImportRule to the Document
     *
     * @param ImportRule $import
     */
    public function addImport (ImportRule $import) {

        array_push($this->imports, $import);
    }

    /**
     * Add a new Rule to the Document
     *
     * @param Rule $rule
     */
    public function addRule (Rule $rule) {

        array_push($this->rules, $rule);
    }

    /**
     * @return Rule[]
     */
    public function getRules()
    {
        return $this->rules;
    }

    /**
     * Return a string representation
     *
     * @return string
     */
    public function __toString () {

        $toStringFunc = function ($item) {

            return $item->__toString();
        };

        $parts = array();

        array_push($parts, implode("\n", array_map($toStringFunc, $this->imports)));
        array_push($parts, implode("\n", array_map($toStringFunc, $this->rules)));

        return implode("\n", array_filter($parts));
    }
}

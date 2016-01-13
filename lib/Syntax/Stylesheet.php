<?php

namespace NielsHoppe\PHPCSS\Syntax;

/**
 */

class Stylesheet {

    /**
     * @var ImportStatement @import (special AtRule)
     * @var [Ruleset|AtRule]    Ruleset or AtRule (except @import)
     */

    private $imports;
    private $statements;

    public function __construct () {

        $this->imports = array();
        $this->statements = array();
    }

    /**
     * @param ImportStatement   $import
     */

    public function addImport (ImportStatement $import) {

        array_push($this->imports, $import);
    }

    /**
     * @param Statement     $statement
     */

    public function addStatement ($statement) {

        array_push($this->statements, $statement);
    }

    /**
     * @return string
     */

    public function __toString () {

        $toStringFunc = function ($item) {

            return $item->__toString();
        };

        $parts = array();

        array_push($parts, implode("\n", array_map($toStringFunc, $this->imports)));
        array_push($parts, implode("\n", array_map($toStringFunc, $this->statements)));

        return implode("\n", array_filter($parts));
    }
}

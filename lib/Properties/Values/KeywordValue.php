<?php

namespace NielsHoppe\PHPCSS\Properties\Values;

class KeywordValue {

    const IDENT_AUTO = 'auto';
    const IDENT_INHERIT = 'inherit';

    protected $value;

    public function __construct ($value) {

        // TODO Validation
        $this->value = $value;
    }

    public function __toString () {

        return sprintf('%s', $this->value);
    }
}
<?php

namespace NielsHoppe\PHPCSS\MediaQueries;

use NielsHoppe\PHPCSS\Statements\AtRuleStatement;

class MediaQueryStatement extends AtRuleStatement {

    public function __construct ($media) {

        $this->keyword = 'media';
        $this->content = '';
    }
}

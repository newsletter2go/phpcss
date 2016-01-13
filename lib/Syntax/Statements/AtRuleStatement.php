<?php

namespace NielsHoppe\PHPCSS\Syntax\Statements;

class AtRuleStatement extends Statement {

    /**
     * @var string          $keyword
     * @var string|Block    $content
     */

    protected $keyword;
    protected $content;

    /**
     * @param string    $keyword
     * @param string    $content
     */

    public function __construct ($keyword, $content) {

        $this->keyword = $keyword;
        $this->content = $content;
    }

    /**
     * @return string
     */

    public function __toString () {

        if (is_string($this->content)) {

            $content = $this->content;
        }
        else {

            $content = $this->content->__toString();
        }

        $result = sprintf('@%s %s', $this->keyword, $content);

        return $result;
    }
}

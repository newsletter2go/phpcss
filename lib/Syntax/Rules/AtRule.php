<?php

/**
 * class NielsHoppe\PHPCSS\Syntax\Rules\AtRule
 */

namespace NielsHoppe\PHPCSS\Syntax\Rules;

use NielsHoppe\PHPCSS\Syntax\Item;
use NielsHoppe\PHPCSS\Syntax\Rule;

/**
 * AtRule
 * @see https://www.w3.org/TR/css3-syntax/#at-rule
 */

class AtRule implements Rule {

    /**
     * @var string $keyword  Keyword
     */
    protected $keyword;

    /**
     * @var string|Item $content  Content
     */
    protected $content;

    /**
     * Construct a new AtRule
     *
     * @param string $keyword
     * @param string|Item $content
     */
    public function __construct ($keyword, $content) {

        $this->keyword = $keyword;
        $this->content = $content;
    }

    /**
     * Return string representation
     *
     * @return string
     */
    public function __toString () {

        if (is_string($this->content)) {

            $content = $this->content;
        }
        else {

            $content = $this->content->__toString();
        }

        return sprintf('@%s %s', $this->keyword, $content);
    }
}

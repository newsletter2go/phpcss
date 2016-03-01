<?php

namespace NielsHoppe\PHPCSS\Syntax\Rules;

use NielsHoppe\PHPCSS\Syntax\Rules\AtRule;

/**
 * @see https://www.w3.org/TR/css-syntax-3/#at-rule
 */

class ImportRule extends AtRule {

    private $media;

    /**
     * Construct an ImportRule from a URL and optionally media types
     *
     * @param string    $url
     * @param string    $media
     */

    public function __construct ($url, $media = '') {

        $this->keyword = 'import';

        if ($media == '' || $media == 'all') {

            $media = 'all';
        }

        $this->content = sprintf('url(%s) %s;', $url, $media);
    }
}
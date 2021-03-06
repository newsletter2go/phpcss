<?php

namespace NielsHoppe\PHPCSS\Parser;

use \NielsHoppe\PHPCSS\Syntax\Rules\StyleRule;
use \NielsHoppe\PHPCSS\Syntax\Declaration;
use \NielsHoppe\PHPCSS\Syntax\DeclarationList;

/**
 * Parser for CSS offering entry points as specified in
 * @see https://www.w3.org/TR/css-syntax-3/#parser-entry-points
 *
 * @see https://www.w3.org/TR/css-syntax-3/#parsing
 */

class Parser {

    /**
     * @see https://www.w3.org/TR/css-syntax-3/#parse-a-stylesheet
     */
    public static function parseStylesheet ($string) {
        //todo Implement this
        throw new \Exception('Method not implemented');
    }

    /**
     * @see https://www.w3.org/TR/css-syntax-3/#parse-a-list-of-rules
     */
    public static function parseRuleList ($string) {
        //todo Implement this
        throw new \Exception('Method not implemented');
    }

    /**
     * @see https://www.w3.org/TR/css-syntax-3/#parse-a-rule
     * @todo Currently only parses StyleRule
     *
     * @param string $string
     * @return StyleRule
     * @throws \Exception
     */
    public static function parseRule ($string) {

        $selector = null;
        $parts = array_filter(explode('{', $string));

        if (count($parts) > 1) {

            $selector = trim($parts[0]);
            $parts = array_filter(explode('}', $parts[1]));

            if (count($parts) > 1) {

                throw new \Exception('Extra content after closing bracket: \'' . $parts[1] . '\'');
            }
        }

        $body = trim($parts[0]);

        $block = self::parseDeclarationList($body);

        return new StyleRule($selector, $block);
    }

    /**
     * Parse a Declaration from a string
     * @see https://www.w3.org/TR/css-syntax-3/#parse-a-declaration
     *
     * @param string $string
     * @return Declaration
     * @throws \Exception
     */
    public static function parseDeclaration ($string) {

        $parts = explode(':', $string);

        if (count($parts) !== 2) {

            throw new \Exception('Invalid Declaration \'' . $string . '\'.');
        }

        $property = trim($parts[0]);
        $value = trim($parts[1]);
        $important = false; // TODO

        return new Declaration($property, $value, $important);
    }

    /**
     * @see https://www.w3.org/TR/css-syntax-3/#parse-a-list-of-declarations
     *
     * @param string $string
     * @return DeclarationList
     * @throws \Exception
     */
    public static function parseDeclarationList ($string) {

        $tokens = array_filter(explode(';', $string));

        $declarations = array_map(function ($token) {

            return self::parseDeclaration($token);
        }, $tokens);

        return new DeclarationList($declarations);
    }

    /**
     * @see https://www.w3.org/TR/css-syntax-3/#parse-a-component-value
     */
    public static function parseComponentValue ($string) {

        throw new \Exception('Method not implemented');
    }

    /**
     * @see https://www.w3.org/TR/css-syntax-3/#parse-a-list-of-component-values
     */
    public static function parseComponentValueList ($string) {

        throw new \Exception('Method not implemented');
    }
}

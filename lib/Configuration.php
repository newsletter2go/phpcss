<?php

namespace NielsHoppe\PHPCSS;

/**
 * Library for utility functions
 */

class Configuration {

    private static $settings = array(

        'require_compatible_2_1' => false
    );

    public static get ($key) {

        if (array_key_exists($key, self::$settings)) {

            return self::$settings[$key];
        }

        return null;
    }

    public static set ($key, $value) {

        if (array_key_exists($key, self::$settings)) {

            self::$settings[$key] = $value;

            return true;
        }

        return false;
    }
}
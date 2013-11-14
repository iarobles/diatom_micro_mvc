<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PieConfig
 *
 * @author ismael
 */
class ConstManager {

    protected static $configurations = array();

    public static function getConstant($key) {

        $configurationValue = (isset(self::$configurations[$key])) ? self::$configurations[$key] : null;

        return $configurationValue;
    }

    public static function setConstant($key, $value) {
        self::$configurations[$key] = $value;
    }

}

?>

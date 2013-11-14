<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

abstract class AbstractInterceptor {

    public abstract function execute($actionName, $actionMethod, $actionParams);
}

?>

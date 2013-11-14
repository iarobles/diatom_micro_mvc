<?php

include_once 'AbstractAppResourceVO.php';
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ActionMappingVO
 *
 * @author ismael
 */
class ActionMappingVO extends AbstractAppResourceVO {

    private $views;

    public function ActionMappingVO($actionName, $path, $className) {
        $this->AbstractAppResourceVO($actionName, $path, $className);
    }

}

?>

<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of InterceptorMappingVO
 *
 * @author ismael
 */
class InterceptorMappingVO extends AbstractAppResourceVO {

    private $orderExecution;

    public function getOrderExecution() {
        return $this->orderExecution;
    }

    public function setOrderExecution($orderExecution) {
        $this->orderExecution = $orderExecution;
    }

    public function InterceptorMappingVO($interceptorName, $path, $className) {
        $this->AbstractAppResourceVO($interceptorName, $path, $className);
    }

}

?>

<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of DispathController
 *
 * @author ismael
 */
class ActionDispatcher {

    protected $log;

    function ActionDispatcher() {
        $this->log = new AppLogger($this);
    }

    function dispatch($actionName, $actionMethod, $actionParams) {

        $actionForward = $this->evalInterceptors($actionName, $actionMethod, $actionParams);

        if ($actionForward == null) {

            $this->log->debug("action name:" . $actionName . " action method:" . $actionMethod . " params:" . print_r($actionMethodParams, true));
            $actionCompleteName = $actionName . "." . $actionMethod;
            $actionVO = ResourceManager::getAction($actionCompleteName);
            $this->log->debug("action:" . $actionCompleteName . " has vo:" . print_r($actionVO, true));

            if ($actionVO != null) {
                $actionInstance = $actionVO->getInstance();
                $actionForward = call_user_func(array($actionInstance, $actionMethod), $actionParams);
                $this->log->debug("action forward from action:" . $actionName . " is:" . $actionForward);
            } else {
                $this->log->error("action:\"" . $actionCompleteName . "\" doesn't exist in Config.php");
            }
        }

        $viewConfig = ResourceManager::getView($actionForward);

        if ($viewConfig != null) {
            //is a view
            $viewConfig->printView();
        } else {
            //is an action
            ResourceManager::getAction($actionForward);
        }

        //TODO search in the actions if we
        //TODO process the forward
    }

    protected function testInclude() {
        $viewValue = "hello2!";
        include 'show_login.php';
    }

    protected function evalInterceptors($actionName, $actionMethod, $actionParams) {
        $interceptors = ResourceManager::getAllInterceptors();

        $forward = null;
        foreach ($interceptors as $interceptor) {
            $interceptorInstance = $interceptor->getInstance();
            $forward = $interceptorInstance->execute($actionName, $actionMethod, $actionParams);

            if ($forward != null) {
                $this->log->info("interceptor!!");
                break;
            }
        }

        return $forward;
    }

}

?>

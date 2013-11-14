<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AbstractAppResource
 *
 * @author ismael
 */
abstract class AbstractAppResourceVO {

    private $resourceName;
    private $path;
    private $className;

    protected function AbstractAppResourceVO($resourceName, $path, $className) {
        $this->resourceName = $resourceName;
        $this->path = $path;
        $this->className = $className;
    }

    public function getInstance() {
        $actionPath = $this->getPath();
        require_once $actionPath;
        $actionClassName = $this->getClassName();
        $actionInstance = new $actionClassName;

        return $actionInstance;
    }

    public function getResourceName() {
        return $this->resourceName;
    }

    public function setResourceName($resourceName) {
        $this->resourceName = $resourceName;
    }

    public function getPath() {
        return $this->path;
    }

    public function setPath($path) {
        $this->path = $path;
    }

    public function getClassName() {
        return $this->className;
    }

    public function setClassName($className) {
        $this->className = $className;
    }

}

?>

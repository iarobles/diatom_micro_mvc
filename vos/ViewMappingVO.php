<?php

include_once 'AbstractAppResourceVO.php';

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ViewMappingVO
 *
 * @author ismael
 */
class ViewMappingVO extends AbstractAppResourceVO {

	private $log;
	private $components = array();
	private $mainPage;
	private $parentViewName;

	public function ViewMappingVO($viewName, $parentViewName, $path, $mainPage, $components) {
		$this->AbstractAppResourceVO($viewName, $path, null);
		$this->setComponents($components);
		$this->setMainPage($mainPage);
		$this->setParentViewName($parentViewName);
		$this->log = new AppLogger($this);
	}

	//imprimir siempre el del padre y pasar configuracion actual
	public function printView() {

		ViewManager::printView($this);
	}

	public function mergeComponents($components){
		$currentViewComponents = $this->getComponents();
		$this->log->debug("will merge array:".print_r($currentViewComponents,true)." with array:".print_r($components,true));
		$viewComponents = array_merge($currentViewComponents, $components);
		$this->log->debug("overrided components:".$viewComponents);
		$this->setComponents($viewComponents);
	}

	public function printComponent($componentName) {
		ViewManager::printComponent($this , $componentName);
	}

	public function getParentView(){

		$parentViewVO = ResourceManager::getView($this->getParentViewName());

		return $parentViewVO;
	}


	public function getComponents() {
		return $this->components;
	}

	public function setComponents($components) {
		$this->components = $components;
	}

	public function getMainPage() {
		return $this->mainPage;
	}

	public function setMainPage($mainPage) {
		$this->mainPage = $mainPage;
	}

	public function setComponent($componentName, $componentValue) {

		$this->components[$componentName] = $componentValue;
	}

	public function setParentViewName($parentViewName){
		$this->parentViewName = $parentViewName;
	}

	public function getParentViewName(){
		return $this->parentViewName;
	}

	public function getComponent($componentName) {
		$componentValue = null;
		if ($this->components != null && sizeof($this->components) > 0) {
			$componentValue = isset($this->components[$componentName]) ? $this->components[$componentName] : null;
		}

		return $componentValue;
	}

}

?>

<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ResourceManager
 *
 * @author ismael
 */
class ResourceManager {

	private static $actionMappings = array();
	private static $viewMappings = array();
	private static $interceptors = array();

	public static function registerInterceptor($interceptorName, $path, $className) {
		$interceptorVO = new InterceptorMappingVO($interceptorName, $path, $className);
		self::$interceptors[$interceptorName] = $interceptorVO;
	}

	public static function getInterceptor($interceptorName) {
		$interceptorVO = (isset(self::$interceptors[$interceptorName])) ? self::$interceptors[$interceptorName] : null;

		return $interceptorVO;
	}

	public static function getAllInterceptors() {
		return self::$interceptors;
	}

	public static function getAllViewsMappings(){
		return self::$viewMappings;
	}

	public static function registerAction($actionName, $path, $className) {
		$actionVO = new ActionMappingVO($actionName, $path, $className);
		self::$actionMappings[$actionName] = $actionVO;
	}

	public static function getAction($actionName) {

		$actionVO = (isset(self::$actionMappings[$actionName])) ? self::$actionMappings[$actionName] : null;
		return $actionVO;
	}

	public static function registerView($viewName, $path, $mainPage, $components) {
		$viewVO = new ViewMappingVO($viewName,$viewName, $path, $mainPage, $components);
		self::$viewMappings[$viewName] = $viewVO;
	}

	public static function registerViewWithParent($viewName, $parentViewName, $path,$components){
		//echo "viewName:".$viewName." parentViewName:".$parentViewName;
		
		$parentViewVO = self::getView($parentViewName);
		//echo "parentViewVO:".print_r($parentViewVO,true);
		$overridedViewVO = clone $parentViewVO;
		$overridedViewVO->setPath($path);
		$overridedViewVO->mergeComponents($components);
		$overridedViewVO->setResourceName($viewName);
		$overridedViewVO->setParentViewName($parentViewName);
			
		self::$viewMappings[$viewName] = $overridedViewVO;
		//echo "</br></br> views:".print_r(self::getAllViewsMappings(),true)."</br></br>";
	}

	public static function getView($viewName) {
		$viewVO = null;
		if($viewName != null){
			$viewVO = (isset(self::$viewMappings[$viewName])) ? self::$viewMappings[$viewName] : null;
		}

		return $viewVO;
	}

}

?>

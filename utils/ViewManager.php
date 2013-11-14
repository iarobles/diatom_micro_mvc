<?php

include_once './vos/ViewMappingVO.php';
include_once './utils/ResourceManager.php';

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ViewManager
 *
 * @author ismael
 */
class ViewManager {

	//put your code here

	private static function printExtendedView($originalView,$viewToPrint){

		//if the current object is the parent view
		//echo "view.resourceName:".$viewToPrint->getResourceName()." view.parentViewName:".$viewToPrint->getParentViewName();
		if($originalView !=null && $viewToPrint!=null){
			if($viewToPrint->getResourceName() == $viewToPrint->getParentViewName() ){
				$view = $originalView;
				//we print the view using the parent main page, but we use the originalView configuration
				//to print its components
				//echo "</br> ------------- original View:".print_r($view,true)." ------------- </br>";
				$pathToInclude = $viewToPrint->getPath() . "/" . $viewToPrint->getMainPage();
				include $pathToInclude;
			}else{
				$parentViewVO =  $viewToPrint->getParentView();
				//echo " parentViewVO:".print_r($parentViewVO,true)."</	br>";

				self::printExtendedView($originalView,$parentViewVO	);
			}
		}

		//if the path doesn't exist, we try with its parent class.
		//if(file_exists($pathToInclude) == false){
		//$pathToInclude = $this->getParentPath() . "/" . $this->getParentMainPage();
		//}
		//echo "pathToInclude:" . $pathToInclude;

	}

	public static function printView($viewToPrint) {
		self::printExtendedView($viewToPrint,$viewToPrint );
	}

	public static function printComponent($view , $componentName){
		$componentValue = $view->getComponent($componentName);
		//echo "component value:" . $componentValue . " component name:" . $componentName . " components:" . print_r($this->components, true);

		if($componentValue != null){

			if (strpos($componentValue, ".php") === false) { //the component is a view
				$view = ResourceManager::getView($componentValue);
				$view->printView();
			} else { //the component is a single php file

				$pathComponentToInclude = $view->getPath() . "/" . $componentValue;
				//if we can't find the component in the current path (of this view)
				// we try to print the current view parent
				if(file_exists($pathComponentToInclude) === false){

					if( $view->getResourceName() != $view->getParentViewName()){
						$parentView = $view->getParentView();
						self::printComponent($parentView, $componentName);
					}

				}else{
					include $pathComponentToInclude;
				}
			}
		}
	}

}

?>

<?php

include_once './config/Core.php';

$log = new AppLogger($this);

$requestUri = $_SERVER["REQUEST_URI"];

$pathToTranslate = substr($requestUri, strpos($requestUri, "index.php") + 9);

$log->debug("requested uri:" . $requestedUri . " path to translate:" . $pathToTranslate);
if (strlen($pathToTranslate) > 0) {

    $pathToTranslate = ($pathToTranslate[0] == "/") ? substr($pathToTranslate, 1, strlen($pathToTranslate)) : $pathToTranslate;
    $actionAndParams = split("\?", $pathToTranslate);
    $actionAndMethod = split("/", $actionAndParams[0]);
    $params = (isset($actionAndParams[1])) ? split("&", $actionAndParams[1]) : array();
    $log->debug("url params:" . print_r($urlParams, true) . " from :" . $pathToTranslate . " is array:" . is_array($urlParams));


    $actionName = $actionAndMethod[0];
    $actionMethod = isset($actionAndMethod[1]) ? $actionAndMethod[1] : "execute";

    /*
      $actionMethodParams = array();
      for ($i = 2; $i < sizeof($urlParams); $i++) {
      $actionMethodParams[$i - 2] = $urlParams[$i];
      } */

    $dispatcher = new ActionDispatcher();
    $dispatcher->dispatch($actionName, $actionMethod, $params);
}
?>
<?php

include_once './utils/ConstManager.php';
include_once './utils/ResourceManager.php';
include_once './utils/AppLogger.php';
include_once './utils/ViewManager.php';
include_once './vos/ActionMappingVO.php';
include_once './vos/ViewMappingVO.php';
include_once './vos/InterceptorMappingVO.php';
include_once './actions/ActionDispatcher.php';



//--------------------------------  constants section --------------------------
ConstManager::setConstant("PROJECT_DIR_NAME", "new_pie_uploader");
//------------------------------------------------------------------------------


//----------------------- log configuration ------------------------------------
// log files are stored in: project_folder/logs
ConstManager::setConstant("LOG_FILE_NAME", "magicBox.log");
AppLogger::setDebugLevel(AppLogger::LEVEL_DEBUG);


//------------------------------------------------------------------------------

ResourceManager::registerAction("Login.execute", "./actions/LoginAction.php", "LoginAction");

//------------------------------------------------------------------------------
//
//------------------------------- VIEW MAPPINGS -----------------------------
ResourceManager::registerView("mainTemplate", "./views", "main_template.php", array("mainHeader" => "main_header.php","body" => null));

//------------------------------- autentication -------------------------------------------------------

ResourceManager::registerView("innerView2", "./views/test2","view_test.php",array("innerView2Comp" => "inner_view2.php") );
ResourceManager::registerViewWithParent("autentication.showLogin","mainTemplate", "./views/autentication", array("body"=>"show_login.php","innerBody"=>"inner_body_test.php","innerView2Test" => "innerView2") );

//------------------------------------------------------------------------------
//
//---------------------------  INTERCEPTORS MAPPINGS ---------------------------
ResourceManager::registerInterceptor("sessionInterceptor", "./interceptors/SessionInterceptor.php", "SessionInterceptor");
//------------------------------------------------------------------------------
?>

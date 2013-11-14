<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of LoginController
 *
 * @author ismael
 */
class LoginAction {

    private $log;

    function LoginAction() {
        $this->log = new AppLogger($this);
    }

    public function execute() {
        $this->log->info("Will show login page");

        return "autentication.showLogin";
    }

}

?>

<?php
/**
 * Created by PhpStorm.
 * User: RICHARD
 * Date: 24/10/2018
 * Time: 10:19:54 AM
 */
session_start();
require './vista/src/pages/pages.php';

class Index extends Pages {

    private $defaultWebOff;
    private $defaultWebOn;

    function __construct() {
        $this->defaultWebOff = 'login';
        $this->defaultWebOn = 'inicio';
        $get = $this->validar();
        $this->get($get);
    }

    function get($get) {
        $this->crearInstancias();
        if ($get == 'offline') {
            session_destroy();
            header('Location: index.php?web=login');
        }
        if (empty($this->instancias[$get])) {
            if (empty($_SESSION['DATOS']))
                $get = $this->defaultWebOff;
            else
                $get = $this->defaultWebOn;
        }
        $this->instancias[$get]->Show();
    }

    function validar() {
        if (empty($_GET["web"])) {
            if (empty($_SESSION['DATOS']))
                return $this->defaultWebOff;
            else
                return $this->defaultWebOn;
        } else
            return $_GET["web"];
    }

}

$obj = new Index();
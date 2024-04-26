<?php
spl_autoload_register(function($class){
    if (file_exists("LoginAdmin/vistas/eventos/Config/App".$class.".php")) {
        require_once "LoginAdmin/vistas/eventos/Config/App" . $class . ".php";
    }
})
?>
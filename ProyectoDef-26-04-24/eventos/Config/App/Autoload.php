<?php
spl_autoload_register(function($class){
    if (file_exists("../eventos/Config/App".$class.".php")) {
        require_once "../eventos/Config/App" . $class . ".php";
    }
})
?>
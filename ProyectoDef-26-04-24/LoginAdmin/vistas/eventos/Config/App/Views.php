<?php
class Views{

    public function getView($controlador, $vista, $data="")
    {
        $controlador = get_class($controlador);
        if ($controlador == "Home") {
            $vista = "LoginAdmin/vistas/eventos/Views".$vista.".php";
        }else{
            $vista = "LoginAdmin/vistas/eventos/Views".$controlador."/".$vista.".php";
        }
        require $vista;
    }
}


?>
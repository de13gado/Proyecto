<?php
class Views{

    public function getView($controlador, $vista, $data="")
    {
        $controlador = get_class($controlador);
        if ($controlador == "Home") {
            $vista = "eventos/Views".$vista.".php";
        }else{
            $vista = "eventos/Views".$controlador."/".$vista.".php";
        }
        require $vista;
    }
}


?>
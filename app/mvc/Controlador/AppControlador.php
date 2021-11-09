<?php
namespace Controlador;

class AppControlador extends Controlador
{
    public function index()
    {
        $this->visao('login/index.php');
    }
}

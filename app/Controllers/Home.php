<?php

namespace App\Controllers;

class Home extends BaseController
{
    private $aside;
    private $footerboot;
    private $navbar;
    private $allComp;

    function __construct(){

        $this->aside = view('sidebar');
        $this->footerboot = view('footerboot');
        $this->navbar = view('navbar');

        $this->allComp = [
            'footerboot' => $this->footerboot, 
            'aside' => $this->aside, 
            'navbar' => $this->navbar
        ];


    }


    public function index()
    {   
        echo view('header',$this->allComp);
        echo view('dashboard');
        echo view('footer');
    }
}

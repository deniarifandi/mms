<?php

namespace App\Controllers;

class Home extends BaseController
{
    private $aside;
    private $footerboot;
    private $navbar;
    private $allComp;
    private $breadcrumb;

    function __construct(){

        
        $this->footerboot = view('footerboot');
        

        $this->breadcrumb = [
            'Pages' => 'pages'
        ];

        $this->allComp = [
            'footerboot' => $this->footerboot, 
            'breadcrumb' => $this->breadcrumb
        ];
    }


    public function index()
    {   
        echo view('header',$this->allComp);
        echo view('sidebar');
        echo view('navbar');
        echo view('dashboard');
        echo view('footer');
    }
}

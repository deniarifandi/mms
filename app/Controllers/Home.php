<?php

namespace App\Controllers;

use App\Models\Students;

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
        // echo var_dump(class_exists('App\Models\Students'));

        // $userModel = new \App\Models\Students();
        $userModel = model(\App\Models\Students::class);
    }


    public function index()
    {   
        echo view('header',$this->allComp);
        echo view('sidebar');
        echo view('navbar');
        echo view('dashboard');
        echo view('footer');
    }

    public function getStudentsData(){

        // $data['students'] = $students->findAll();
        // echo json_encode($data['students']);
    }
}

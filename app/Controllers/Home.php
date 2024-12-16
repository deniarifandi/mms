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

        $Students = new \App\Models\Students();

        $data['students'] = $Students->findAll(); 
        echo json_encode($data['students']);
      
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

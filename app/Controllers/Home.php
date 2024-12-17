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
    private $Students;


    function __construct(){

        
        $this->footerboot = view('footerboot');
        $this->breadcrumb = [
            'Pages' => 'pages'
        ];
        $this->allComp = [
            'footerboot' => $this->footerboot, 
            'breadcrumb' => $this->breadcrumb
        ];

        $this->Students = new \App\Models\Students();
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

        $data['students'] = $this->Students->findColumn('student_name'); 
        echo json_encode($data['students']);


    }

    public function setStudentsData(){
        $data = [
            'student_name' => 'darth',
            'email'    => 'd.vader@theempire.com',
            'created_at' => date('Y-m-d H:i:s'),
        ];


        echo $this->Students->insert($data, false); 
        // echo $this->Students->getInsertID();
    }

    public function updateStudentData(){
        
        $job = $this->Students->find(145);
 
        $job['student_name'] = "nama_diedit";
        $job['email'] = "email edit";
        // $job['updated_at'] = date('Y-m-d H:i:s');


        echo $this->Students->save($job);
    }
}

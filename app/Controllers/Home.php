<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {   
        echo view('header');
        echo view('sidebar');
        echo view('dashboard');
        echo view('footer');
    }

    public function school_dashboard(){
        echo view('header');
        echo view('sidebar');
        echo view('school_dashboard');
        echo view('footer');
    }

    public function subject(){
        echo view('header');
        echo view('sidebar');
        echo view('subject/subject');
        echo view('footer');
    }

    public function objective(){
        echo view('header');
        echo view('sidebar');
        echo view('subject/objective');
        echo view('footer');   
    }

    public function grades(){
        echo view('header');
        echo view('sidebar');
        echo view('class/grades');
        echo view('footer');      
    }
}

<?php

namespace App\Controllers;

use App\Models\Student;

class Home extends BaseController
{
    private $aside;
    private $footerboot;
    private $navbar;
    private $allComp;
    private $breadcrumb;
    private $Students;
        private $db = null;


    function __construct(){

         $this->db = db_connect();
        $this->footerboot = view('footerboot');
        $this->breadcrumb = [
            'Pages' => 'pages'
        ];
        $this->allComp = [
            'footerboot' => $this->footerboot, 
            'breadcrumb' => $this->breadcrumb
        ];

        $this->Student = new \App\Models\Student();
    }




    public function index()
    {   

        $countStudents = $this->db->table('students')
        ->where('deleted_at',null)
        ->countAll();

        $countTeachers = $this->db->table('teachers')
        ->where('deleted_at',null)
        ->countAll();

        $countClasses = $this->db->table('classes')
        ->where('deleted_at',null)
        ->countAll();

        $countSubjects = $this->db->table('subjects')
        ->where('deleted_at',null)
        ->countAll();

        $countPedagogys = $this->db->table('pedagogys')
        ->where('deleted_at',null)
        ->countAll();

        $countMicrocredentials = $this->db->table('microcredentials')
        ->where('deleted_at',null)
        ->countAll();

        $countLessonPlans = $this->db->table('lesson_plans')
        ->where('deleted_at',null)
        ->countAll();

        $countCases = $this->db->table('cases')
        ->where('deleted_at',null)
        ->countAll();

         $countPresentations = $this->db->table('presentations')
        ->where('deleted_at',null)
        ->countAll();


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

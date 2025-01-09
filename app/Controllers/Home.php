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

    public function showLogin(){

        echo view('login');

    }

    public function checkLogin(){

        $session = session();

        $email = $_POST['email'];
        $pass = $_POST['pass'];

        $encPass = $this->enc($pass);

        $getAdmin = $this->db->table('administrator')
        ->where('email',$email)
        ->where('pass',$encPass)
        ->get()->getResult();

        if (count($getAdmin)>0) {
            echo "logged in";
            $session->set([
                'username' => $getAdmin[0]->administrator_name,
                'isLoggedIn' => true,
                'role' => "admin"
            ]);

            return redirect()->to(base_url());
        }else{

            $getTeacher = $this->db->table('teachers')
            ->where('email',$email)
            ->where('pass',$encPass)
            ->get()->getResult();

            if (count($getTeacher)>0) {

                $session->set([
                    'username' => $getTeacher[0]->teacher_name,
                    'isLoggedIn' => true,
                    'role' => "teacher"
                ]);

                return redirect()->to(base_url());
            }else{
                session()->setFlashdata('error', 'Invalid Username/Password');
                return redirect()->to(base_url('login'));
                
            }

            
        }

    }

    public function logout(){
        session()->destroy();
        return redirect()->to(base_url());
    }

    public function register(){

        $password = "digest25";

        echo $this->enc($password);

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

        $data = [
            'students' => $countStudents,
            'teachers' => $countTeachers,
            'classes' => $countClasses,
            'subjects' => $countSubjects,
            'pedagogys' => $countPedagogys,
            'microcredentials' => $countMicrocredentials,
            'lessonPlans' => $countLessonPlans,
            'cases' => $countCases,
            'presentations' => $countPresentations,
        ];


        echo view('header',$this->allComp);
        echo view('sidebar');
        echo view('navbar');
        echo view('dashboard',['data' => $data]);
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

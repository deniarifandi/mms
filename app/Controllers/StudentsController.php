<?php

namespace App\Controllers;

use App\Models\Student;

class StudentsController extends BaseController
{

    function __construct(){
        
        $this->Student = new \App\Models\Student();
        $data['successMessage'] = session()->getFlashdata('success');
        $data['errorMessage'] = session()->getFlashdata('error');

        $this->footerboot = view('footerboot');
        $this->breadcrumb = [
            'Pages' => 'pages'
        ];
        $this->allComp = [
            'footerboot' => $this->footerboot, 
            'breadcrumb' => $this->breadcrumb
        ];
    }

    public function index() {
        // Show list of items
        $students = $this->Student
        ->orderBy('student_id','desc')
        ->findAll();
        
        // echo json_encode($students);

        echo view('header',$this->allComp);
        echo view('sidebar');
        echo view('navbar');
        echo view('Students/index',['students' => $students]);
        echo view('footer');
    }

    public function show($id) {
        // Show a single item by ID
        $data = $this->Student->find($id);
        echo json_encode($data);
    }

    public function create() {
        // Show a form to create a new item
        echo view('header',$this->allComp);
        echo view('sidebar');
        echo view('navbar');
        echo view('Students/create');
        echo view('footer');
    }

    public function store() {
        // Store a newly created item in the database
        
        // $validation =  \Config\Services::validation();
        // $validation->setRules([
        //     'student_name' => 'required|min_length[5]',
        //     'email' => 'required|valid_email',
        // ]);

        // if (!$this->validate([
        //     'student_name'  => 'required|min_length[5]',
        //     'email' => 'required|valid_email',
        // ])) {
        //     // Store error message in flashdata
        //     session()->setFlashdata('error', 'Validation failed. Please check your input.');
        //     return redirect()->to(base_url('students/create'))->withInput()->with('validation', $validation);
        // }

        $this->Student->save([
            'student_name' => $this->request->getPost('student_name'),
            'email' => $this->request->getPost('email'),
        ]);

        return redirect()->to(base_url('students'));
    }

    public function edit($id) {
        // Show a form to edit an existing item
        // echo "testing";

        $data = $this->Student->find($id);


        echo view('header',$this->allComp);
        echo view('sidebar');
        echo view('navbar');
        echo view('Students/edit',["data" => $data]);
        echo view('footer');

    }

    public function update($id) {
        // Update the item in the database

        $data = [
            'student_name'  => $this->request->getPost('student_name'),
            'email' => $this->request->getPost('email')
        ];

        $this->Student->update($id, $data);
        session()->setFlashdata('success', 'Student Edited');
        return redirect()->to(base_url('students'));
    }

    public function delete($id) {
        // Delete the item from the database

        $this->Student->delete($id);
        session()->setFlashdata('success', 'Student Deleted');
        return redirect()->to(base_url('students'));
    }
   
}

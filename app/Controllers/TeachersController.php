<?php

namespace App\Controllers;

use App\Models\Teacher;

class TeachersController extends BaseController
{

    function __construct(){
        
        $this->Teachers = new \App\Models\Teacher();
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
        $teachers = $this->Teachers
        ->orderBy('teacher_id','desc')
        ->findAll();
        
        // echo json_encode($teachers);

        echo view('header',$this->allComp);
        echo view('sidebar');
        echo view('navbar');
        echo view('Teachers/index',['teachers' => $teachers]);
        echo view('footer');
    }

    public function show($id) {
        // Show a single item by ID
        $data = $this->Teachers->find($id);
        echo json_encode($data);
    }

    public function create() {
        // Show a form to create a new item
        echo view('header',$this->allComp);
        echo view('sidebar');
        echo view('navbar');
        echo view('Teachers/create');
        echo view('footer');
    }

    public function store() {
        // Store a newly created item in the database

        $this->Teachers->save([
            'teacher_name' => $this->request->getPost('teacher_name'),
            'email' => $this->request->getPost('email'),
            'pass' => $this->enc($this->request->getPost('pass')),
        ]);

        return redirect()->to(base_url('teachers'));
    }

    public function edit($id) {
        // Show a form to edit an existing item
        // echo "testing";

        $data = $this->Teachers->find($id);


        echo view('header',$this->allComp);
        echo view('sidebar');
        echo view('navbar');
        echo view('Teachers/edit',["data" => $data]);
        echo view('footer');

    }

    public function update($id) {
        // Update the item in the database

        if ($this->request->getPost('pass') == "unchanged") {
            $data = [
                'teacher_name'  => $this->request->getPost('teacher_name'),
                'email' => $this->request->getPost('email')
            ];
        }else{

            $data = [
                'teacher_name'  => $this->request->getPost('teacher_name'),
                'email' => $this->request->getPost('email'),
                'pass' => $this->enc($this->request->getPost('pass'))
            ];
        }

        

        $this->Teachers->update($id, $data);
        session()->setFlashdata('success', 'Teacher Edited');
        return redirect()->to(base_url('teachers'));
    }

    public function delete($id) {
        // Delete the item from the database

        $this->Teachers->delete($id);
        session()->setFlashdata('success', 'Teacher Deleted');
        return redirect()->to(base_url('teachers'));
    }
   
}

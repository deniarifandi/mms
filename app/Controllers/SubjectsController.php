<?php

namespace App\Controllers;

use App\Models\Subjects;

class SubjectsController extends BaseController
{

    function __construct(){
        
        $this->Subjects = new \App\Models\Subjects();
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
        $subjects = $this->Subjects
        ->orderBy('subject_id','desc')
        ->findAll();
        
        // echo json_encode($Subjects);

        echo view('header',$this->allComp);
        echo view('sidebar');
        echo view('navbar');
        echo view('Subjects/index',['subjects' => $subjects]);
        echo view('footer');
    }

    public function show($id) {
        // Show a single item by ID
        $data = $this->Subjects->find($id);
        echo json_encode($data);
    }

    public function create() {
        // Show a form to create a new item
        echo view('header',$this->allComp);
        echo view('sidebar');
        echo view('navbar');
        echo view('Subjects/create');
        echo view('footer');
    }

    public function store() {
        // Store a newly created item in the database
        
        // $validation =  \Config\Services::validation();
        // $validation->setRules([
        //     'subject_name' => 'required|min_length[5]',
        //     'email' => 'required|valid_email',
        // ]);

        // if (!$this->validate([
        //     'subject_name'  => 'required|min_length[5]',
        //     'email' => 'required|valid_email',
        // ])) {
        //     // Store error message in flashdata
        //     session()->setFlashdata('error', 'Validation failed. Please check your input.');
        //     return redirect()->to(base_url('Subjects/create'))->withInput()->with('validation', $validation);
        // }

        $this->Subjects->save([
            'subject_name' => $this->request->getPost('subject_name')
        ]);

        return redirect()->to(base_url('subjects'));
    }

    public function edit($id) {
        // Show a form to edit an existing item
        // echo "testing";

        $data = $this->Subjects->find($id);


        echo view('header',$this->allComp);
        echo view('sidebar');
        echo view('navbar');
        echo view('Subjects/edit',["data" => $data]);
        echo view('footer');

    }

    public function update($id) {
        // Update the item in the database

        $data = [
            'subject_name'  => $this->request->getPost('subject_name')
        ];

        $this->Subjects->update($id, $data);
        session()->setFlashdata('success', 'subject Edited');
        return redirect()->to(base_url('subjects'));
    }

    public function delete($id) {
        // Delete the item from the database

        $this->Subjects->delete($id);
        session()->setFlashdata('success', 'subject Deleted');
        return redirect()->to(base_url('subjects'));
    }
   
}

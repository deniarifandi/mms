<?php

namespace App\Controllers;

use App\Models\Classes;

class ClassesController extends BaseController
{

    function __construct(){
        
        $this->Classes = new \App\Models\Classes();
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
        $classes = $this->Classes
        ->orderBy('class_id','desc')
        ->findAll();
        
        // echo json_encode($Classes);

        echo view('header',$this->allComp);
        echo view('sidebar');
        echo view('navbar');
        echo view('Classes/index',['classes' => $classes]);
        echo view('footer');
    }

    public function show($id) {
        // Show a single item by ID
        $data = $this->Classes->find($id);
        echo json_encode($data);
    }

    public function create() {
        // Show a form to create a new item
        echo view('header',$this->allComp);
        echo view('sidebar');
        echo view('navbar');
        echo view('Classes/create');
        echo view('footer');
    }

    public function store() {
        // Store a newly created item in the database
        
        // $validation =  \Config\Services::validation();
        // $validation->setRules([
        //     'class_name' => 'required|min_length[5]',
        //     'email' => 'required|valid_email',
        // ]);

        // if (!$this->validate([
        //     'class_name'  => 'required|min_length[5]',
        //     'email' => 'required|valid_email',
        // ])) {
        //     // Store error message in flashdata
        //     session()->setFlashdata('error', 'Validation failed. Please check your input.');
        //     return redirect()->to(base_url('Classes/create'))->withInput()->with('validation', $validation);
        // }

        $this->Classes->save([
            'class_name' => $this->request->getPost('class_name')
        ]);

        return redirect()->to(base_url('classes'));
    }

    public function edit($id) {
        // Show a form to edit an existing item
        // echo "testing";

        $data = $this->Classes->find($id);


        echo view('header',$this->allComp);
        echo view('sidebar');
        echo view('navbar');
        echo view('Classes/edit',["data" => $data]);
        echo view('footer');

    }

    public function update($id) {
        // Update the item in the database

        $data = [
            'class_name'  => $this->request->getPost('class_name')
        ];

        $this->Classes->update($id, $data);
        session()->setFlashdata('success', 'Class Edited');
        return redirect()->to(base_url('classes'));
    }

    public function delete($id) {
        // Delete the item from the database

        $this->Classes->delete($id);
        session()->setFlashdata('success', 'class Deleted');
        return redirect()->to(base_url('classes'));
    }
   
}

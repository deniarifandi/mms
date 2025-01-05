<?php

namespace App\Controllers;

use App\Models\Subject;

class SubjectsController extends BaseController
{

    function __construct(){
        
        $this->Subject = new \App\Models\Subject();
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
        $subjects = $this->Subject
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
        $data = $this->Subject->find($id);
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


        $this->Subject->save([
            'subject_name' => $this->request->getPost('subject_name'),
            'description' => $this->request->getPost('description')
        ]);

        return redirect()->to(base_url('subjects'));
    }

    public function edit($id) {
        // Show a form to edit an existing item
        // echo "testing";

        $data = $this->Subject->find($id);


        echo view('header',$this->allComp);
        echo view('sidebar');
        echo view('navbar');
        echo view('Subjects/edit',["data" => $data]);
        echo view('footer');

    }

    public function update($id) {
        // Update the item in the database

        $data = [
            'subject_name'  => $this->request->getPost('subject_name'),
            'description' => $this->request->getPost('description')
        ];

        $this->Subject->update($id, $data);
        session()->setFlashdata('success', 'subject Edited');
        return redirect()->to(base_url('subjects'));
    }

    public function delete($id) {
        // Delete the item from the database

        $this->Subject->delete($id);
        session()->setFlashdata('success', 'subject Deleted');
        return redirect()->to(base_url('subjects'));
    }
   
}

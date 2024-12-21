<?php

namespace App\Controllers;

use App\Models\Objective;

class ObjectivesController extends BaseController
{

    function __construct(){
        
        $this->Objective = new \App\Models\Objective();
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
        $objectives = $this->Objective
        ->orderBy('objective_id','desc')
        ->findAll();
        
        // echo json_encode($Objectives);

        echo view('header',$this->allComp);
        echo view('sidebar');
        echo view('navbar');
        echo view('Objectives/index',['objectives' => $objectives]);
        echo view('footer');
    }

    public function show($id) {
        // Show a single item by ID
        $data = $this->Objective->find($id);
        echo json_encode($data);
    }

    public function create() {
        // Show a form to create a new item
        echo view('header',$this->allComp);
        echo view('sidebar');
        echo view('navbar');
        echo view('Objectives/create');
        echo view('footer');
    }

    public function store() {
        // Store a newly created item in the database
        
        // $validation =  \Config\Services::validation();
        // $validation->setRules([
        //     'objective_description' => 'required|min_length[5]',
        //     'email' => 'required|valid_email',
        // ]);

        // if (!$this->validate([
        //     'objective_description'  => 'required|min_length[5]',
        //     'email' => 'required|valid_email',
        // ])) {
        //     // Store error message in flashdata
        //     session()->setFlashdata('error', 'Validation failed. Please check your input.');
        //     return redirect()->to(base_url('Objectives/create'))->withInput()->with('validation', $validation);
        // }

        $this->Objective->save([
            'objective_description' => $this->request->getPost('objective_description')
        ]);

        return redirect()->to(base_url('objectives'));
    }

    public function edit($id) {
        // Show a form to edit an existing item
        // echo "testing";

        $data = $this->Objective->find($id);


        echo view('header',$this->allComp);
        echo view('sidebar');
        echo view('navbar');
        echo view('Objectives/edit',["data" => $data]);
        echo view('footer');

    }

    public function update($id) {
        // Update the item in the database

        $data = [
            'objective_description'  => $this->request->getPost('objective_description')
        ];

        $this->Objective->update($id, $data);
        session()->setFlashdata('success', 'objective Edited');
        return redirect()->to(base_url('objectives'));
    }

    public function delete($id) {
        // Delete the item from the database

        $this->Objective->delete($id);
        session()->setFlashdata('success', 'objective Deleted');
        return redirect()->to(base_url('objectives'));
    }
   
}

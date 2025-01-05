<?php

namespace App\Controllers;

use App\Models\Cases;

class CasesController extends BaseController
{

    function __construct(){
        
        $this->Cases = new \App\Models\Cases();
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
        $cases = $this->Cases
        ->orderBy('case_id','desc')
        ->findAll();
        
        // echo json_encode($cases);

        echo view('header',$this->allComp);
        echo view('sidebar');
        echo view('navbar');
        echo view('cases/index',['cases' => $cases]);
        echo view('footer');
    }

    public function show($id) {
        // Show a single item by ID
        $data = $this->Cases->find($id);
        echo json_encode($data);
    }

    public function create() {
        // Show a form to create a new item
        echo view('header',$this->allComp);
        echo view('sidebar');
        echo view('navbar');
        echo view('Cases/create');
        echo view('footer');
    }

    public function store() {
        // Store a newly created item in the database
        
        // $validation =  \Config\Services::validation();
        // $validation->setRules([
        //     'case_name' => 'required|min_length[5]',
        //     'email' => 'required|valid_email',
        // ]);

        // if (!$this->validate([
        //     'case_name'  => 'required|min_length[5]',
        //     'email' => 'required|valid_email',
        // ])) {
        //     // Store error message in flashdata
        //     session()->setFlashdata('error', 'Validation failed. Please check your input.');
        //     return redirect()->to(base_url('cases/create'))->withInput()->with('validation', $validation);
        // }

        $this->Cases->save([
            'case_study' => $this->request->getPost('case_study'),
          
        ]);

        return redirect()->to(base_url('cases'));
    }

    public function edit($id) {
        // Show a form to edit an existing item
        // echo "testing";

        $data = $this->Cases->find($id);


        echo view('header',$this->allComp);
        echo view('sidebar');
        echo view('navbar');
        echo view('Cases/edit',["data" => $data]);
        echo view('footer');

    }

    public function update($id) {
        // Update the item in the database

        $data = [
            'case_study'  => $this->request->getPost('case_study')
            
        ];

        $this->Cases->update($id, $data);
        session()->setFlashdata('success', 'Case Edited');
        return redirect()->to(base_url('cases'));
    }

    public function delete($id) {
        // Delete the item from the database

        $this->Cases->delete($id);
        session()->setFlashdata('success', 'Case Deleted');
        return redirect()->to(base_url('cases'));
    }
   
}

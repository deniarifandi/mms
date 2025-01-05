<?php

namespace App\Controllers;

use App\Models\Pedagogy;

class PedagogysController extends BaseController
{

    function __construct(){
        
        $this->Pedagogys = new \App\Models\Pedagogy();
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
        $pedagogys = $this->Pedagogys
        ->orderBy('pedagogy_id','desc')
        ->findAll();
        
        // echo json_encode($pedagogys);

        echo view('header',$this->allComp);
        echo view('sidebar');
        echo view('navbar');
        echo view('pedagogys/index',['pedagogys' => $pedagogys]);
        echo view('footer');
    }

    public function show($id) {
        // Show a single item by ID
        $data = $this->Pedagogys->find($id);
        echo json_encode($data);
    }

    public function create() {
        // Show a form to create a new item
        echo view('header',$this->allComp);
        echo view('sidebar');
        echo view('navbar');
        echo view('Pedagogys/create');
        echo view('footer');
    }

    public function store() {
      

        $this->Pedagogys->save([
            'pedagogy' => $this->request->getPost('pedagogy')
        ]);

        return redirect()->to(base_url('pedagogys'));
    }

    public function edit($id) {
        // Show a form to edit an existing item
        // echo "testing";

        $data = $this->Pedagogys->find($id);


        echo view('header',$this->allComp);
        echo view('sidebar');
        echo view('navbar');
        echo view('Pedagogys/edit',["data" => $data]);
        echo view('footer');

    }

    public function update($id) {
        // Update the item in the database

        $data = [
            'pedagogy'  => $this->request->getPost('pedagogy')
        ];

        $this->Pedagogys->update($id, $data);
        session()->setFlashdata('success', 'Pedagogy Edited');
        return redirect()->to(base_url('pedagogys'));
    }

    public function delete($id) {
        // Delete the item from the database

        $this->Pedagogys->delete($id);
        session()->setFlashdata('success', 'Pedagogy Deleted');
        return redirect()->to(base_url('pedagogys'));
    }
   
}

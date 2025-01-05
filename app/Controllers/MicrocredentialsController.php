<?php

namespace App\Controllers;

use App\Models\Microcredential;

class MicrocredentialsController extends BaseController
{

    function __construct(){
        
        $this->Microcredentials = new \App\Models\Microcredential();
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
        $microcredentials = $this->Microcredentials
        ->orderBy('microcredential_id','desc')
        ->findAll();
        
        // echo json_encode($microcredentials);

        echo view('header',$this->allComp);
        echo view('sidebar');
        echo view('navbar');
        echo view('Microcredentials/index',['microcredentials' => $microcredentials]);
        echo view('footer');
    }

    public function show($id) {
        // Show a single item by ID
        $data = $this->Microcredentials->find($id);
        echo json_encode($data);
    }

    public function create() {
        // Show a form to create a new item
        echo view('header',$this->allComp);
        echo view('sidebar');
        echo view('navbar');
        echo view('Microcredentials/create');
        echo view('footer');
    }

    public function store() {

        $this->Microcredentials->save([
            'microcredential' => $this->request->getPost('microcredential'),
        ]);

        return redirect()->to(base_url('microcredentials'));
    }

    public function edit($id) {
        // Show a form to edit an existing item
        // echo "testing";

        $data = $this->Microcredentials->find($id);

        echo view('header',$this->allComp);
        echo view('sidebar');
        echo view('navbar');
        echo view('Microcredentials/edit',["data" => $data]);
        echo view('footer');

    }

    public function update($id) {
        // Update the item in the database

        $data = [
            'microcredential'  => $this->request->getPost('microcredential')
        ];

        $this->Microcredentials->update($id, $data);
        session()->setFlashdata('success', 'Microcredential Edited');
        return redirect()->to(base_url('microcredentials'));
    }

    public function delete($id) {
        // Delete the item from the database

        $this->Microcredentials->delete($id);
        session()->setFlashdata('success', 'Microcredential Deleted');
        return redirect()->to(base_url('microcredentials'));
    }
   
}

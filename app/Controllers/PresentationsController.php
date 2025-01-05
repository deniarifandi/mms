<?php

namespace App\Controllers;

use App\Models\Presentation;

class PresentationsController extends BaseController
{

    function __construct(){
        
        $this->Presentations = new \App\Models\Presentation();
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
        $presentations = $this->Presentations
        ->orderBy('presentation_id','desc')
        ->findAll();
        
        // echo json_encode($presentations);

        echo view('header',$this->allComp);
        echo view('sidebar');
        echo view('navbar');
        echo view('presentations/index',['presentations' => $presentations]);
        echo view('footer');
    }

    public function show($id) {
        // Show a single item by ID
        $data = $this->Presentations->find($id);
        echo json_encode($data);
    }

    public function create() {
        // Show a form to create a new item
        echo view('header',$this->allComp);
        echo view('sidebar');
        echo view('navbar');
        echo view('Presentations/create');
        echo view('footer');
    }

    public function store() {
    
        $this->Presentations->save([
            'presentation' => $this->request->getPost('presentation')
        ]);

        return redirect()->to(base_url('presentations'));
    }

    public function edit($id) {
        // Show a form to edit an existing item
        // echo "testing";

        $data = $this->Presentations->find($id);


        echo view('header',$this->allComp);
        echo view('sidebar');
        echo view('navbar');
        echo view('Presentations/edit',["data" => $data]);
        echo view('footer');

    }

    public function update($id) {
        // Update the item in the database

        $data = [
            'presentation'  => $this->request->getPost('presentation')
        ];

        $this->Presentations->update($id, $data);
        session()->setFlashdata('success', 'Presentation Edited');
        return redirect()->to(base_url('presentations'));
    }

    public function delete($id) {
        // Delete the item from the database

        $this->Presentations->delete($id);
        session()->setFlashdata('success', 'Presentation Deleted');
        return redirect()->to(base_url('presentations'));
    }
   
}

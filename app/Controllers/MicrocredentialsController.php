<?php

namespace App\Controllers;

use App\Models\Microcredential;

class MicrocredentialsController extends BaseController
{

    function __construct(){
        
        $this->Microcredentials = new \App\Models\Microcredential();
          $this->subject = new \App\Models\Subject();
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
         $subjects = $this->subject->findAll();

        echo view('header',$this->allComp);
        echo view('sidebar');
        echo view('navbar');
        echo view('Microcredentials/create',['subjects'=> $subjects]);
        echo view('footer');
    }

    public function store() {

          $subject_id = $this->request->getPost('subject_id');
        $file = $this->request->getFile('file');
        $newName = null;
        $path = WRITEPATH . 'uploads/microcredentials/';


        $this->Microcredentials->save([
            'microcredential' => $this->request->getPost('microcredential'),
            'subject_id' => $subject_id,
            'description' => $this->request->getPost('description')
        ]);

        return redirect()->to(base_url('microcredentials'));
    }

    public function edit($id) {
        // Show a form to edit an existing item
        // echo "testing";

        $data = $this->Microcredentials->find($id);
        $subjects = $this->subject->findAll();

        echo view('header',$this->allComp);
        echo view('sidebar');
        echo view('navbar');
        echo view('Microcredentials/edit',["data" => $data, "subjects" => $subjects]);
        echo view('footer');

    }

    public function update($id) {
        // Update the item in the database

        $subject_id = $this->request->getPost('subject_id');
        
        $data = [
            'microcredential'  => $this->request->getPost('microcredential'),
            'subject_id' => $subject_id,
            'description' => $this->request->getPost('description')
          
        ];

        $this->Microcredentials->update($id, $data);
        session()->setFlashdata('success', 'FAQ Edited');
        return redirect()->to(base_url('microcredentials'));
    }

    public function delete($id) {
        // Delete the item from the database

        $this->Microcredentials->delete($id);
        session()->setFlashdata('success', 'FAQ Deleted');
        return redirect()->to(base_url('microcredentials'));
    }

      public function view($filename){

        $path = WRITEPATH . 'uploads/microcredentials/'. $filename;
        if (file_exists($path)) {
            return $this->response->setContentType(mime_content_type($path))->setBody(file_get_contents($path));
        }
        throw new \CodeIgniter\Exceptions\PageNotFoundException("File not found: $filename");

    }
   
}

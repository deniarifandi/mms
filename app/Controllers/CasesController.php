<?php

namespace App\Controllers;

use App\Models\Cases;

class CasesController extends BaseController
{

    function __construct(){
        
        $this->Cases = new \App\Models\Cases();
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
        $cases = $this->Cases
        ->orderBy('case_id','desc')
        ->join('subjects','cases.subject_id = subjects.subject_id')
        ->where('subjects.deleted_at',null)
        ->findAll();
        
        // echo json_encode($cases);

        echo view('header',$this->allComp);
        echo view('sidebar');
        echo view('navbar');
        echo view('Cases/index',['cases' => $cases]);
        echo view('footer');
    }

    public function show($id) {
        // Show a single item by ID
        $data = $this->Cases->find($id);
        echo json_encode($data);
    }

    public function create() {

        $subjects = $this->subject->findAll();
        // Show a form to create a new item
        echo view('header',$this->allComp);
        echo view('sidebar');
        echo view('navbar');
        echo view('Cases/create',['subjects'=> $subjects]);
        echo view('footer');
    }

    public function store() {
        
        $subject_id = $this->request->getPost('subject_id');
        $file = $this->request->getFile('file');
        $newName = null;
        $path = WRITEPATH . 'uploads/' . $subject_id;

        if ($file->getError() != UPLOAD_ERR_NO_FILE) {

            $newName = $this->uploadFile($file,$path);
            // print_r($newName);
            // echo $newName['file'];
            if (isset($newName['file'])) {
                session()->setFlashdata('error', $newName['file']);
                return redirect()->back()->withInput(); // Redirect back to the form with input data
            }
            
        }

        $this->Cases->save([
            'case_study' => $this->request->getPost('case_study'),
            'subject_id' => $subject_id,
            'description' => $this->request->getPost('description'),
            'file' => $newName,  // Store the file name in the database
        ]);

         // Set a success message
        session()->setFlashdata('success', 'Case Created');

        return redirect()->to(base_url('cases'));
    }

    public function edit($id) {
        // Show a form to edit an existing item
        // echo "testing";
        $subjects = $this->subject->findAll();
        $data = $this->Cases->find($id);


        echo view('header',$this->allComp);
        echo view('sidebar');
        echo view('navbar');
        echo view('Cases/edit',["data" => $data, "subjects" => $subjects]);
        echo view('footer');

    }

    public function update($id) {
        // Update the item in the database
        
        $subject_id = $this->request->getPost('subject_id');
        $file = $this->request->getFile('file');
        
        $path = WRITEPATH . 'uploads/' . $subject_id;
        $newName = $this->request->getPost('currentFile');

        if ($file->getError() != UPLOAD_ERR_NO_FILE) {

            $newName = $this->uploadFile($file,$path);
            // print_r($newName);
            // echo $newName['file'];
            if (isset($newName['file'])) {
                session()->setFlashdata('error', $newName['file']);
                return redirect()->back()->withInput(); // Redirect back to the form with input data
            }
            
        }

        $data = [
            'case_study'  => $this->request->getPost('case_study'),
            'subject_id' => $subject_id,
            'description' => $this->request->getPost('description'),
            'file' => $newName
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

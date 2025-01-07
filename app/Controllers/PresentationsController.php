<?php

namespace App\Controllers;

use App\Models\Presentation;

class PresentationsController extends BaseController
{

    function __construct(){
        
        $this->Presentations = new \App\Models\Presentation();
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
        $presentations = $this->Presentations
        ->orderBy('presentation_id','desc')
        ->join('subjects','presentations.subject_id = subjects.subject_id')
        ->where('subjects.deleted_at',null)
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
        $subjects = $this->subject->findAll();
        // Show a form to create a new item
        echo view('header',$this->allComp);
        echo view('sidebar');
        echo view('navbar');
        echo view('Presentations/create',['subjects'=> $subjects]);
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

        $this->Presentations->save([
            'presentation' => $this->request->getPost('presentation'),
            'subject_id' => $subject_id,
            'description' => $this->request->getPost('description'),
            'file' => $newName,  // Store the file name in the database
        ]);

        session()->setFlashdata('success', 'Presentation Created');
        return redirect()->to(base_url('presentations'));
    }

    public function edit($id) {
        // Show a form to edit an existing item
        // echo "testing";
         $subjects = $this->subject->findAll();
        $data = $this->Presentations->find($id);


        echo view('header',$this->allComp);
        echo view('sidebar');
        echo view('navbar');
        echo view('Presentations/edit',["data" => $data,"subjects"=>$subjects]);
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
            'presentation'  => $this->request->getPost('presentation'),
            'subject_id' => $subject_id,
            'description' => $this->request->getPost('description'),
            'file' => $newName
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

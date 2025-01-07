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

        $file = $this->request->getFile('file');
        $newName = null;
        $path = WRITEPATH . 'uploads/subjectImage/';

        if ($file->getError() != UPLOAD_ERR_NO_FILE) {

            $newName = $this->uploadImage($file,$path);
            
            if (isset($newName['file'])) {
                session()->setFlashdata('error', $newName['file']);
                return redirect()->back()->withInput(); // Redirect back to the form with input data
            }
        }

        $this->Subject->save([
            'subject_name' => $this->request->getPost('subject_name'),
            'description' => $this->request->getPost('description'),
            'image' => $newName
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
        $file = $this->request->getFile('file');
        $newName = null;
        $path = WRITEPATH . 'uploads/subjectImage/';
        $newName = $this->request->getPost('currentFile');
        if ($file->getError() != UPLOAD_ERR_NO_FILE) {

            $newName = $this->uploadImage($file,$path);
            
            if (isset($newName['file'])) {
                session()->setFlashdata('error', $newName['file']);
                return redirect()->back()->withInput(); // Redirect back to the form with input data
            }
        }

        $data = [
            'subject_name'  => $this->request->getPost('subject_name'),
            'description' => $this->request->getPost('description'),
            'image' => $newName
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

    public function view($filename){
        
         $imagePath = WRITEPATH . 'uploads/subjectImage/'.$filename;

        // Check if the file exists
        if (!file_exists($imagePath)) {
            // Return 404 response if file not found
            return $this->response->setStatusCode(404, 'Image not found');
        }

        // Get the file's mime type
        $mimeType = mime_content_type($imagePath);

        // Set the response headers and send the image
        return $this->response
            ->setContentType($mimeType)
            ->setBody(file_get_contents($imagePath));
    }
   
}

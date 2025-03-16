<?php

namespace App\Controllers;

use App\Models\Pedagogy;

class PedagogysController extends BaseController
{

    function __construct(){
        
        $this->Pedagogys = new \App\Models\Pedagogy();
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
        $pedagogys = $this->Pedagogys
        ->orderBy('pedagogy_id','desc')
        ->join('subjects','pedagogys.subject_id = subjects.subject_id')
        ->where('subjects.deleted_at',null)
        ->findAll();

        echo view('header',$this->allComp);
        echo view('sidebar');
        echo view('navbar');
        echo view('Pedagogys/index',['pedagogys' => $pedagogys]);
        echo view('footer');
    }

    public function show($id) {
        // Show a single item by ID
        $data = $this->Pedagogys->find($id);
        echo json_encode($data);
    }

    public function create() {

         $subjects = $this->subject->findAll();
        // Show a form to create a new item
        echo view('header',$this->allComp);
        echo view('sidebar');
        echo view('navbar');
        echo view('Pedagogys/create',['subjects'=> $subjects]);
        echo view('footer');
    }

    public function store() {
        
        $subject_id = $this->request->getPost('subject_id');
        $file = $this->request->getFile('file');
        $newName = null;
        $path = base_url() . 'assets/video/';

        if ($file->getError() != UPLOAD_ERR_NO_FILE) {

            $newName = $this->uploadVideo($file,$path);
        
            if (isset($newName['file'])) {
                session()->setFlashdata('error', $newName['file']);
                return redirect()->back()->withInput(); // Redirect back to the form with input data
            }
            
        }

        $this->Pedagogys->save([
            'pedagogy' => $this->request->getPost('pedagogy'),
            'subject_id' => $subject_id,
            'description' => $this->request->getPost('description'),
            'file' => $newName  // Store the file name in the database
        ]);

        session()->setFlashdata('success', 'EMI Videos Created');

        return redirect()->to(base_url('pedagogys'));
    }

    public function edit($id) {
        // Show a form to edit an existing item
        // echo "testing";
        $subjects = $this->subject->findAll();
        $data = $this->Pedagogys->find($id);


        echo view('header',$this->allComp);
        echo view('sidebar');
        echo view('navbar');
        echo view('Pedagogys/edit',["data" => $data,"subjects" => $subjects]);
        echo view('footer');

    }

    public function update($id) {
        // Update the item in the database

        $subject_id = $this->request->getPost('subject_id');
        $file = $this->request->getFile('file');
        
        $path = FCPATH . 'assets/video/';
        $newName = $this->request->getPost('currentFile');

        if ($file->getError() != UPLOAD_ERR_NO_FILE) {

            $newName = $this->uploadVideo($file,$path);
          
            if (isset($newName['file'])) {
                session()->setFlashdata('error', $newName['file']);
                return redirect()->back()->withInput(); // Redirect back to the form with input data
            }
            
        }

        $data = [
            'pedagogy'  => $this->request->getPost('pedagogy'),
            'subject_id' => $subject_id,
            'description' => $this->request->getPost('description'),
            'file' => $newName
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

    public function deletevideo($filename)
    {
        $path = FCPATH . 'assets/video/'.$filename;

        if (file_exists($path)) {
            unlink($path);
            return $this->response->setJSON(['status' => 'success', 'message' => 'File deleted successfully']);
        }

        return $this->response->setJSON(['status' => 'error', 'message' => 'File not found']);
    }

    public function streamVideo($filename)
    {
        $path = WRITEPATH . 'uploads/pedagogys/' . $filename;

        if (file_exists($path)) {
            return $this->response
                ->setContentType(mime_content_type($path))
                ->setBody(file_get_contents($path));
        }

        throw new \CodeIgniter\Exceptions\PageNotFoundException("File not found: $filename");
    }

    public function streaming(){

        $video = $_GET['video'];
        return view("Pedagogys/streaming",["video" => $video]);

    }

      public function view($filename){

        $path = WRITEPATH . 'uploads/pedagogys/'. $filename;
        if (file_exists($path)) {
            return $this->response->setContentType(mime_content_type($path))->setBody(file_get_contents($path));
            // $data['video_url'] = file_get_contents($path);
            // return view("Pedagogys/streaming", $data);
        }
        echo "not found";
        // throw new \CodeIgniter\Exceptions\PageNotFoundException("File not found: $filename");

    }
   
   
}

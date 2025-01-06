<?php

namespace App\Controllers;

use App\Models\lessonPlan;
use App\Models\Subject;

class LessonPlansController extends BaseController
{

    function __construct(){
        
        $this->lessonPlan = new \App\Models\lessonPlan();
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
        $lessonPlans = $this->lessonPlan
        ->orderBy('lessonPlan_id','desc')
        ->join('subjects','lesson_plans.subject_id = subjects.subject_id')
        ->where('subjects.deleted_at',null)
        ->orderBy('lessonPlan_id','desc')
        ->findAll();
        
        // echo json_encode($lessonPlan);

        echo view('header',$this->allComp);
        echo view('sidebar');
        echo view('navbar');
        echo view('LessonPlans/index',['lessonPlans' => $lessonPlans]);
        echo view('footer');
    }

    public function show($id) {
        // Show a single item by ID
        $data = $this->lessonPlan->find($id);
        echo json_encode($data);
    }

    public function create() {
        // Show a form to create a new item

        $subjects = $this->subject->findAll();
        echo view('header',$this->allComp);
        echo view('sidebar');
        echo view('navbar');
        echo view('LessonPlans/create',['subjects'=> $subjects]);
        echo view('footer');
    }

    public function store() {

        $subject_id = $this->request->getPost('subject_id');
        $file = $this->request->getFile('file');
        $newName = null;
        $path = WRITEPATH . 'uploads/' . $subject_id;

        if ($file->getError() != UPLOAD_ERR_NO_FILE) {
            $newName = $this->uploadFile($file,$path);
        }

        // Save lesson plan data in the database
        $this->lessonPlan->save([
            'lessonPlan_title' => $this->request->getPost('lessonPlan_title'),
            'subject_id' => $subject_id,
            'description' => $this->request->getPost('description'),
            'file' => $newName,  // Store the file name in the database
        ]);

        // Set a success message
        session()->setFlashdata('success', 'Lesson Plan Created');

        // Redirect to the lesson plans page
        return redirect()->to(base_url('lesson-plans'));
                
    }

    public function edit($id) {
        // Show a form to edit an existing item
        // echo "testing";

        $subjects = $this->subject->findAll();
        $data = $this->lessonPlan->find($id);


        echo view('header',$this->allComp);
        echo view('sidebar');
        echo view('navbar');
        echo view('LessonPlans/edit',["data" => $data, "subjects" => $subjects]);
        echo view('footer');

    }

    public function uploadFile($file,$path){

        // Validation rules
        $rules = [
            'file' => [
                'label' => 'File',
                'rules' => 'uploaded[file]|max_size[file,1024]|ext_in[file,doc,docx,ppt,pptx,pdf]', // Max size in KB, allowed extensions
            ],
        ];

        // Validate the file input
        if (!$this->validate($rules)) {
            // If validation fails, set flashdata error and return to the form
            session()->setFlashdata('error', $this->validator->getErrors());
            return redirect()->back()->withInput(); // Redirect back to the form with input data
        }

        if ($file->isValid() && !$file->hasMoved()) {
            // Generate a random name for the file
            $newName = $file->getRandomName();

            // Ensure the target directory exists
            $uploadPath = $path;
            if (!is_dir($uploadPath)) {
                mkdir($uploadPath, 0777, true); // Create directory if it doesn't exist
            }

            // Move the uploaded file to the target directory
            $file->move($uploadPath, $newName);
        } else {
            // Handle error if the file is not valid
            session()->setFlashdata('error', 'File upload failed.');
            return redirect()->back()->withInput(); // Redirect back to the form with input data
        }

        return $newName;
    }

    public function update($id) {
        // Update the item in the database

        $subject_id = $this->request->getPost('subject_id');
        $file = $this->request->getFile('file');
        
        $path = WRITEPATH . 'uploads/' . $subject_id;
        $newName = $this->request->getPost('currentFile');

        // echo $newName;
        
        if ($file->getError() != UPLOAD_ERR_NO_FILE) {
            $newName = $this->uploadFile($file,$path);
        }

        $data = [
            'lessonPlan_title' => $this->request->getPost('lessonPlan_title'),
            'subject_id' => $subject_id,
            'description' => $this->request->getPost('description'),
            'file' => $newName
        ];

        $this->lessonPlan->update($id, $data);

        session()->setFlashdata('success', 'Lesson Plan Edited');
        return redirect()->to(base_url('lesson-plans'));
    }

    public function delete($id) {
        // Delete the item from the database

        $this->lessonPlan->delete($id);
        session()->setFlashdata('success', 'Lesson Plan Deleted');
        return redirect()->to(base_url('lesson-plans'));
    }

    public function view($subject_id,$filename){

        $path = WRITEPATH . 'uploads/'.$subject_id.'/'. $filename;
        if (file_exists($path)) {
            return $this->response->setContentType(mime_content_type($path))->setBody(file_get_contents($path));
        }
        throw new \CodeIgniter\Exceptions\PageNotFoundException("File not found: $filename");

    }
   
}

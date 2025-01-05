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

        $this->lessonPlan->save([
            'lessonPlan_title' => $this->request->getPost('lessonPlan_title'),
            'subject_id' => $this->request->getPost('subject_id'),
            'description' => $this->request->getPost('description'),
            'file' => $this->request->getPost('file')
        ]);


        return redirect()->to(base_url('lesson-plans'));
    }

    public function edit($id) {
        // Show a form to edit an existing item
        // echo "testing";

        $data = $this->lessonPlan->find($id);


        echo view('header',$this->allComp);
        echo view('sidebar');
        echo view('navbar');
        echo view('LessonPlans/edit',["data" => $data]);
        echo view('footer');

    }

    public function update($id) {
        // Update the item in the database

        $data = [
            'lessonPlan_title'  => $this->request->getPost('lessonPlan_title'),
            'subject_id' => $this->request->getPost('subject_id'),
            'description' => $this->request->getPost('description'),
            'file' => $this->request->getPost('file')
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
   
}

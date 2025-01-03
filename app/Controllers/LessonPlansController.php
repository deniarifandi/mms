<?php

namespace App\Controllers;

use App\Models\lessonPlan;

class LessonPlansController extends BaseController
{

    function __construct(){
        
        $this->lessonPlan = new \App\Models\lessonPlan();
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
        echo view('header',$this->allComp);
        echo view('sidebar');
        echo view('navbar');
        echo view('LessonPlans/create');
        echo view('footer');
    }

    public function store() {
        // Store a newly created item in the database
        
        // $validation =  \Config\Services::validation();
        // $validation->setRules([
        //     'lessonPlan_name' => 'required|min_length[5]',
        //     'email' => 'required|valid_email',
        // ]);

        // if (!$this->validate([
        //     'lessonPlan_name'  => 'required|min_length[5]',
        //     'email' => 'required|valid_email',
        // ])) {
        //     // Store error message in flashdata
        //     session()->setFlashdata('error', 'Validation failed. Please check your input.');
        //     return redirect()->to(base_url('lesson-plans/create'))->withInput()->with('validation', $validation);
        // }

        $this->lessonPlan->save([
            'lessonPlan_title' => $this->request->getPost('lessonPlan_title')
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
            'lessonPlan_title'  => $this->request->getPost('lessonPlan_title')
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

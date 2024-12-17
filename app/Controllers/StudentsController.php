<?php

namespace App\Controllers;

use App\Models\Students;

class StudentsController extends BaseController
{

    function __construct(){
        require_once APPPATH . 'Libraries/ssp.class.php';
        $this->Students = new \App\Models\Students();
        $data['successMessage'] = session()->getFlashdata('success');
        $data['errorMessage'] = session()->getFlashdata('error');
    }

    public function index() {
        // Show list of items
        $data = $this->Students->findAll();
        echo json_encode($data);
    }

    public function show($id) {
        // Show a single item by ID
        $data = $this->Students->find($id);
        echo json_encode($data);
    }

    public function create() {
        // Show a form to create a new item
         return view('Students/create');
    }

    public function store() {
        // Store a newly created item in the database

        $validation =  \Config\Services::validation();
        $validation->setRules([
            'student_name' => 'required|min_length[5]',
            'email' => 'required|valid_email',
        ]);

        if (!$this->validate([
            'student_name'  => 'required|min_length[5]',
            'email' => 'required|valid_email',
        ])) {
            // Store error message in flashdata
            session()->setFlashdata('error', 'Validation failed. Please check your input.');
            return redirect()->to(base_url('students/create'))->withInput()->with('validation', $validation);
        }

        $this->Students->save([
            'student_name' => $this->request->getPost('student_name'),
            'email' => $this->request->getPost('email'),
        ]);

        return redirect()->to(base_url('students'));
    }

    public function edit($id) {
        // Show a form to edit an existing item
    }

    public function update($id) {
        // Update the item in the database
    }

    public function delete($id) {
        // Delete the item from the database
    }
   
}

<?php 
namespace App\Libraries;
use Config\Services;

class fileManager
{
     public function validateFile($file)
    {
        $validation = Services::validation();

        $rules = [
            'uploaded[file]' => 'The file must be uploaded.',
            'max_size[file,2048]' => 'The file size must not exceed 2MB.',
            'ext_in[file,jpg,png,pdf]' => 'Invalid file extension.',
        ];

        $validation->setRules($rules);

        if (!$validation->run(['file' => $file])) {
            return $validation->getErrors();
        }

        return true; // Validation passed
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
        if (!$this->validation($rules)) {
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
}
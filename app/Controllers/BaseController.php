<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 */
abstract class BaseController extends Controller
{
    /**
     * Instance of the main Request object.
     *
     * @var CLIRequest|IncomingRequest
     */
    protected $request;

    /**
     * An array of helpers to be loaded automatically upon
     * class instantiation. These helpers will be available
     * to all other controllers that extend BaseController.
     *
     * @var list<string>
     */
    protected $helpers = [];

    /**
     * Be sure to declare properties for any property fetch you initialized.
     * The creation of dynamic property is deprecated in PHP 8.2.
     */
    // protected $session;

    /**
     * @return void
     */
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        // Do Not Edit This Line
        parent::initController($request, $response, $logger);

        
        // Preload any models, libraries, etc, here.

        // E.g.: $this->session = \Config\Services::session();
    }

     public function uploadFile($file,$path){

          // Validation rules
        $rules = [
            'file' => [
                'label' => 'File',
                'rules' => 'uploaded[file]|max_size[file,30000]|ext_in[file,doc,docx,ppt,pptx,pdf,mp4]', // Max size in KB, allowed extensions
            ],
        ];

        // Validate the file input
        if (!$this->validate($rules)) {
            // If validation fails, set flashdata error and return to the form
            session()->setFlashdata('error', $this->validator->getErrors());
            return $this->validator->getErrors();
            //return redirect()->back()->withInput(); // Redirect back to the form with input data
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
            return $newName;
        } else {
            // Handle error if the file is not valid
            session()->setFlashdata('error', 'File upload failed.');
            return redirect()->back()->withInput(); // Redirect back to the form with input data
        }
    }

    public function uploadImage($file,$path){

          // Validation rules
        $rules = [
            'file' => [
                'label' => 'File',
                'rules' => 'uploaded[file]|max_size[file,1000]|ext_in[file,jpg,jpeg,png]', // Max size in KB, allowed extensions
            ],
        ];

        // Validate the file input
        if (!$this->validate($rules)) {
            // If validation fails, set flashdata error and return to the form
            session()->setFlashdata('error', $this->validator->getErrors());
            return $this->validator->getErrors();
            //return redirect()->back()->withInput(); // Redirect back to the form with input data
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
            return $newName;
        } else {
            // Handle error if the file is not valid
            session()->setFlashdata('error', 'File upload failed.');
            return redirect()->back()->withInput(); // Redirect back to the form with input data
        }
    }

    function enc($plainText) {
        
        $secretKey = "~n~!s<|Vas3ei*Eff)6P8*>RCz]wDa";
        $hash = hash_hmac('sha512', $plainText, $secretKey, true);

        $base64Hash = base64_encode($hash);
        
        return $base64Hash;
    }
}

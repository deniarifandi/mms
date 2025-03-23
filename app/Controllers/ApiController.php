<?php

namespace App\Controllers;

use App\Models\Subject;
use App\Models\Pedagogy;

class ApiController extends BaseController
{

    function __construct(){
         $this->Subject = new \App\Models\Subject();
         $this->Pedagogy = new \App\Models\Pedagogy();
    }

    public function get_subject(){
       
        $subjects = $this->Subject
        ->orderBy('subject_id','desc')
        ->findAll();
        
        echo json_encode($subjects);
        
    }

      public function get_video_list($id){
       
        if ($id == 0) {
            $pedagogys = $this->Pedagogy
            ->orderBy('pedagogy_id','desc')
            ->findAll();
        }else{
            $pedagogys = $this->Pedagogy
            ->orderBy('pedagogy_id','desc')
            ->find($id);
        }
        
        
        echo json_encode($pedagogys);
        
    }
   
}

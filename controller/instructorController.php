<?php
include_once __DIR__.'/../model/instructor.php';
class InstructorController extends Instructor{
    public function getInstructor(){
        return $this->getInstructorList();
    }
    public function addInstructor($name,$email,$phone,$address,$position,$image)
    {
        if($image['error'] == 0)
        {
            $filename = $image['name'];
            $extension = explode('.',$filename);
            $filetype = end($extension);
            $filesize = $image['size'];
            $allowed_types = ['jpg','jpeg','svg','png'];
            $tmp_file = $image['tmp_name'];
            if(in_array($filetype,$allowed_types))
            {
                if($filesize <= 2000000)
                {
                    $timestamp =time();
                    $filename = $timestamp.$filename;
                    if(move_uploaded_file($tmp_file,'../uploads/'.$filename))
                        return $this->createTrainee($name,$email,$phone,$address,$position,$filename);
                }
            }
        }
        
    }
    public function getEditInstructor($id)
    {
        return $this->getInstructorInfo($id);
    }
    public function editInstructor($id,$name,$email,$phone,$address,$position)
    {
        return $this->updateInstructor($id,$name,$email,$phone,$address,$position);
    }
    public function deleteInstructor($id)
    {
        return $this->deleteInstructorInfo($id);
    }
}
?>
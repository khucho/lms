<?php


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

include_once __DIR__.'/../vendor/db/db.php';
include_once __DIR__.'/../model/trainee.php';
include_once __DIR__.'/../vendor/PHPMailer/src/PHPMailer.php';  
include_once __DIR__.'/../vendor/PHPMailer/src/SMTP.php';  
include_once __DIR__.'/../vendor/PHPMailer/src/Exception.php';  

class TraineeController extends Trainee
{
    public function getTrainee()
    {
        return $this->getTraineeList();
    }  
    public function traineeStatus()
    {
        return $this->getTraineeStatus();
    }
    public function addTrainee($name,$email,$phone,$city,$education,$remark,$status,$image)
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
                        return $this->createTrainee($name,$email,$phone,$city,$education,$remark,$status,$filename);
                }
            }
        }
       
    }
    public function getEditTrainee($id)
    {
        return $this->editTraineeInfo($id);
    }
    public function editTrainee($id,$name,$email,$phone,$city,$education,$remark,$status,$image)
    {
        if($image['error'] == 0)
        {
            $filename =$image['name'];
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
                     return $this->updateTrainee($id,$name,$email,$phone,$city,$education,$remark,$status,$filename);
                }
            }
        }
        
    }
    public function deleteTrainee($id)
    {
        return $this->deleteTraineeInfo($id);
    }
    public function getTraineeCourse()
    {
        return $this->getTraineeCourseList();
    }
    public function addTraineeCourse($tname,$batname,$joined_date,$status)
    {
        return $this->createTraineeCourse($tname,$batname,$joined_date,$status);
    }
    public function getEditTC($id)
    {
        return $this->editTC($id);
    }
    public function editTraineeCourse($id,$tname,$batname,$joined_date,$status)
    {
        return $this->updateTraineeCourse($id,$tname,$batname,$joined_date,$status);
    }
    public function deleteTraineeCourse($id)
    {
        return $this->deleteTraineeCourseInfo($id);
    }
    public function traineeCourseStatus()
    {
        return $this->getTraineeCourseStatus();
    }
    public function mailTrainee($id)
    {
        $mailaddress = $this->getMail($id);
        $mailer = new PHPMailer(true);
        $mailer->SMTPDebug = SMTP::DEBUG_SERVER; // for detailed debug output
        $mailer->isSMTP();
        $mailer->Host = 'smtp.gmail.com';
        $mailer->SMTPAuth = true;
        $mailer->SMTPSecure = 'tls';   
        $mailer->Port = 587;

        $mailer->Username = "khucho101@gmail.com";
        $mailer->Password = "rjcbgwrpixytyatv";

        $mailer->setFrom("khucho101@gmail.com","admin");
        $mailer->addAddress("maymyopwint825@gmail.com","TraineeName");

        $mailer->IsHTML(true);
        $mailer->Subject = "Testing for mail";
        $mailer->Body = 'Hay Melanie';
       
         if($mailer->send())
            return true;
    }
    public function mailTraineeCourse($id)
    {
        $mailaddress = $this->getMailCourse($id);
        $mailer = new PHPMailer(true);
        $mailer->SMTPDebug = SMTP::DEBUG_SERVER; // for detailed debug output
        $mailer->isSMTP();
        $mailer->Host = 'smtp.gmail.com';
        $mailer->SMTPAuth = true;
        $mailer->SMTPSecure = 'tls';   
        $mailer->Port = 587;

        $mailer->Username = "khucho101@gmail.com";
        $mailer->Password = "rjcbgwrpixytyatv";

        $mailer->setFrom("khucho101@gmail.com","admin");
        $mailer->addAddress("maymyopwint825@gmail.com","TraineeName");

        $mailer->IsHTML(true);
        $mailer->Subject = "Testing for mail";

        $mailer->Body = '<html>
                            <body>
                               <p> Hello '. $mailaddress['tname'].', it is your batch name and outline that you registered the course.</p><br>
                               <p> Batch Name: '.$mailaddress['batname'].'</p><br>
                               <p> Course Name: '.$mailaddress['coname']. '</p><br>
                               <p> Outline: '.$mailaddress['outline']. '</p><br>
                               <p> Start Date: '.$mailaddress['start_date']. '</p><br>
                               <p> Duration: '.$mailaddress['duration']. 'months </p><br>
                               
                            </body>
                        </html>';
       
         if($mailer->send())
          $sendMail = $this->traineeMail($mailaddress['id']);
            return $sendMail;
    }
    public function traineeByBatch($bid)
    {
        return $this->getTraineeByBatch($bid);
    }
    public function traineeMail($id)
    {
        return $this->traineeMailReport($id);
    }
}


?>
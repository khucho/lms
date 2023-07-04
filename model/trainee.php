<?php
include_once __DIR__.'/../vendor/db/db.php';
class Trainee{
    public function getTraineeList(){
        $con = Database:: connect();
        $con -> setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    
        $sql = "select * from trainee";
        $statement = $con->prepare($sql);
    
        if($statement->execute())
        {
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        }
        return $result;
    }
    public function getTraineeStatus()
    {
        $con = Database:: connect();
        $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

        $sql = "select max(status) as status from trainee group by status";
        $statement = $con->prepare($sql);


        if($statement->execute())
        {
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        }
        return $result; 
    }
    public function createTrainee($name,$email,$phone,$city,$education,$remark,$status,$filename)
    {
        $con = Database:: connect();
        $con -> setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

        $sql = "insert into trainee(name,email,phone,city,education,remark,status,image) values (:name,:email,:phone,:city,:education,:remark,:status,:image)";
        $statement = $con->prepare($sql);
        $statement->bindParam(':name',$name);
        $statement->bindParam(':email',$email);
        $statement->bindParam(':phone',$phone);
        $statement->bindParam(':city',$city);
        $statement->bindParam(':education',$education);
        $statement->bindParam(':remark',$remark);
        $statement->bindParam(':status',$status);
        $statement->bindParam(':image',$filename);

        if($statement->execute())
        {
            return true;
        }
        else
        {
            return false;
        }
    }
    public function editTraineeInfo($id)
    {
        $con = Database:: connect();
        $con -> setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

        $sql = "select * from trainee where id =:id";
        $statement = $con->prepare($sql);
        $statement->bindParam(':id',$id);


        if($statement->execute())
        {
            $result = $statement->fetch(PDO::FETCH_ASSOC);
            return $result;
        }
   
    }
    public function updateTrainee($id,$name,$email,$phone,$city,$education,$remark,$status,$filename)
    {
        $con = Database:: connect();
        $con -> setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

        $sql = "update trainee set name= :name,email = :email,phone = :phone,city = :city,education = :education,remark = :remark, status = :status ,image = :image where id = :id";
        $statement = $con->prepare($sql);
        $statement->bindParam(':id',$id);
        $statement->bindParam(':name',$name);
        $statement->bindParam(':email',$email);
        $statement->bindParam(':phone',$phone);
        $statement->bindParam(':city',$city);
        $statement->bindParam(':education',$education);
        $statement->bindParam(':remark',$remark);
        $statement->bindParam(':status',$status);
        $statement->bindParam(':image',$filename);

        if($statement->execute())
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function deleteTraineeInfo($id)
    {
        $con = Database:: connect();
        $con -> setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

        $sql = "delete from trainee where id =:id";
        $statement = $con->prepare($sql);
        $statement->bindParam(':id',$id);

        try{
            $statement->execute();
            return true;
        }
        catch(PDOException $e)
        {
            return false;
        }
    }
    
    public function getTraineeCourseList()
    {
        $con = Database:: connect();
        $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

        $sql = "select trainee_course.id as id,trainee.name as tname , batch.name as batname, trainee_course.joined_date as joined_date ,trainee_course.status as status,trainee_course.email as email
        from trainee join batch join trainee_course 
        where trainee_course.batch_id = batch.id
        and trainee_course.trainee_id = trainee.id";
        $statement = $con->prepare($sql);

        if($statement->execute())
        {
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        }
        return $result;
    }
    public function editTC($id)
    {
        $con = Database:: connect();
        $con -> setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

        $sql = "select * from trainee_course where id =:id";
        $statement = $con->prepare($sql);
        $statement->bindParam(':id',$id);


        if($statement->execute())
        {
            $result = $statement->fetch(PDO::FETCH_ASSOC);
            return $result;
        }
    }
    public function updateTraineeCourse($id,$tname,$batname,$joined_date,$status)
    {
        $con = Database:: connect();
        $con -> setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

        $sql = "update trainee_course set trainee_id = :tname , batch_id = :batname,joined_date = :joined_date,status = :status where id = :id";
        $statement = $con->prepare($sql);
        $statement->bindParam(':id',$id);
        $statement->bindParam(':tname',$tname);
        $statement->bindParam(':batname',$batname);
        $statement->bindParam(':joined_date',$joined_date);
        $statement->bindParam(':status',$status);

        if($statement->execute())
        {
            return true;
        }
        else
        {
            return false;
        }
    }
    public function deleteTraineeCourseInfo($id)
    {
        $con = Database:: connect();
        $con -> setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

        $sql = "delete from trainee_course where id =:id";
        $statement = $con->prepare($sql);
        $statement->bindParam(':id',$id);

        try{
            $statement->execute();
            return true;
        }
        catch(PDOException $e)
        {
            return false;
        } 
    }
    public function getTraineeCourseStatus()
    {
        $con = Database:: connect();
        $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

        $sql = "select max(status) as status from trainee_course group by status";
        $statement = $con->prepare($sql);

        if($statement->execute())
        {
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        }
        return $result; 
    }

    public function createTraineeCourse($tname,$batname,$joined_date,$status)
    {
        $con = Database:: connect();
        $con -> setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

        $sql = "insert into trainee_course(trainee_id,batch_id,joined_date,status) values (:tname,:batname,:joined_date,:status)";
        $statement = $con->prepare($sql);
        $statement->bindParam(':tname',$tname);
        $statement->bindParam(':batname',$batname);
        $statement->bindParam(':joined_date',$joined_date);
        $statement->bindParam(':status',$status);

        if($statement->execute())
        {
            return true;
        }
        else
        {
            return false;
        }
    }
    
    public function getMail($id){
        $con = Database:: connect();
        $con ->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

        $sql = "select * from trainee where id =:id";
        $statement = $con->prepare($sql);
        $statement->bindParam(':id',$id);


        if($statement->execute())
        {
            $result = $statement->fetch(PDO::FETCH_ASSOC);
            return $result['email'];
        }
    }
    public function getMailCourse($id){
        $con = Database:: connect();
        $con ->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

        $sql = " select trainee_course.id as id,trainee.name as tname, batch.name as batname, batch.duration as duration,course.outline as outline,course.name as coname,batch.start_date as start_date
        from trainee_course join trainee join batch join course
        on trainee_course.trainee_id = trainee.id
        and trainee_course.batch_id = batch.id
        and course.id = batch.course_id
        where trainee_course.id = :id";
        $statement = $con->prepare($sql);
        $statement->bindParam(':id',$id);


        if($statement->execute())
        {
            $result = $statement->fetch(PDO::FETCH_ASSOC);
            return $result;
        }
    }
    public function getTraineeByBatch($bid)
    {
            $con = Database:: connect();
            $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

            $sql = "select trainee_course.trainee_id as tid,trainee.name as tname
            from trainee_course join trainee 
            where trainee_course.batch_id = :id and trainee_course.trainee_id = trainee.id";
            $statement = $con->prepare($sql);
            $statement->bindParam(':id',$bid);

            if($statement->execute())
            {
                $result = $statement->fetchAll(PDO::FETCH_ASSOC);
            }
            return $result; 
    }
    public function traineeMailReport($id)
    {
        $con = Database:: connect();
        $con -> setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

        $sql = "update trainee_course set email = 1 where id = :id";
        $statement = $con->prepare($sql);
        $statement->bindParam(':id',$id);

        if($statement->execute())
        {
            return true;
        }
        else
        {
            return false;
        } 
    }
}

?>
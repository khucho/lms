<?php
include_once __DIR__.'/../vendor/db/db.php';
class Batch{
    public function getBatchList()
    {
        $con = Database:: connect();
        $con -> setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

        $sql = "select batch.id as id,batch.name as batname,batch.start_date as start_date,batch.duration as duration,batch.fee as fee,batch.discount as discount,course.name as coname
                from course join batch
                where batch.course_id = course.id";
        $statement = $con->prepare($sql);

        if($statement->execute())
        {
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        }
        return $result;
    }
    public function createBatch($name,$start_date,$duration,$discount,$fee,$course){
        $con = Database:: connect();
        $con -> setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

        $sql = "insert into batch (name,start_date,duration,discount,fee,course_id) values(:name,:start_date,:duration,:discount,:fee,:course)";
        $statement = $con->prepare($sql);
        $statement->bindParam(':name',$name);
        $statement->bindParam(':start_date',$start_date);
        $statement->bindParam(':duration',$duration);
        $statement->bindParam(':discount',$discount);
        $statement->bindParam(':fee',$fee);
        $statement->bindParam(':course',$course);

        if($statement->execute())
        {
            return true;
        }
        else
        {
            return false;
        }
    }
    public function getEditBatch($id)
    {
        $con = Database:: connect();
        $con -> setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

        $sql = "select * from batch where id=:id";
        $statement = $con->prepare($sql);
        $statement->bindParam(':id',$id);

        if($statement->execute())
        {
          $result = $statement->fetch(PDO::FETCH_ASSOC);
          return $result; 
        }
    }
    public function updateBatch($id,$name,$start_date,$duration,$discount,$fee,$course)
    {
        $con = Database:: connect();
        $con -> setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

        $sql = "update batch set name = :name , start_date = :start_date, duration = :duration, discount = :discount,fee= :fee , course_id = :course where id=:id";
        $statement = $con->prepare($sql);
        $statement->bindParam(':id',$id);
        $statement->bindParam(':name',$name);
        $statement->bindParam(':start_date',$start_date);
        $statement->bindParam(':duration',$duration);
        $statement->bindParam(':discount',$discount);
        $statement->bindParam(':fee',$fee);
        $statement->bindParam(':course',$course);

        if($statement->execute())
        {
            return true;
        }
        else
        {
            return false;
        } 
    }
    public function deleteBatchInfo($id)
    {
        $con = Database:: connect();
        $con -> setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

        $sql = "delete from batch where id = :id";
        $statement = $con->prepare($sql);
        $statement->bindParam(':id',$id);
        
        try
        {
            $statement->execute();
            return true;
        }
        catch(PDOException $e)
        {
            return false;
        }
    }
    public function getBatchPerYear()
    {
        $con = Database:: connect();
        $con -> setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

        $sql = "select year(start_date) as year , count(id) as total 
                from batch
                group by start_date";
        $statement = $con->prepare($sql);

        if($statement->execute())
        {
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        }
        return $result;
    }
}
?>
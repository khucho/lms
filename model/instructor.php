<?php
include_once __DIR__.'/../vendor/db/db.php';
class Instructor{
    public function getInstructorList(){
        $con = Database::connect();
        $con-> setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

        $sql = "select * from instructor";
        $statement = $con->prepare($sql);

        if($statement->execute()){
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        }
        return $result;
    }
    public function createInstructor($name,$email,$phone,$address,$position,$filename)
    {
        $con = Database:: connect();
        $con -> setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

        $sql = "insert into instructor(name,email,phone,address,position,image) values (:name,:email,:phone,:address,:position,:image)";
        $statement = $con->prepare($sql);
        $statement->bindParam(':name',$name);
        $statement->bindParam(':email',$email);
        $statement->bindParam(':phone',$phone);
        $statement->bindParam(':address',$address);
        $statement->bindParam(':position',$position);
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
    public function getInstructorInfo($id)
    {
        $con = Database:: connect();
        $con -> setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

        $sql = "select * from instructor where id= :id";
        $statement = $con->prepare($sql);
        $statement->bindParam(':id',$id);

        if($statement->execute())
        {
            $result = $statement->fetch(PDO::FETCH_ASSOC);
            return $result;
        }

    }
    public function updateInstructor($id,$name,$email,$phone,$address,$position)
    {
        $con = Database:: connect();
        $con -> setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

        $sql = "update instructor set name= :name,email = :email,phone = :phone,address = :address,position = :position where id = :id";
        $statement = $con->prepare($sql);
        $statement->bindParam(':id',$id);
        $statement->bindParam(':name',$name);
        $statement->bindParam(':email',$email);
        $statement->bindParam(':phone',$phone);
        $statement->bindParam(':address',$address);
        $statement->bindParam(':position',$position);

        if($statement->execute())
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function deleteInstructorInfo($id)
    {
        $con = Database:: connect();
        $con->setAttribute(PDO:: ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

        $sql = "delete from instructor where id = :id";
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
}
?>
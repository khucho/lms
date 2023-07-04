<?php
include_once __DIR__.'/../vendor/db/db.php';
class Project{
    public function getProjectList()
    {
        $con = Database:: connect();
        $con -> setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    
        $sql = "select project.id as id,project.title as title, project.start_date as start_date, batch.name as batname from project join batch where project.batch_id = batch.id";
        $statement = $con->prepare($sql);
    
        if($statement->execute())
        {
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        }
        return $result;
    }
    public function getProjectByIdInfo($id)
    {
        $con = Database:: connect();
        $con -> setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    
        $sql = "select project.*,batch.id as bid,batch.name as batname 
        from project join batch  
        where project.id = :id and  project.batch_id = batch.id ";
        $statement = $con->prepare($sql);
        $statement->bindParam(':id',$id);
    
        if($statement->execute())
        {
            $result = $statement->fetch(PDO::FETCH_ASSOC);
        }
        return $result; 
    }
    public function insertProjectInfo($title,$start_date,$batname)
    {
        $con = Database:: connect();
        $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

        $sql = "insert into project(title,start_date,batch_id) value(:title,:start_date,:batname)";
        $statement = $con->prepare($sql);
        $statement->bindParam(':title',$title);
        $statement->bindParam(':start_date',$start_date);
        $statement->bindParam(':batname',$batname);

        if($statement->execute())
            return true;
        else
            return false; 

    }
    public function getUpdateProjectById($id)
    {
        $con = Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

        $sql = "select * from project where id = :id";
        $statement = $con->prepare($sql);
        $statement->bindParam(':id',$id);

        if($statement->execute())
        {
            $result = $statement->fetch(PDO::FETCH_ASSOC);
            return $result;
        }
    }
    public function updateProject($id,$title,$start_date,$batname)
    {
        $con = Database:: connect();
        $con -> setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

        $sql = "update project set id = :id , title = :title , start_date = :start_date , batch_id = :batname where id =:id";
        $statement = $con->prepare($sql);
        $statement->bindParam(':id',$id);
        $statement->bindParam(':title',$title);
        $statement->bindParam(':start_date',$start_date);
        $statement->bindParam(':batname',$batname);

        if($statement->execute())
        {
            return true;
        }
        else{
            return false;
        }

    }
    public function deleteProjectInfo($id)
    {
        $con = Database:: connect();
        $con->setAttribute(PDO::ATTR_ERRMODE,PDO:: ERRMODE_EXCEPTION);

        $sql = "delete from project where id = :id";
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
<?php
include_once __DIR__.'/../vendor/db/db.php';
class Category{
    
    public function getCategoriesList()
    {
        # 1. db connection
            $con = Database::connect();
            $con -> setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        # 2. write sql
            // $sql = "select category.name as cat_name,count(course.cat_id) as total
            // from course join category
            // where course.cat_id = category.id
            // group by course.cat_id";
            $sql = "select * from category";
            $statement = $con->prepare($sql);
        # 3. sql execute
        
            if($statement->execute()){
                # 4. result
                // data => fetch() => one row, fetchAll() => multiple rows
                    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
            }
        return $result;
    }

    public function createCategory($name)
    {

        $con = Database::connect();
        $con -> setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

        $sql = "insert into category(name) values (:name)";
        $statement = $con->prepare($sql);
        $statement->bindParam(':name',$name); # Parameter binding

        if($statement->execute())
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function getCatList()
    {
        # 1. db connection
            $con = Database::connect();
            $con -> setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        # 2. write sql
            $sql = "select category.name as cat_name,count(course.cat_id) as total
            from course join category
            where course.cat_id = category.id
            group by course.cat_id";
            # $sql = "select name from category";
            $statement = $con->prepare($sql);
        # 3. sql execute
        
            if($statement->execute()){
                # 4. result
                // data => fetch() => one row, fetchAll() => multiple rows
                    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
            }
        return $result;
    }
    public function getCategoryInfo($id)
    {
        # 1. db connection
            $con = Database::connect();
            $con -> setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        # 2. write sql
            $sql = "select * from category where id = :id";
            # $sql = "select name from category";
            $statement = $con->prepare($sql);
            $statement->bindParam(':id',$id);
        # 3. sql executec
        
            if($statement->execute()){
                # 4. result
                // data => fetch() => one row, fetchAll() => multiple rows
                    $result = $statement->fetch(PDO::FETCH_ASSOC);
                    return $result;
            }
     
    }
    public function updateCategory($id,$name)
    {
        # 1. db connection
        $con = Database::connect();
        $con -> setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    # 2. write sql
        $sql = "update category set name = :name where id=:id";
        $statement = $con->prepare($sql);
        $statement->bindParam(':id',$id);
        $statement->bindParam(':name',$name);

        if($statement->execute())
        {
            return true;
        }
        else
        {
            return false;
        }
    }
    public function deleteCategoryInfo($id)
    {
        # 1. db connection
        $con = Database::connect();
        $con -> setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    # 2. write sql
        $sql = "delete from category where id=:id";
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
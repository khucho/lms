<?php
include_once __DIR__.'/../vendor/db/db.php';
class Course{
    public function getCourseList(){
        $con = Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

        $sql = "select course.id as id, course.name as coname,category.name as catname,course.outline as outline from course join category
                on category.id = course.cat_id";
        $statement = $con->prepare($sql);

        if($statement->execute()){
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        }
        return $result;
    }

    public function createCourse($name,$category,$outline)
    {

        $con = Database::connect();
        $con -> setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

        $sql = "insert into course(name,cat_id,outline) values (:name,:cat,:outline)";
        $statement = $con->prepare($sql);
        $statement->bindParam(':name',$name); # Parameter binding
        $statement->bindParam(':cat',$category);
        $statement->bindParam(':outline',$outline);
        
        if($statement->execute())
        {
            return true;
        }
        else
        {
            return false;
        }
    }
    public function getCourse(){
        $con = Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

        $sql = "
        select course.name as coname,table2.fee,table3.instructname as name
        
        from  course join (select id,fee,course_id, count(course_id) as total1
                            from batch
                            group by course_id ) as table2 
                            join (select batch.name,instructor.name as instructname,batch.id as id1
                                 from batch JOIN instructor_course JOIN instructor
                                where batch.id=instructor_course.batch_id
                                and instructor_course.instructor_id=instructor.id) table3

        where table2.course_id = course.id
        and table2.id = table3.id1
        and table2.total1 = (select max(total)
        from (select fee,course_id, count(course_id) as total
                            from batch
                            group by course_id ) as table1 )";
        $statement = $con->prepare($sql);

        if($statement->execute()){
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        }
        return $result;
    }
    public function getCourseInfo($id)
    {
        $con = Database:: connect();
        $con -> setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

        $sql = "select * from course where id= :id";
        $statement = $con->prepare($sql);
        $statement->bindParam(':id',$id);

        if($statement->execute())
        {
            $result = $statement->fetch(PDO::FETCH_ASSOC);
            return $result;
        }

    }
    public function updateCourse($id,$name,$cat,$outline)
    {
        $con = Database:: connect();
        $con -> setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

        $sql = "update course set name= :name,cat_id = :cat,outline = :outline where id = :id";
        $statement = $con->prepare($sql);
        $statement->bindParam(':id',$id);
        $statement->bindParam(':name',$name);
        $statement->bindParam(':cat',$cat);
        $statement->bindParam(':outline',$outline);
        

        if($statement->execute())
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function deleteCourseInfo($id)
    {
        $con = Database::connect();
        $con -> setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    # 2. write sql
        $sql = "delete from course where id=:id";
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
    public function getCoursePerTrainee()
    {
        $con = Database:: connect();
        $con -> setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

        $sql = "
        select  course.name as cname , count(trainee_course.trainee_id) as total
        from batch JOIN trainee_course join course
        where batch.id = trainee_course.batch_id
        and batch.course_id = course.id
        group by batch.course_id";
        $statement = $con->prepare($sql);

        if($statement->execute())
        {
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        }
        return $result;
    }
}
?>
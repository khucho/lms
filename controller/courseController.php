<?php
include_once __DIR__.'/../model/course.php';
class CourseController extends Course{
    public function getCourses(){
        return $this->getCourseList();
    }
    public function addCourse($name,$category,$outline)
    {
        return $this->createCourse($name,$category,$outline);
    }
    public function getEditCourse($id)
    {
        return $this->getCourseInfo($id);
    }
    public function editCourse($id,$name,$cat,$outline)
    {
        return $this->updateCourse($id,$name,$cat,$outline);
    }
    public function deleteCourse($id)
    {
        return $this->deleteCourseInfo($id);
    }
    public function coursePerTrainee()
    {
        return $this->getCoursePerTrainee();
    }
}
?>
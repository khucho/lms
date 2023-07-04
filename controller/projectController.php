<?php
include_once __DIR__.'/../model/project.php';
class ProjectController extends Project{
    public function getProject()
    {
        return $this->getProjectList();
    }
    public function getProjectById($id)
    {
        return $this->getProjectByIdInfo($id);
    }
    public function addProject($title,$start_date,$batname)
    {
        return $this->insertProjectInfo($title,$start_date,$batname);
    }
    public function getEditProjectById($id)
    {
        return $this->getUpdateProjectById($id);
    }
    public function editProject($id,$title,$start_date,$batname)
    {
        return $this->updateProject($id,$title,$start_date,$batname);
    }
    public function deleteProject($id)
    {
        return $this->deleteProjectInfo($id);
    }
}
?>
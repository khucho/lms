<?php
include_once __DIR__.'/../model/batch.php';
class BatchController extends Batch{
    public function getBatch()
    {
        return $this-> getBatchList();
    }
    public function addBatch($name,$start_date,$duration,$discount,$fee,$course)
    {
        return $this->createBatch($name,$start_date,$duration,$discount,$fee,$course);
    }
    public function getEdit($id)
    {
        return $this->getEditBatch($id);
    }
    public function editBatch($id,$name,$start_date,$duration,$discount,$fee,$course)
    {
        return $this->updateBatch($id,$name,$start_date,$duration,$discount,$fee,$course);
    }
    public function deleteBatch($id)
    {
        return $this->deleteBatchInfo($id);
    }
    public function batchPerYear()
    {
        return $this->getBatchPerYear();
    }
}

?>
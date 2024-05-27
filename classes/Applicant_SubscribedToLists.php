<?php

class Applicant_SubscribedToLists extends Applicant
{
    private $_selectionsJobs = [];
    private $_selectionsVerticals = [];

    // Getters
    public function getSelectionsJobs()
    {
        return $this->_selectionsJobs;
    }

    public function getSelectionsVerticals()
    {
        return $this->_selectionsVerticals;
    }

    // Setters
    public function setSelectionsJobs($selectionsJobs)
    {
        $this->_selectionsJobs = $selectionsJobs;
    }

    public function setSelectionsVerticals($selectionsVerticals)
    {
        $this->_selectionsVerticals = $selectionsVerticals;
    }
}
<?php
/**
 * Class Applicant_SubscribedToLists
 *
 * Represents an applicant who is subscribed to specific lists.
 */
class Applicant_SubscribedToLists extends Applicant
{
    /** @var array $_selectionsJobs List of job selections */
    private $_selectionsJobs = [];

    /** @var array $_selectionsVerticals List of vertical selections */
    private $_selectionsVerticals = [];

    /**
     * Get the job selections.
     *
     * @return array List of job selections
     */
    public function getSelectionsJobs()
    {
        return $this->_selectionsJobs;
    }

    /**
     * Get the vertical selections.
     *
     * @return array List of vertical selections
     */
    public function getSelectionsVerticals()
    {
        return $this->_selectionsVerticals;
    }

    /**
     * Set the job selections.
     *
     * @param array $selectionsJobs List of job selections
     */
    public function setSelectionsJobs($selectionsJobs)
    {
        $this->_selectionsJobs = $selectionsJobs;
    }

    /**
     * Set the vertical selections.
     *
     * @param array $selectionsVerticals List of vertical selections
     */
    public function setSelectionsVerticals($selectionsVerticals)
    {
        $this->_selectionsVerticals = $selectionsVerticals;
    }
}
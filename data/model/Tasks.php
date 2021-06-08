<?php


class Tasks extends Model
{
    /**
     * @var int
     */
    private $id;
    /**
     * @var string
     */
    private $title;
    /**
     * @var string
     */
    private $description;


    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    public function getById($id)
    {
        return self::find($id);
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function getLocation()
    {
        return $this->location;
    }

    public function getCreationDate()
    {
        return $this->creationDate;
    }
    public function getScheduledDate()
    {
        return $this->scheduledDate;
    }
    public function getDoneDate()
    {
        return $this->doneDate;
    }
    public function getWorkDuration()
    {
        return $this->workDuration;
    }


}
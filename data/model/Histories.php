<?php


class Histories extends Model
{
    public function getId()
    {
        return $this->id;
    }

    public function getDateTime()
    {
        return $this->dateTime;
    }

    public function getDescritpion()
    {
        return $this->description;
    }

    public function getTaskId()
    {
        return $this->task_id;
    }

    public function getUserId()
    {
        return $this->user_id;
    }


}
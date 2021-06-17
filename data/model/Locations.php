<?php


class Locations extends Model
{
    public function getId()
    {
        return $this->id;
    }

    public function getLabel()
    {
        return $this->label;
    }
}
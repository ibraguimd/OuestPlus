<?php


class Capacities extends Model
{
    /**
     * @var string
     */
    private $label;

    /**
     * @var string
     */
    private $description;

    public function getId()
    {
        return $this->id;
    }

    public function getLabel()
    {
        return $this->label;
    }

    public function getDescription()
    {
        return $this->description;
    }
}
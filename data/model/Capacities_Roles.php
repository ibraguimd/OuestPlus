<?php


class Capacities_Roles extends Model
{
    public function getId()
    {
        return $this->id;
    }

    public function getRole_Id()
    {
        return $this->role_id;
    }

    public function getCapacity_id()
    {
        return $this->capacity_id;
    }
}
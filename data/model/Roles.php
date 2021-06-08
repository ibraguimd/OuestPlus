<?php


/**
 * Class Roles
 */
class Roles extends Model
{
    /**
     * @var int
     */
    private $id;
    private $authorization;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @return mixed
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * @param string $label
     */
    public function setLabel(string $label): void
    {
        $this->label = $label;
    }


    public function can($label)
    {
        $capacity= Capacities::where('label="'.$label.'"');
        $capacityRole = Capacities_Roles::where('role_id="'.$this->getId().'" AND capacity_id="'.$capacity[0]->getId().'"');
        return (!empty($capacityRole));
    }

}
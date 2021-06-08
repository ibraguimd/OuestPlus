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

//    public function getAuthorization()
//    {
//        if ($this->authorization == 1){
//            return true;
//        }
//        else
//        {
//            return false;
//        }
//    }
//
//    public function isDirection()
//    {
//        if ($this->getAuthorization() == true){
//            return true;
//        }
//        else
//        {
//            return false;
//        }
//    }

    public static function can($label,$role)
    {
        $query1= Capacities::where('label="'.$label.'"');
        $query2 = Capacities_Roles::where('role_id ="'.$role.'" AND capacity_id="'.$query1[0]->getId().'"');
        return (!empty($query2));
    }

}
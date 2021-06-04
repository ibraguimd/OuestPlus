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
     * @var string
     */
    private $name;

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
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
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


}
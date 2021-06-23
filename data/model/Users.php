<?php

/**
 * Class Users
 */
class Users extends Model
{
    /**
     * @var int
     */
    private $id;
    /**
     * @var string
     */
    private $firstname;
    /**
     * @var string
     */
    private $lastname;
    /**
     * @var string
     */
    private $email;
    /**
     * @var string
     */
    private $password;
    /**
     * @var boolean
     */
    private $isAdmin;
    /**
     * @var Roles
     */
    // private $role;

    public static function findOneWithCredentials($userEmail,$userPwd)
    {
        $results = self::where("email='" . $userEmail . "' AND password ='" . sha1($userPwd) . "'");
        if (isset($results[0])) {
            var_dump($results);
            return $results[0];
        } else {
            return null;
        }
    }

    /**
     * @return int
     */
    public function getId(): int
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
     * @return string
     */
    public function getFirstname(): string
    {
        return $this->firstName;
    }


    /**
     * @return string
     */
    public function getLastname(): string
    {
        return $this->lastName;
    }

    /**
     * @param string $lastname
     */
    public function setLastname(string $lastname): void
    {
        $this->lastname = $lastname;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param string $password
     */
    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    /**
     * @return Roles
     */

    public function getRole(): Roles
    {
        $this->role= Roles::find($this->role_id);
        return $this->role;
    }

    public function isDirection()
    {
        return $this->getRole()->isDirection();
    }

    public function can($label)
    {
        return $this->getRole()->can($label);
    }



    public function nbServiceDeMaintenance()
    {
        $request = ' SELECT COUNT(*) AS nbEmployee FROM `users` WHERE role_id=2' ;
        return Connection::safeQuery($request,[],get_called_class());
    }
    public function nbDirection()
    {  $request = ' SELECT COUNT(*) AS nbEmployee FROM `users` WHERE role_id=3' ;
        return Connection::safeQuery($request,[],get_called_class());
        $request = ' SELECT COUNT(*) AS nbEmployee FROM `users` WHERE role_id=3' ;
        return Connection::safeQuery($request,[],get_called_class());
    }

    public static function getNbEmployee()
    {
        $request = 'SELECT COUNT(*) AS nbEmployee FROM `users` WHERE role_id=1';
        return Connection::safeQuery($request,[],get_called_class());
    }

    public static function getNbService()
    {
        $request = 'SELECT COUNT(*) AS nbService FROM `users` WHERE role_id=2';
        return Connection::safeQuery($request,[],get_called_class());
    }

    public static function getNbDirection()
    {
        $request = 'SELECT COUNT(*) AS nbDirection FROM `users` WHERE role_id=3';
        return Connection::safeQuery($request,[],get_called_class());
    }

    public static function updateUser($lastName,$firstName,$email,$userId)
    {
        $request = 'UPDATE `users` SET lastName = ?, firstName = ?, email = ? WHERE id = ?';
        return Connection::safeQuery($request,[$lastName,$firstName,$email,$userId],get_called_class());
    }


}
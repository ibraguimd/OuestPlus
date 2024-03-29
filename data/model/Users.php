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
    private $firstName;
    /**
     * @var string
     */
    private $lastName;
    /**
     * @var string
     */
    private $email;
    /**
     * @var string
     */
    private $password;

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
    public function getFirstName(): string
    {
        return $this->firstName;
    }

    /**
     * @return string
     */
    public function setFirstName(string $firstName): void
    {
        $this->firstName = $firstName;
    }

    /**
     * @return string
     */
    public function getLastName(): string
    {
        return $this->lastName;
    }

    /**
     * @param string $lastname
     */
    public function setLastname(string $lastName): void
    {
        $this->lastName = $lastName;
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
        // Permet d'obtenir le rôle de l'utilisateur connecté
        $this->role= Roles::find($this->role_id);
        return $this->role;
    }

    public function can($label)
    {
        // Permet de vérifier si le rôle de l'utilisateur connecté au site a la capacité de faire l'action demandé en paramètre.
        return $this->getRole()->can($label);
    }

    //
    public function save()
    {
        // Permet de sauvegarder les données modifiées concernant l'utilisateur connecté
        self::updateUser($this->getLastName(),$this->getFirstName(),$this->getEmail(),$this->getId());
    }


    public static function getNbEmploye()
    {
        // Requête qui permet d'obtenir le nombre d'employé total
        $request = 'SELECT COUNT(*) AS nbEmployee FROM `users` WHERE role_id=1';
        return Connection::safeQuery($request,[],get_called_class())[0]->nbEmployee;
    }

    public static function getNbEmployeServiceInfo()
    {
        // Requête qui permet d'obtenir le nombre d'employée appartenant au service de maintenance informatique
        $request = ' SELECT COUNT(*) AS nbEmployeeServiceInfo FROM `users` WHERE role_id=2' ;
        return Connection::safeQuery($request,[],get_called_class())[0]->nbEmployeeServiceInfo;
    }

    public static function getNbEmployeServiceTech()
    {
        // Requête qui permet d'obtenir le nombre d'employée appartenant au service de maintenance tech
        $request = 'SELECT COUNT(*) AS nbEmployeServiceTech FROM `users` WHERE role_id=3';
        return Connection::safeQuery($request,[],get_called_class())[0]->nbEmployeServiceTech;
    }

    public static function getNbEmployeRH()
    {
        // Requête qui permet d'obtenir le nombre d'employée appartenant au service ressources humaines
        $request = 'SELECT COUNT(*) AS nbEmployeRH FROM `users` WHERE role_id=4';
        return Connection::safeQuery($request,[],get_called_class())[0]->nbEmployeRH;
    }

    public static function getNbDirection()
    {
        // Requête qui permet d'obtenir le nombre de personne dans la direction
        $request = 'SELECT COUNT(*) AS nbDirection FROM `users` WHERE role_id=5';
        return Connection::safeQuery($request,[],get_called_class())[0]->nbDirection;
    }

    public static function updateUser($lastName,$firstName,$email,$userId)
    {
        // fonction qui permet de modifié les données de l'utilisateur dans la BDD
        $request = 'UPDATE `users` SET lastName = ?, firstName = ?, email = ? WHERE id = ?';
        return Connection::safeQuery($request,[$lastName,$firstName,$email,$userId],get_called_class());
    }


}
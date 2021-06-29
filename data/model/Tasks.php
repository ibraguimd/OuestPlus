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

    public function getTasks()
    {
        return $this->tasks;
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

    public function getLocationId()
    {
        return $this->location_id;
    }
    public function getLabel()
    {
        $this->location= Locations::find($this->getLocationId());
        return $this->location->getLabel();
    }

    public function getAssignUserId()
    {
        return $this->assign_user_id;
    }

    public function getUserId()
    {
        return $this->user_id;
    }

    public function getUserFirstName()
    {
        $this->user_firstName = Users::find($this->getUserId());
        return $this->user_firstName->getFirstName();
    }

    public function getUserLastName()
    {
        $this->user_lastName = Users::find($this->getUserId());
        return $this->user_lastName->getLastName();
    }

    public function getAssignUserFirstName()
    {
        // On vérifie si la tâche concerné est attribué à une personne en recherchant l'ID de celui ci
        if (!empty($this->getAssignUserId()))
        {
            $this->assign_user_firstName= Users::find($this->getAssignUserId());
            return $this->assign_user_firstName->getFirstName();
        }
        return null;
    }

    public function getAssignUserLastName()
    {
        // On vérifie si la tâche concerné est attribué à une personne en recherchant l'ID de celui ci
        if (!empty($this->getAssignUserId()))
        {
        $this->assign_user_lastName= Users::find($this->getAssignUserId());
        return $this->assign_user_lastName->getLastName();
        }
        return null;
    }

    private function convertToArrayOfInt()
    {
        // Permet de convertir le tableaux obtenus par les fonction taskByDoneDate et taskByNotDoneDate en nombre entier.
        // Ceci est nécessaire de convertir pour le JavaScript
        return array(
            intval($this->Task1),
            intval($this->Task2),
            intval($this->Task3),
            intval($this->Task4),
            intval($this->Task5),
            intval($this->Task6),
            intval($this->Task7),
            intval($this->Task8),
            intval($this->Task9),
            intval($this->Task10),
            intval($this->Task11),
            intval($this->Task12)
        );
    }
    private function convertToArrayOfFloat()
    {
        // Permet de convertir le tableaux obtenus par les fonction taskByDoneDate et taskByNotDoneDate en nombre à virgule.
        // Ceci est nécessaire de convertir pour le JavaScript (diagramme camembert)
        $hour = 3600;
        return array(
            round(intval($this->AVG1)/$hour,2),
            round(intval($this->AVG2)/$hour,2),
            round(intval($this->AVG3)/$hour,2),
            round(intval($this->AVG4)/$hour,2),
            round(intval($this->AVG5)/$hour,2)
        );
    }

    // Retourne un objet instance de la classe Tasks, d'une tâche non réalisé
    public static function getAllTasksNotDone()
    {
        // Permet d'obtenir toutes les tâches n'ayant aucune date de réalisation
        $request = 'SELECT '.strtolower(self::class).'.*,locations.label FROM '.strtolower(self::class).' JOIN locations ON tasks.location_id=locations.id WHERE doneDate IS NULL ORDER BY creationDate ASC';
        return Connection::safeQuery($request,[],get_called_class());
    }

    public static function getAllTasksDone()
    {
        // Permet d'obtenir toutes les tâches terminées
        $request = 'SELECT '.strtolower(self::class).'.*,locations.label FROM '.strtolower(self::class).' JOIN locations ON tasks.location_id=locations.id WHERE doneDate IS NOT NULL ORDER BY creationDate DESC';
        return Connection::safeQuery($request,[],get_called_class());
    }

    public static function getAllTasksAssigns($userId)
    {
        // Permet d'obtenir les tâches qui ont été assignés, ce qui signifie qu'il y a un responsable de la tâche
        $request = 'SELECT '.strtolower(self::class).'.*,locations.label FROM '.strtolower(self::class).' JOIN locations ON tasks.location_id=locations.id WHERE assign_user_id ='.$userId.' AND doneDate IS NULL ORDER BY creationDate DESC';
        return Connection::safeQuery($request,[],get_called_class());
    }

    public static function getOwnTasks($userId)
    {
        // Permet d'obtenir la/les tâche(s) de l'utilisateurs qui est connecté sur le site
        $request = 'SELECT '.strtolower(self::class).'.*,locations.label FROM '.strtolower(self::class).' JOIN locations ON tasks.location_id=locations.id WHERE user_id ='.$userId;
        return Connection::safeQuery($request,[],get_called_class());
    }

    public static function getAllTask()
    {
        // Permet d'obtenir toutes les tâches
        $request = 'SELECT * FROM tasks';
        return Connection::safeQuery($request,[],get_called_class());
    }

    public static function taskByDoneDate()
    {
        // Permet d'obtenir le nombre de tâche réaliser par année
        $request = 'SELECT
        (SELECT COUNT(*) FROM `tasks` WHERE YEAR(doneDate) = "'.date('Y', strtotime("-11 year")).'") AS "Task1",
        (SELECT COUNT(*) FROM `tasks` WHERE YEAR(doneDate) = "'.date('Y', strtotime("-10 year")).'") AS "Task2",
        (SELECT COUNT(*) FROM `tasks` WHERE YEAR(doneDate) = "'.date('Y', strtotime("-9 year")).'") AS "Task3",
        (SELECT COUNT(*) FROM `tasks` WHERE YEAR(doneDate) = "'.date('Y', strtotime("-8 year")).'") AS "Task4",
        (SELECT COUNT(*) FROM `tasks` WHERE YEAR(doneDate) = "'.date('Y', strtotime("-7 year")).'") AS "Task5",
        (SELECT COUNT(*) FROM `tasks` WHERE YEAR(doneDate) = "'.date('Y', strtotime("-6 year")).'") AS "Task6",
        (SELECT COUNT(*) FROM `tasks` WHERE YEAR(doneDate) = "'.date('Y', strtotime("-5 year")).'") AS "Task7",
        (SELECT COUNT(*) FROM `tasks` WHERE YEAR(doneDate) = "'.date('Y', strtotime("-4 year")).'") AS "Task8",
        (SELECT COUNT(*) FROM `tasks` WHERE YEAR(doneDate) = "'.date('Y', strtotime("-3 year")).'") AS "Task9",
        (SELECT COUNT(*) FROM `tasks` WHERE YEAR(doneDate) = "'.date('Y', strtotime("-2 year")).'") AS "Task10",
        (SELECT COUNT(*) FROM `tasks` WHERE YEAR(doneDate) = "'.date('Y', strtotime("-1 year")).'") AS "Task11",
        (SELECT COUNT(*) FROM `tasks` WHERE YEAR(doneDate) = "'.date('Y').'") AS "Task12"';

        // On utilise la fonction convertToArrayOfInt() créer précédemment en haut

        return Connection::safeQuery($request,[],get_called_class())[0]->convertToArrayOfInt();
    }
    public static function taskByNotDoneDate()
    {
        // Permet d'obtenir le nombre de tâche non réalisé par année
        $request = 'SELECT
        (SELECT COUNT(*) FROM `tasks` WHERE YEAR(creationDate) = "'.date('Y', strtotime("-11 year")).'" AND doneDate IS NULL) AS "Task1",
        (SELECT COUNT(*) FROM `tasks` WHERE YEAR(creationDate) = "'.date('Y', strtotime("-10 year")).'" AND doneDate IS NULL) AS "Task2",
        (SELECT COUNT(*) FROM `tasks` WHERE YEAR(creationDate) = "'.date('Y', strtotime("-9 year")).'" AND doneDate IS NULL) AS "Task3",
        (SELECT COUNT(*) FROM `tasks` WHERE YEAR(creationDate) = "'.date('Y', strtotime("-8 year")).'" AND doneDate IS NULL) AS "Task4",
        (SELECT COUNT(*) FROM `tasks` WHERE YEAR(creationDate) = "'.date('Y', strtotime("-7 year")).'" AND doneDate IS NULL) AS "Task5",
        (SELECT COUNT(*) FROM `tasks` WHERE YEAR(creationDate) = "'.date('Y', strtotime("-6 year")).'" AND doneDate IS NULL) AS "Task6",
        (SELECT COUNT(*) FROM `tasks` WHERE YEAR(creationDate) = "'.date('Y', strtotime("-5 year")).'" AND doneDate IS NULL) AS "Task7",
        (SELECT COUNT(*) FROM `tasks` WHERE YEAR(creationDate) = "'.date('Y', strtotime("-4 year")).'" AND doneDate IS NULL) AS "Task8",
        (SELECT COUNT(*) FROM `tasks` WHERE YEAR(creationDate) = "'.date('Y', strtotime("-3 year")).'" AND doneDate IS NULL) AS "Task9",
        (SELECT COUNT(*) FROM `tasks` WHERE YEAR(creationDate) = "'.date('Y', strtotime("-2 year")).'" AND doneDate IS NULL) AS "Task10",
        (SELECT COUNT(*) FROM `tasks` WHERE YEAR(creationDate) = "'.date('Y', strtotime("-1 year")).'" AND doneDate IS NULL) AS "Task11",
        (SELECT COUNT(*) FROM `tasks` WHERE YEAR(creationDate) = "'.date('Y').'" AND doneDate IS NULL) AS "Task12"';

        // On utilise la fonction convertToArrayOfInt() créer précédemment en haut

        return Connection::safeQuery($request,[],get_called_class())[0]->convertToArrayOfInt();
    }

    public static function getAVGWorkDuration()
    {
        // Permet d'obtenir la moyenne du temps passé à réaliser une tâche par services

        $request='SELECT 
       (SELECT (AVG(TIME_TO_SEC(workDuration))) AS moyenneTemps FROM `tasks` JOIN `users`ON tasks.user_id=users.id WHERE users.role_id = 2 AND workDuration IS NOT NULL) AS "AVG1",
       (SELECT (AVG(TIME_TO_SEC(workDuration))) AS moyenneTemps FROM `tasks` JOIN `users`ON tasks.user_id=users.id WHERE users.role_id = 3 AND workDuration IS NOT NULL) AS "AVG2",
       (SELECT (AVG(TIME_TO_SEC(workDuration))) AS moyenneTemps FROM `tasks` JOIN `users`ON tasks.user_id=users.id WHERE users.role_id = 1 AND workDuration IS NOT NULL) AS "AVG3",
       (SELECT (AVG(TIME_TO_SEC(workDuration))) AS moyenneTemps FROM `tasks` JOIN `users`ON tasks.user_id=users.id WHERE users.role_id = 4 AND workDuration IS NOT NULL) AS "AVG4",
       (SELECT (AVG(TIME_TO_SEC(workDuration))) AS moyenneTemps FROM `tasks` JOIN `users`ON tasks.user_id=users.id WHERE users.role_id = 5 AND workDuration IS NOT NULL) AS "AVG5"
       ';

        return Connection::safeQuery($request,[],get_called_class())[0]->convertToArrayOfFloat();
    }

}
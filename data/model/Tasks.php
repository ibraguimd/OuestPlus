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

    private function convertToArrayOfInt()
    {
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

    public static function getOwnTasksNotDone($id)
    {
        $request = 'SELECT * FROM tasks JOIN locations ON tasks.location_id=locations.id WHERE doneDate IS NULL AND user_id ='.$id;
        return Connection::safeQuery($request,[],get_called_class());
    }


    public static function tasksNumberNotDone($userId)
    {
        $request = 'SELECT COUNT(*) AS tasks FROM tasks WHERE user_id='.$userId.' AND doneDate IS NULL';
        return Connection::safeQuery($request,[],get_called_class());
    }


    public static function getAllTask()
    {
        $request = 'SELECT * FROM tasks';
        return Connection::safeQuery($request,[],get_called_class());
    }

    public static function taskByDoneDate()
    {
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
        return Connection::safeQuery($request,[],get_called_class())[0]->convertToArrayOfInt();
    }
    public static function taskByNotDoneDate()
    {
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
        return Connection::safeQuery($request,[],get_called_class())[0]->convertToArrayOfInt();
    }


}
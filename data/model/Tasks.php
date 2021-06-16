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

    public function getLocation()
    {
        return $this->location;
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

    public static function tasksNotDone($id)
    {
        $request = 'SELECT * FROM tasks WHERE doneDate IS NULL AND user_id ='.$id;
        return Connection::safeQuery($request,[],get_called_class());
    }

    public static function allTasksDone($id)
    {
        $request = 'SELECT * FROM tasks WHERE doneDate IS NOT NULL';
        return Connection::safeQuery($request,[],get_called_class());
    }

    public static function tasksNumberNotDone($userId)
    {
        $request = 'SELECT COUNT(*) AS tasks FROM tasks WHERE user_id='.$userId.' AND doneDate IS NULL';
        return Connection::safeQuery($request,[],get_called_class());
    }

    cvergver


}
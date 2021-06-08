<?php

class TaskAddController{
    public static function switchAction($userAction){

        switch ($userAction){
            // case à ajouter pour chaque nouvelle action souhaitée
            case 'addTask':
                self::addtask();
                break;
            default:
                self::defaultAction();
                break;
        }
    }
    private static function defaultAction()
    {
        $tabTitle="Demande d'une tâche";
        include('../page/taskAdd/index.php');
    }

    private static function addTask()
    {
        Tasks::create($_POST);
        $user = unserialize($_SESSION['user']);
        header('Location:.?route=taskList');
    }

}





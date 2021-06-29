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
        // Titre de la vue
        $tabTitle="Demande d'une tâche";

        // Récupère toutes les salles
        $locations = Locations::all();
        include('../page/taskAdd/index.php');
    }

    private static function addTask()
    {
        // Créer une tâche
        Tasks::create($_POST);

        // déserialise User
        $user = unserialize($_SESSION['user']);
        header('Location:.?route=taskList');
    }

}





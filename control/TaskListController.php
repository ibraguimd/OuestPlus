<?php


class TaskListController
{
    public static function switchAction($userAction)
    {
        switch ($userAction) {
            // case à ajouter pour chaque nouvelle action souhaitée
            case 'edit':
                self::editAction($_POST);
                break;

            case 'modif':
                self::modifAction($_POST);
                break;
            default:
                self::defaultAction();
                break;
        }
    }
        private static function defaultAction()
    {
        $tabTitle="Liste des tâches";
        $user = unserialize($_SESSION['user']);
        $tasks = Tasks::tasks($user->getId());
        include('../page/taskList/index.php');
    }

    private static function modifAction($request)
    {

        $tabTitle="Liste des tâches";
        $user = unserialize($_SESSION['user']);
        $tasks = Tasks::tasks($user->getId());
        $idTask=$request['idTask'];

        $taskToUpdate=Tasks::find($idTask);

        include('../page/taskList/index.php');
    }

    private static function editAction($request)
    {
        $tabTitle="Liste des tâches";
        $user = unserialize($_SESSION['user']);
        $tasks = Tasks::tasks($user->getId());
        Tasks::update($request['title'],$request['description'],$request['location'],$request['scheduledDate'],$request['doneDate'],$request['workDuration'],$request['idTask']);
        header('Location:.?route=taskList');
    }
}
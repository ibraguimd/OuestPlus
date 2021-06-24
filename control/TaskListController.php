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
            case 'assign':
                self::assignAction($_POST);
                break;
            case 'assignSubmit':
                self::assignSubmitAction($_POST);
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
        $displayAllTasks = $user->can('displayAllTask');
        $displayOwnTasks = $user->can('displayOwnTask');
        if ($user->can('displayOwnTask'))
        {
            $ownTasks = Tasks::where('creator_user_id='.$user->getId());
            if ($user->can('displayAllTask')){
                $allTasksNotDones = Tasks::getAllTasksNotDone();
                $allTasksDones = Tasks::getAllTasksDone();
            }

            include('../page/taskList/index.php');
        }
        else
        {
            header('Location:.?route=dashboard');
        }

    }

    private static function modifAction($request)
    {

        $tabTitle="Liste des tâches";
        $user = unserialize($_SESSION['user']);
        $allTasks = Tasks::getAllTasksNotDone($user->getId());
        if ($user->can('updateTask'))
        {
            $idTask=$request['id'];
            $taskToUpdate=Tasks::find($idTask);
        }
        else
        {
            echo Alert::danger('Vous n\'avez pas les droits pour modifier une tâche');
            $allTasks = Tasks::getAllTasksNotDone($user->getId());
        }


        include('../page/taskList/index.php');
    }

    private static function editAction($request)
    {
        $user = unserialize($_SESSION['user']);
        $result = Tasks::update($request);
        $allTasks = Tasks::getAllTasksNotDone($user->getId());
        $histories = [
            'datetime'=> date("Y-m-d"),
            'description' => $request['description'],
            'task_id' => $request['id'],
            'user_id' => $user->getId()
            ];
        Tasks::histories($histories);
        header('Location:.?route=taskList');
    }

    private static function assignAction($request)
    {
        $tabTitle="Liste des tâches";
        $user = unserialize($_SESSION['user']);
        if ($user->can('assignTask'))
        {
            $allTasks = Tasks::getAllTasksNotDone($user->getId());
            $maintenances = Users::where('role_id IN (2,3)');
            $idTask=$request['id'];
            $taskToAssign=Tasks::find($idTask);
        }
        else
        {
            $allTasks = Tasks::getAllTasksNotDone($user->getId());
            echo Alert::danger('Vous n\'avez pas les droits pour modifier une tâche');
        }

        include('../page/taskList/index.php');
    }

    private static function assignSubmitAction($request)
    {
        $tabTitle="Liste des tâches";
        $user = unserialize($_SESSION['user']);
        if ($user->can('assignTask'))
        {
            $allTasks = Tasks::getAllTasksNotDone($user->getId());
            Tasks::assign($request['assign_user_id'],$request['idTask']);

        }
        else
        {
            echo Alert::danger('Vous n\'avez pas les droits pour modifier une tâche');
        }

        header('Location:.?route=taskList');
    }
}
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
        if ($user->can('displayTask'))
        {

            include('../page/taskList/index.php');
        }
        else
        {
            header('Location:.?route=stat');
        }

    }

    private static function modifAction($request)
    {

        $tabTitle="Liste des tâches";
        $user = unserialize($_SESSION['user']);
        if ($user->can('updateTask'))
        {
            $tasks = Tasks::tasksNotDone($user->getId());
            $idTask=$request['id'];
            $taskToUpdate=Tasks::find($idTask);
        }
        else
        {
            echo Alert::danger('Vous n\'avez pas les droits pour modifier une tâche');
            $tasks = Tasks::tasksNotDone($user->getId());
        }


        include('../page/taskList/index.php');
    }

    private static function editAction($request)
    {
        $user = unserialize($_SESSION['user']);

        $result = Tasks::update($request);


        $histories = [
            'datetime'=> date("Y-m-d"),
            'description' => $request['description'],
            'task_id' => $request['idTask'],
            'user_id' => $user->getId()
            ];
        Tasks::histories($histories);
        header('Location:.?route=taskList');
    }

    private static function assignAction($request)
    {
        $tabTitle="Liste des tâches";
        $user = unserialize($_SESSION['user']);
        $tasks = Tasks::tasksNotDone($user->getId());
        $directions = Users::where('role_id ='.$user->getRole()->getId());

        $idTask=$request['id'];
        $taskToAssign=Tasks::find($idTask);
        include('../page/taskList/index.php');
    }

    private static function assignSubmitAction($request)
    {
        $tabTitle="Liste des tâches";
        $user = unserialize($_SESSION['user']);
        Tasks::assign($request['user_id'],$request['idTask']);
        $tasks = Tasks::tasksNotDone($user->getId());
        include('../page/taskList/index.php');
    }
}
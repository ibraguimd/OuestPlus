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
        // Titre de la vue
        $tabTitle="Liste des tâches";

        // déserialise User
        $user = unserialize($_SESSION['user']);
        // Si l'utilisateur a le droit d'afficher toutes les tâches
        $displayAllTasks = $user->can('displayAllTask');
        // Si l'utilisateur a le droit d'afficher ses tâches
        $displayOwnTasks = $user->can('displayOwnTask');
        // Si l'utilisateur a le droit d'afficher ses tâches
        if ($user->can('displayOwnTask'))
        {
            // Récpère toutes les tâches de l'utilisateur connecté
            $ownTasks = Tasks::getOwnTasks($user->getId());
            // Couleur de la tâche
            $taskColor = "";
            // Si l'utilisateur a le droit d'afficher toutes les tâches
            if ($user->can('displayAllTask')){
                // Récupère toutes les tâches non réalisées
                $allTasksNotDones = Tasks::getAllTasksNotDone();
                // Récupère toutes les tâches réalisées
                $allTasksDones = Tasks::getAllTasksDone();
                // Récupère toutes les tâches assigné a l'utilisateur
                $allTasksAssigns = Tasks::getAllTasksAssigns($user->getId());
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
        // Titre de la vue
        $tabTitle="Liste des tâches";
        // déserialise User
        $user = unserialize($_SESSION['user']);
        // Récupère toutes les tâches non effectuées
        $allTasks = Tasks::getAllTasksNotDone();
        // Si l'utilisateur à le droit de modifier une tâche
        if ($user->can('updateTask'))
        {
            // Id de la tâche
            $idTask=$request['id'];
            // Recherche la tâche à modifier
            $taskToUpdate=Tasks::find($idTask);
        }
        else
        {
            // Message d'erreur "pas les droits pour modifier une tâches"
            echo Alert::danger('Vous n\'avez pas les droits pour modifier une tâche');
            // Récupère toutes les tâches non effectuées
            $allTasks = Tasks::getAllTasksNotDone();
        }


        include('../page/taskList/index.php');
    }

    private static function editAction($request)
    {
        // déserialise User
        $user = unserialize($_SESSION['user']);
        // Modifie dans la base de donnée avec les donnée de 'request'
        $result = Tasks::update($request);
        // Récupère toutes les tâches non effectuées
        $allTasks = Tasks::getAllTasksNotDone();
        // Tableau de l'historique
        $histories = [
            'datetime'=> date("Y-m-d"),
            'description' => $request['description'],
            'task_id' => $request['id'],
            'user_id' => $user->getId()
            ];
        // Insère dans la table Histories le tableau $histories
        Tasks::histories($histories);
        header('Location:.?route=taskList');
    }

    private static function assignAction($request)
    {
        // Titre de la vue
        $tabTitle="Liste des tâches";
        // déserialise User
        $user = unserialize($_SESSION['user']);
        // Si l'utilisateur peut assigner une tâche
        if ($user->can('assignTask'))
        {
            // Récupère toutes les tâches non effectuées
            $allTasks = Tasks::getAllTasksNotDone();
            // Récupère tout les utilisateur avec le role 2,3
            $maintenances = Users::where('role_id IN (2,3)');
            // Id de la tâche
            $idTask=$request['id'];
            // Recherche la tâche à assigner
            $taskToAssign=Tasks::find($idTask);
        }
        else
        {
            // Récupère toutes les tâches non effectuées
            $allTasks = Tasks::getAllTasksNotDone();
            // Message d'erreur
            echo Alert::danger('Vous n\'avez pas les droits pour modifier une tâche');
        }

        include('../page/taskList/index.php');
    }

    private static function assignSubmitAction($request)
    {
        // Titre de la vue
        $tabTitle="Liste des tâches";
        // déserialise User
        $user = unserialize($_SESSION['user']);
        // Si l'utilisateur peut assigner une tâche
        if ($user->can('assignTask'))
        {
            // Récupère toutes les tâches non effectuées
            $allTasks = Tasks::getAllTasksNotDone();
            // Assigne la tâche a l'utilisateur choisis
            Tasks::assign($request['assign_user_id'],$request['idTask']);

        }
        else
        {
            // Message d'erreur
            echo Alert::danger('Vous n\'avez pas les droits pour modifier une tâche');
        }

        header('Location:.?route=taskList');
    }
}
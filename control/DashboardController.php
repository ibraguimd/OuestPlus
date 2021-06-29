<?php


class DashboardController
{
    public static function switchAction($userAction){
        switch ($userAction){
            // case à ajouter pour chaque nouvelle action souhaitée
            default:
                self::defaultAction();
                break;
        }
    }

    // Action par défaut quand on arrive sur la vue Dashboard
    private static function defaultAction()
    {
        // déserialise User
        $user = unserialize($_SESSION['user']);

        // Récupère toutes les tâches non effectué
        $taskNotDone = Tasks::count('user_id='.$user->getId().' AND doneDate IS NULL');

        // Récupère toutes les tâches effectué
        $nbTaskDone = Tasks::count('user_id='.$user->getId().' AND doneDate IS NOT NULL');

        // Si l'utilisateur à le droit de voir les graphique
        if ($user->can('displayStat'))
        {
            // variable qui sert à aligner les 2 graphique
            $display = "flex";

            // Récupère un tableau de nombre de tâche total effectué sur 12 années
            $graphTasksDone = Tasks::taskByDoneDate();

            // Récupère un tableau de nombre de tâche total non effectué sur 12 années
            $graphTasksNotDone = Tasks::taskByNotDoneDate();

            // Récupère toutes les tâches
            $allTask = Tasks::getAllTask();

            // Nombre de toutes les tâches existantes
            $nbAllTask = Tasks::count('1'); // on met '1' lorsqu'on à pas de condition

            // Moyenne du temps de travail par services
            $avgWorkDuration = Tasks::getAVGWorkDuration();
        }
        else
        {
            // variable qui sert à cacher les 2 graphique
            $display="none";
        }

        // Si l'utilisateur à le droit d'afficher toutes les tâches
        if($user->can('displayAllTask'))
        {
            // Récupère toutes les tâches
            $allTask = Tasks::getAllTask();

            // Nombre de toutes les tâches existantes
            $nbAllTask = Tasks::count('1'); // on met '1' lorsqu'on à pas de condition
        }

        // Si l'utilisateur à le droit d'afficher les utilisateur par rôle
        if ($user->can('displayUsersByRole'))
        {
            // Nombre d'employée
            $nbEmploye= Users::getNbEmploye();

            // Nombre d'employée du service informatique
            $nbEmployeServiceInfo= Users::getNbEmployeServiceInfo();

            // Nombre d'employée du service technique
            $nbEmployeServiceTech= Users::getNbEmployeServiceTech();

            // Nombre d'employée de la direction
            $nbDirection= Users::getNbDirection();

            // Nombre d'employée des ressources humaines
            $nbEmployeRH= Users::getNbEmployeRH();
        }

        // Titre de la vue
        $tabTitle="Dashboard";
        include('../page/dashboard/index.php');
    }


}
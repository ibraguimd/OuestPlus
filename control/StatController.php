<?php

class StatController{

    public static function switchAction($userAction){
        switch ($userAction){
            // case à ajouter pour chaque nouvelle action souhaitée
            default:
                self::defaultAction();
                break;
        }
    }
    private static function defaultAction()
    {
        $tabTitle="Graphique";
        $user = unserialize($_SESSION['user']);
        $tasks = Tasks::tasksNotDone($user->getId());
        $role = strtolower($user->getRole()->getLabel());

        if($user->can('displayStat'))
        {
            include('../page/stat/index.php');
        }
        else{
            header('Location:.?route=dashboard');
            echo Alert::danger('Vous n\'avez pas le droit d\'accéder à cette page');
        }

        //$warehouses = userData_warehouses($_SESSION['user']['id']);

    }
}






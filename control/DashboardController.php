<?php

class DashboardController{

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
        $tabTitle="Tableau de bord";
        $user = unserialize($_SESSION['user']);
        $role = strtolower($user->getRole()->getLabel());
        include('../page/dashboard/index.php');

        //$warehouses = userData_warehouses($_SESSION['user']['id']);

    }
}






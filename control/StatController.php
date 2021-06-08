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
        $role = strtolower($user->getRole()->getLabel());

        include('../page/stat/index.php');

        //$warehouses = userData_warehouses($_SESSION['user']['id']);

    }
}






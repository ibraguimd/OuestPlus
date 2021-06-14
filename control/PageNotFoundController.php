<?php


class PageNotFoundController
{
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
        $tabTitle="Erreur 404";
        $user = unserialize($_SESSION['user']);
        $route = $_GET['route'];
        include('../page/pageNotFound/index.php');
    }
}
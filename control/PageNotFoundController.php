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
        // Titre de la vue
        $tabTitle="Erreur 404";

        // déserialise User
        $user = unserialize($_SESSION['user']);

        // Récupère la route
        $route = $_GET['route'];
        include('../page/pageNotFound/index.php');
    }
}
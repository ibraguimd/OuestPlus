<?php


class ProfilController
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
        $tabTitle="Profil";
        $user = unserialize($_SESSION['user']);
        $task = Tasks::tasksNumber($user->getId());
        include('../page/profil/index.php');
    }
}
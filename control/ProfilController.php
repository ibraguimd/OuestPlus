<?php


class ProfilController
{
    public static function switchAction($userAction){
        switch ($userAction){
            // case à ajouter pour chaque nouvelle action souhaitée
            case 'modif':
                self::modifAction($_POST);
                break;
            case 'edit':
                self::editAction($_POST);
                break;
            default:
                self::defaultAction();
                break;
        }
    }
    private static function defaultAction()
    {
        $tabTitle="Profil";
        $displayModif = "block";
        $displaySubmit = "none";
        $read = "readonly";
        $user = unserialize($_SESSION['user']);
        $task = Tasks::tasksNumberNotDone($user->getId());
        include('../page/profil/index.php');
    }

    private static function modifAction($request)
    {
        $tabTitle="Profil";
        $displayModif = "none";
        $displaySubmit = "block";
        $read = "";
        $user = unserialize($_SESSION['user']);
        $task = Tasks::tasksNumberNotDone($user->getId());
        include('../page/profil/index.php');
    }

    private static function editAction($request)
    {
        $user = unserialize($_SESSION['user']);
        Users::updateUser($request['lastName'],$request['firstName'],$request['email'],$user->getId());
        header('Location:.?route=profil');
    }
}
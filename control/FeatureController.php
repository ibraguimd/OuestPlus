<?php

class FeatureController{
    public static function switchAction($userAction){
        $user = unserialize($_SESSION['user']);
        if($user->isAdmin()){
            header('Location:?route=dashboard');
        }

        switch ($userAction){
            // case à ajouter pour chaque nouvelle action souhaitée
            case 'addExample':
                self::addExampleAction();
                break;
            default:
                self::defaultAction();
                break;
        }
    }
    private static function defaultAction()
    {
        $tabTitle="Fonctionnalité";
        $examples=Example::all();
        include('../page/feature/index.php');
    }

    private static function addExampleAction()
    {
        Example::create($_POST);
        header('Location:.?route=feature');
    }
}





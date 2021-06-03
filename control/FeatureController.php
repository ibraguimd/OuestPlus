<?php

class FeatureController{
    public static function switchAction($userAction){

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
        include('../page/feature/index.php');
    }

    private static function addExampleAction()
    {
        Example::create($_POST);
        header('Location:.?route=feature');
    }
}





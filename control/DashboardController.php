<?php


class DashboardController
{
    public static function switchAction($userAction){
        switch ($userAction){
            default:
                self::defaultAction();
                break;
        }
    }

    private static function defaultAction()
    {
        $user = unserialize($_SESSION['user']);
        $task = Tasks::tasksNumberNotDone($user->getId());
        $tabTitle="Dashboard";
        include('../page/dashboard/index.php');
    }


}
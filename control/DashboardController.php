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
        $taskNotDone = Tasks::tasksNumberNotDone($user->getId());
        $nbTaskDone = Tasks::count('user_id='.$user->getId().' AND doneDate IS NOT NULL')[0]->nbCount;
        $tabTitle="Dashboard";
        include('../page/dashboard/index.php');
    }


}
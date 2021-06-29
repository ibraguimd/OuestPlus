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
        $nbTaskNotDoneByUser = Tasks::count('assign_user_id='.$user->getId().' AND doneDate IS NULL');
        $nbTaskDoneByUser = Tasks::count('assign_user_id='.$user->getId().' AND doneDate IS NOT NULL');

        if ($user->can('displayStat'))
        {
            $display = "flex";
            $graphTasksDone = Tasks::taskByDoneDate();
            $graphTasksNotDone = Tasks::taskByNotDoneDate();
            $allTask = Tasks::getAllTask();
            $nbAllTask = Tasks::count('1'); // on met '1' lorsqu'on à pas de condition
            $avgWorkDuration = Tasks::getAVGWorkDuration();
        }
        else
        {
            $display="none";
        }
        if($user->can('displayAllTask'))
        {
            $allTask = Tasks::getAllTask();
            $nbAllTask = Tasks::count('1'); // on met '1' lorsqu'on à pas de condition
        }

        if ($user->can('displayUsersByRole'))
        {
            $nbEmploye= Users::getNbEmploye();
            $nbEmployeServiceInfo= Users::getNbEmployeServiceInfo();
            $nbEmployeServiceTech= Users::getNbEmployeServiceTech();
            $nbDirection= Users::getNbDirection();
            $nbEmployeRH= Users::getNbEmployeRH();
        }

        $tabTitle="Dashboard";
        include('../page/dashboard/index.php');
    }


}
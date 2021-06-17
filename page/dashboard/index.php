<?php include('../page/template/header.php');?>


<?php if($user->can('displayUsersByRole'))
    {
        $html=DashboardUtils::welcome($user->getFirstName(),$user->getLastName(),$nbEmployee,$nbService,$nbDirection);
    }
    else{
        $html=DashboardUtils::welcome($user->getFirstName(),$user->getLastName());
    }

    echo $html ;
?>

<div class="d-flex">

<?= SmallBox::success('Nombre de tâches effectuées',$nbTaskDone,'taskList'); ?>
<?= SmallBox::warning('Nombre de tâches non effectuées',$taskNotDone[0]->getTasks(),'taskList'); ?>

</div>

<?php include ('../page/template/footer.php'); ?>
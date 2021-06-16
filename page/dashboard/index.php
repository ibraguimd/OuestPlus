<?php include('../page/template/header.php');?>

<div class="d-flex">

<?= SmallBox::success('Nombre de tâches effectuées',$nbTaskDone,'taskList'); ?>
<?= SmallBox::warning('Tâches non effectuées',$taskNotDone[0]->getTasks(),'taskList'); ?>

</div>

<?php include ('../page/template/footer.php'); ?>
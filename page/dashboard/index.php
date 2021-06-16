<?php include('../page/template/header.php');?>

<?= SmallBox::success('Nombre de tâches',$task[0]->getTasks(),'taskList'); ?>
<?= SmallBox::warning('Test',$task[0]->getTasks(),'taskList'); ?>
<?= SmallBox::danger('Danger !',$task[0]->getTasks(),'taskList'); ?>
<?php include ('../page/template/footer.php'); ?>
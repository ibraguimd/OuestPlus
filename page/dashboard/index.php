<?php include('../page/template/header.php');?>

<?= SmallBox::success('Nombre de tâches',$task[0]->getTasks(),'taskList'); ?>
    <i class="fa-solid fa-triangle-exclamation"></i>
<?php include ('../page/template/footer.php'); ?>
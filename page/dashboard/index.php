<?php include('../page/template/header.php');?>

<?= SmallBox::info('Nombre de tâches',$task[0]->getTasks(),'taskList'); ?>

<?php include ('../page/template/footer.php'); ?>
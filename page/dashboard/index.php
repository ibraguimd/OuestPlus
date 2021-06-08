<?php include ('../page/template/header.php'); ?>
<div class="card-header">
    Mes infos à voir dès que je suis connecté...
</div>
<div class="card-body">
    <div class="alert alert-danger" role="alert">
        A simple danger alert—check it out!
<!--        --><?php //var_dump(Roles::can('assignTasks',$user->getRole()->getId())); ?>
    </div>
</div>

<?php include ('../page/template/footer.php'); ?>
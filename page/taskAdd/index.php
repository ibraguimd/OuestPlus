<?php include('../page/template/header.php'); ?>

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12 ">
                    <h5><?= "Ajoutez une tâche" ?></h5>
                </div>
                <form class="w-100" method="post" action=".?route=taskAdd&action=addTask">
                    <div class="col-sm-12 w-100">
                        <div class="form-group w-100">
                            <label>Nom</label>
                            <input type="text" name="title" class="form-control" required>
                            <label>Description</label>
                            <input type="text" name="description" class="form-control">
                            <label>Localisation</label>
                            <input type="text" name="location" class="form-control">
                        </div>
                        <div class="form-group form-inline">
                            <input type="hidden" name="creationDate" class="form-control" value="<?php echo date("Y-m-d"); ?>">
                            <input type="hidden" name="department_id" value="<?= rand(1,30) ?>">
                            <input type="hidden" name="user_id" value="<?php echo $user->getId(); ?>">
                        </div>
                        <button type="submit" class="btn btn-block btn-primary btn-sm">Valider</button>
                    </div>
                </form>
            </div>
        </div><!-- /.container-fluid -->
    </section>

<?php include ('../page/template/footer.php'); ?>
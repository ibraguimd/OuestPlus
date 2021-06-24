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
                            <label>Titre</label>
                            <input type="text" name="title" class="form-control" required>
                            <label>Description</label>
                            <textarea style="min-height: 2.4em;" type="text" name="description" class="form-control"></textarea>
                            <label>Salles</label>
                            <select class="form-control " name="location_id">
                                <?php
                                foreach ($locations as $location)
                                {
                                echo '<option value="'.$location->getId().'">'.$location->getLabel().'</option>';
                                }
                                ?>
                                </select>
<!--                            <label>Localisation</label>-->
<!--                            <input type="text" name="location" class="form-control">-->
                        </div>
                        <div class="form-group form-inline">
                            <input type="hidden" name="creationDate" class="form-control" value="<?php echo date("Y-m-d"); ?>">
                            <input type="hidden" name="department_id" value="<?= rand(1,30) ?>">
                            <input type="hidden" name="user_id" value="<?= $user->getId() ?>">
                        </div>
                        <div class="form-group col-sm-1">
                        <button type="submit" class="form-control btn btn-block btn-dark btn-sm">Valider</button>
                        </div>
                    </div>
                </form>
            </div>
        </div><!-- /.container-fluid -->
    </section>

<?php include ('../page/template/footer.php'); ?>
<?php include ('../page/template/header.php'); ?>


    <div class="col-sm-12">
<div class="card-body">
<form method="post">
    <table id="example" class="table table-bordered table-hover">
        <thead>
        <tr>
            <th>Tâches</th>
            <th>Description</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        <?php
            foreach($tasks as $task){
                echo '<tr>';
                echo '<td>'.$task->getTitle().'</td>';
                echo '<td>'.$task->getDescription().'</td>';
                echo '<td>'.'<button type="submit" class="btn btn-primary btn-lg" value="'.$task->getId().'" name="view" data-toggle="modal" data-target="#myModal">'.'Détails'.'</button>'.'</td>';
                echo '</tr>';
            }
            ?>

        </tbody>
    </table>
</form>
</div>
</div>
    <!-- Modal -->
    <div class="modal" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Détails</h4>
                </div>
                <div class="modal-body">
                    <!-- Liste des détails -->
                    <table id="example" class="table table-bordered">
                        <thead>
                        <tr>
                            <th>Tâches</th>
                            <th>Description</th>
                            <th>Localisation</th>
                            <th>Date de création</th>
                            <th>Date prévue</th>
                            <th>Date de réalisation</th>
                            <th>Durée du travail</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        if (isset($_POST['view'])){
                            echo '<tr>';
                            echo '<td>'.$task->getById($_POST['view'])->getTitle().'</td>';
                            echo '<td>'.$task->getById($_POST['view'])->getDescription().'</td>';
                            echo '<td>'.$task->getById($_POST['view'])->getLocation().'</td>';
                            echo '<td>'.$task->getById($_POST['view'])->getCreationDate().'</td>';
                            echo '<td>'.$task->getById($_POST['view'])->getScheduledDate().'</td>';
                            echo '<td>'.$task->getById($_POST['view'])->getDoneDate().'</td>';
                            echo '<td>'.$task->getById($_POST['view'])->getWorkDuration().'</td>';
                            echo '</tr>';
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<?php include ('../page/template/footer.php'); ?>
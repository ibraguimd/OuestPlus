<?php include ('../page/template/header.php'); ?>
    <div class="col-sm-12">
        <div class="card-body">
            <form method="post" action=".?route=taskList&action=edit">
                <?php
                    if(isset($taskToUpdate))
                    {
                        echo '<div class="form-row">';
                        echo '<div class="form-group col-md-6">';
                        echo '<label>Nom de la tâche</label>';
                        echo '<input type="hidden" class="form-control" name="idTask" placeholder="Titre" value="'.$taskToUpdate->getId().'">';
                        echo '<input type="text" class="form-control" name="title" placeholder="Titre" value="'.$taskToUpdate->getTitle().'">';
                        echo '</div>';
                        echo '<div class="form-group col-md-4">';
                        echo '<label for="inputPassword4">Description</label>';
                        echo '<input type="text" class="form-control" name="description" placeholder="Description" value="'.$taskToUpdate->getDescription().'">';
                        echo '</div>';
                        echo '<div class="form-group col-md-2">';
                        echo '<label for="inputPassword4">Localisation</label>';
                        echo '<input type="text" class="form-control" name="location" placeholder="Localisation" value="'.$taskToUpdate->getLocation().'">';
                        echo '</div>';
                        echo '</div>';
                        echo '<div class="form-row">';
                        echo '<div class="form-group col-md-2">';
                        echo '<label for="inputPassword4">Date prévue</label>';
                        echo '<input type="date" class="form-control" name="scheduledDate" placeholder="Date prévue" value="'.$taskToUpdate->getScheduledDate().'">';
                        echo '</div>';
                        echo '<div class="form-group col-md-2">';
                        echo '<label for="inputPassword4">Date de réalisation</label>';
                        echo '<input type="date" class="form-control" name="doneDate" placeholder="Date de réalisation" value="'.$taskToUpdate->getDoneDate().'">';
                        echo '</div>';
                        echo '<div class="form-group col-md-2">';
                        echo '<label for="inputPassword4">Durée de travail</label>';
                        echo '<input type="time" step="1" class="form-control" name="workDuration" placeholder="Durée du travail" value="'.$taskToUpdate->getWorkDuration().'">';
                        echo '</div>';
                        echo '</div>';
                        echo '<button type="submit" class="btn btn-primary">'.'Modifier'.'</button>';
                    }
                ?>
            </form>
        </div>
    </div>

    <div class="col-sm-12">
<div class="card-body">

    <table id="example" class="table table-bordered table-hover">
        <thead>
        <tr>
            <th>Tâches</th>
            <th>Description</th>
            <th>Localisation</th>
            <th>Date de création</th>
            <th>Date prévue</th>
            <th>Date de réalisation</th>
            <th>Durée du travail</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        <?php
            foreach($tasks as $task){
                echo '<tr>';
                echo '<td>'.$task->getTitle().'</td>';
                echo '<td>'.$task->getDescription().'</td>';
                echo '<td>'.$task->getLocation().'</td>';
                echo '<td>'.$task->getCreationDate().'</td>';
                echo '<td>'.$task->getScheduledDate().'</td>';
                echo '<td>'.$task->getDoneDate().'</td>';
                echo '<td>'.$task->getWorkDuration().'</td>';
                echo '<td><form method="post" action="?route=taskList&action=modif">'.'<button type="submit" class="btn btn-primary btn-lg" value="'.$task->getId().'" name="idTask">'.'Modifier'.'</button>'.'</form></td>';
                echo '</tr>';
            }
            ?>
        </tbody>
    </table>
</div>
</div>

<?php include ('../page/template/footer.php'); ?>
<?php include ('../page/template/header.php'); ?>

<?php
if(isset($alert)){
    echo $alert;
}
if(isset($taskToUpdate))
{
    echo '<div class="col-sm-12">';
        echo '<div class="card-body">';
            echo '<form method="post" action=".?route=taskList&action=edit">';

                        echo '<div class="form-row">';
                        echo '<div class="form-group col-md-6">';
                        echo '<label>Nom de la tâche</label>';
                        echo '<input type="hidden" class="form-control" name="id" placeholder="Titre" value="'.$taskToUpdate->getId().'">';
                        echo '<input type="text" class="form-control" name="title" placeholder="Titre" value="'.$taskToUpdate->getTitle().'">';
                        echo '</div>';
                        echo '<div class="form-group col-md-4">';
                        echo '<label for="inputPassword4">Description</label>';
                        echo '<input type="text" class="form-control" name="description" placeholder="Description" value="'.$taskToUpdate->getDescription().'">';
                        echo '</div>';
                        echo '<div class="form-group col-md-2">';
                        echo '<label for="inputPassword4">Localisation</label>';
                        echo '<input type="text" class="form-control" placeholder="Description" value="'.$taskToUpdate->getLabel().'" readonly>';
                        echo '<input type="hidden" name="location_id" placeholder="Description" value="'.$taskToUpdate->getLocationId().'">';
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

    echo '</form>';
        echo '</div>';
    echo '</div>';
    }
?>
<?php
if(isset($taskToAssign))
{
    echo '<div class="col-sm-12">';
        echo '<div class="card-body">';
            echo '<form method="post" action=".?route=taskList&action=assignSubmit">';

                    echo '<div class="form-row">';
                    echo '<div class="form-group col-md-6">';
                    echo '<label>Nom de la tâche</label>';
                    echo '<input type="hidden" class="form-control" name="idTask" placeholder="Titre" value="'.$taskToAssign->getId().'">';
                    echo '<input type="text" class="form-control" placeholder="Titre" value="'.$taskToAssign->getTitle().'" readonly>';
                    echo '</div>';
                    echo '<div class="form-group col-md-6">';
                    echo '<label>Employée de service</label>';
                    echo '<div class="form-group col-md-7">';
                    echo '<select class="form-control " name="user_id">';
                    foreach ($directions as $direction)
                    {
                        echo '<option value="'.$direction->getId().'">'.$direction->getFirstname().' '.$direction->getLastname().' - ['.$direction->getRole()->getLabel().']'.'</option>';
                    }
                    echo '</select>';
                    echo '</div>';
                    echo '</div>';
                echo '<button type="submit" class="btn btn-primary">'.'Assigner'.'</button>';


            echo '</form>';
        echo '</div>';
    echo '</div>';
}
    ?>


    <div class="col-sm-12">
<div class="card-body">

    <table id="example" class="table table-bordered table-hover">
        <thead>
        <tr>
            <th>Tâches</th>
            <th>Description</th>
<!--            <th>Localisation</th>-->
            <th>Date de création</th>
            <th>Date prévue de la réalisation</th>
            <th>Date effective de la réalisation</th>
            <th>Durée du travail</th>
            <?php
            if($user->can('updateTask') or $user->can('assignTask') or $user->can('deleteTask')){
                echo '<th>Actions</th>';
            }
            ?>

        </tr>
        </thead>
        <tbody>
        <?php
            foreach($ownTasks as $ownTask){
                echo '<tr>';
                echo '<td>'.$ownTask->getTitle().'</td>';
                echo '<td>'.$ownTask->getDescription().'</td>';
//                echo '<td>'.$task->getLocation().'</td>';
                if (!empty($ownTask->getScheduledDate()))
                {
                    $scheduledDate = date('d-m-Y',strtotime($ownTask->getScheduledDate()));
                }
                else
                {
                    $scheduledDate = "";
                }
                if (!empty($ownTask->getScheduledDate()))
                {
                    $doneDate = date('d/m/Y',strtotime($ownTask->getDoneDate()));
                }
                else
                {
                    $doneDate = "";
                }
                echo '<td>'.date("d/m/Y",strtotime($ownTask->getCreationDate())).'</td>';
                echo '<td>'.$scheduledDate.'</td>';
                echo '<td>'.$doneDate.'</td>';
                echo '<td>'.$ownTask->getWorkDuration().'</td>';
                if($user->can('updateTask')){
                    echo '<td class="d-flex"><form class="w-50" method="post" action="?route=taskList&action=modif">'.'<button type="submit" class="btn btn-dark btn-sm" value="'.$ownTask->getId().'" name="id">'.'<i class="far fa-edit"></i>'.'</button>'.'</form><br/>';
                    if($user->can('assignTask')){
                        echo '<form class="w-50" method="post" action="?route=taskList&action=assign">'.'<button type="submit" class="btn btn-primary btn-sm" value="'.$ownTask->getId().'" name="id">'.'<i class="fas fa-user-plus"></i>'.'</button>'.'</form></td>';
                    }
                }
                echo '</tr>';

            }
            ?>
        </tbody>
    </table>
</div>
</div>

<?php include ('../page/template/footer.php'); ?>
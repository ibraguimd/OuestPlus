<?php
$user = unserialize($_SESSION['user']);

echo '<div class="dropdown-divider"></div>';


if($user->can('displayTask'))
{
    echo MenuUtils::addLine('taskList','list-ul','Liste des tâches');
}
if($user->can('displayStat'))
{
    echo MenuUtils::addLine('stat','tachometer-alt','Graphique');
}
if($user->can('addTask'))
{
    echo MenuUtils::addLine('taskAdd','plus-circle','ajouter une tâche');
}

?>




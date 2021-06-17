<?php
$user = unserialize($_SESSION['user']);

echo '<div class="dropdown-divider"></div>';

echo MenuUtils::addLine('dashboard','fa-fa-fw fa-home','Tableau de bord');
if($user->can('displayOwnTask'))
{
    echo MenuUtils::addLine('taskList','list-ul','Liste des tâches');
}
if($user->can('displayStat'))
{
    echo MenuUtils::addLine('stat','tachometer-alt','Graphique');
}
if($user->can('addTask'))
{
    echo MenuUtils::addLine('taskAdd','plus-circle','Ajouter une tâche');
}

?>




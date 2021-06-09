<?php
$user = unserialize($_SESSION['user']);

echo '<div class="user-panel border-top border-bottom pt-2 pb-1 d-flex">';
echo '<div class="p-2 mb-1 bg-warning w-100">';
echo $user->getFirstname().' '.$user->getLastname().' - '.$user->getRole()->getLabel();
echo '</div>';
echo '</div>';


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




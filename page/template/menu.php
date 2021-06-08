<li class="nav-item">
    <a href="?route=taskList" class="nav-link">
        <i class="nav-icon fas fa-list-ul"></i>
        <p class="text-light">
            Liste des tâches
        </p>
    </a>
</li>
<li class="nav-item">
    <a href="?route=taskAdd" class="nav-link">
        <i class="nav-icon fas fa-plus-circle"></i>
        <p class="text-light">
            ajouter une tâche
            </p>
        </a>
    </li>
<?php
$user = unserialize($_SESSION['user']);
$html='';
if($user->can('displayStat'))
{
    $html='<li class="nav-item">';
    $html.='<a href="?route=stat" class="nav-link">';
    $html.='<i class="nav-icon fas fa-tachometer-alt"></i>';
    $html.='<p class="text-light">';
    $html.='Graphique';
    $html.='</p>';
    $html.='</a>';
    $html.='</li>';
}
echo $html;
?>

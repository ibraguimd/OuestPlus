<li class="nav-item">
    <a href="?route=dashboard" class="nav-link">
        <i class="nav-icon fas fa-tachometer-alt"></i>
        <p class="text-light">
            <?php
            $user = unserialize($_SESSION['user']);
            if ($user->isDirection() == true)
                echo "Tableau de bord";
            ?>
        </p>
    </a>
</li>
<li class="nav-item">
    <a href="?route=feature" class="nav-link">
        <i class="nav-icon fas fa-list-ul"></i>
        <p class="text-light">
            Liste des tâches
        </p>
    </a>
</li>
<li class="nav-item">
    <a href="?route=feature" class="nav-link">
        <i class="nav-icon fas fa-plus-circle"></i>
        <p class="text-light">
            Ajouter une tâche
        </p>
    </a>
</li>
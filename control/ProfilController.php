<?php


class ProfilController
{
    public static function switchAction($userAction){
        switch ($userAction){
            // case à ajouter pour chaque nouvelle action souhaitée
            case 'modif':
                self::modifAction($_POST);
                break;
            case 'edit':
                self::editAction($_POST);
                break;
            default:
                self::defaultAction();
                break;
        }
    }
    private static function defaultAction()
    {
        // Titre de la vue
        $tabTitle="Profil";

        // Affichage des boutons
        $displayModif = "block";
        $displaySubmit = "none";

        // Champs uniquement en lecture
        $read = "readonly";

        // déserialise User
        $user = unserialize($_SESSION['user']);

        // Nombre de tâches de l'utilisateur connecté
        $task = Tasks::count(' user_id ='.$user->getId());
        include('../page/profil/index.php');
    }

    private static function modifAction($request)
    {
        // Titre de la vue
        $tabTitle="Profil";

        // Affichage des boutons
        $displayModif = "none";
        $displaySubmit = "block";

        // Champs visible
        $read = "";

        // déserialise User
        $user = unserialize($_SESSION['user']);

        // Nombre de tâches de l'utilisateur connecté
        $task = Tasks::count(' user_id ='.$user->getId());
        include('../page/profil/index.php');
    }

    private static function editAction($request)
    {
        // déserialise User
        $user = unserialize($_SESSION['user']);

        // Défini le Nom
        $user->setLastName($request['lastName']);

        // Défini le Prénom
        $user->setFirstName($request['firstName']);

        // Défini le Mail
        $user->setEmail($request['email']);

        // Enregistre les donnée de l'utilisateur
        $user->save();

        // Serialise User
        $_SESSION['user']=serialize($user);
        header('Location:.?route=profil');
    }
}
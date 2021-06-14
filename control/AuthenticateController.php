<?php 

class AuthenticateController{

    public static function switchAction($userAction){
        switch ($userAction){
            case "login":
                $email=$_POST['email'];
                $password=$_POST['password'];
                self::loginAction($email,$password);
                break;
            case "logout":
                self::logoutAction();
                break;
            case "unauthorized":
                self::unauthorizedAction();
                break;
            default:
                self::defaultAction();
                break;
        }
    }

    private static function defaultAction()
    {
        $tabTitle="Connexion";
        $message='';
        include('../page/authenticate/index.php');
    }

    private static function loginAction($email,$password)
    {
        // Appel du modèle pour chercher le mail et le mdp crypté dans la bdd
        $user=Users::findOneWithCredentials($email,$password);

        if (!$user){
            // Pas d'utilisateur avec ce mail et ce mot de passe. On prépare un message pour la vue
            $message="Vos identifiants sont incorrects.";
            // On appelle la vue par défaut
            $tabTitle="Connexion";
            include('../page/authenticate/index.php');
        }
        else{
            // L'utilisateur a le droit d'accès
            $_SESSION['user']=serialize($user);
            if ($user->can('displayStat'))
            {
                header('location:./?route=stat');
            }
            else
                {
                header('location:./?route=taskList');
            }


        }
    }

    private static function logoutAction()
    {
        // Code pour la déconnexion
        unset($_SESSION);
        session_destroy();
        header('location:?route=authenticate');
    }

    private static function unauthorizedAction(){
        $tabTitle='Erreur';
        include('../page/authenticate/unauthorized.php');
    }
}
<?php

class UserDAO{
    /*
Récupérer des enregistrements
- get()
- all()
- first()
- find()
Insérer ou mettre à jour des enregistrements
- save()
Supprimer des enregistrements
- delete()
*/

    public static function all(){
        $request='SELECT * 
            FROM user';
        return Connection::safeQuery($request,[]);
    }

    public static function details($userId){
        $request='SELECT * 
            FROM user
            WHERE id=?';
        return Connection::safeQuery($request,[$userId])[0];
    }

    public static function findOneWithCredentials($userEmail, $userPwd){
        $request="SELECT user.id,role.id,firstName,lastName,email,password,isAdmin,role_id , role.name
                    FROM user
                    JOIN role ON user.role_id = role.id
                    WHERE email=? AND password=?";
        $requestParams=array($userEmail,sha1($userPwd));
        $result=Connection::safeQuery($request,$requestParams);
        if(isset($result[0])) {
            // Créer un role
            $role = new Role($result[0]['role_id'],$result[0]['name']);
            // Créer un user avec ce rôle
            $user = new User($result[0]['id'],
                            $result[0]['firstName'],
                            $result[0]['lastName'],
                            $result[0]['email'],
                            $result[0]['password'],
                            $result[0]['isAdmin'],
                            $role
            );
            return $user;
        }else{
            return false;
        }
    }

    public static function getRole($warehouseId,$userId=null){
        $request='SELECT role.* 
            FROM role,works
            WHERE role.id=works.role_id
            AND works.warehouse_id=? 
            AND works.user_id = ?';
        $roles = Connection::safeQuery($request,[$warehouseId,null==$userId ? $_SESSION['user']['id']:$userId]);
        if(isset($roles[0])){
            return $roles[0];
        }else{
            return false;
        }
    }
}
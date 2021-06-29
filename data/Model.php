<?php


class Model
{
    /**
     * return table name
     * @return string table name
     */
    private static function _getTable(){
        $class = get_called_class();
        return strtolower($class);
    }

    /**
     * @return array
     * @throws Exception
     */
    public static function all(){
        // Permet de selectionner toutes les données d'une table
        $request = 'SELECT * FROM '.self::_getTable();
        return Connection::safeQuery($request, [],get_called_class());
    }

    public static function where($where){
        // Permet de faire rapidement une requête avec une conditions WHERE
        $request = 'SELECT * FROM '.self::_getTable().' WHERE '.$where;
        return Connection::safeQuery($request,[],get_called_class());
    }

    public static function count($where){
        // Permet de compter un nombre d'élément dans un champ d'une table avec la possibilité de mettre une condition WHERE
        // Si vous ne voulez aucune condition, mettez en paramètre '1' pour préciser qu'il n'y a aucune condition
        $request = 'SELECT COUNT(*) AS nbCount FROM '.self::_getTable().' WHERE '.$where;
        return (Connection::safeQuery($request,[],get_called_class()))[0]->nbCount;
    }


    public static function create($params){
        // Permet de créer une table (utile pour l'artisan)
        return Connection::insert(self::_getTable(),$params,get_called_class());
    }

    public static function histories($params){
        // Permet d'insérer les données d'une tâches dans l'historique
        return Connection::insert('histories',$params,get_called_class());
    }

    public static function update($params){
        // Permet de mettre à jour les données
        $class= get_called_class();
        return Connection::update($class::_getTable(),$params);
    }

    public static function assign($userId,$idTask)
    {
        // Permet d'assigner une tâche à un utilisateur.
        $request = 'UPDATE '.self::_getTable().' SET '.' assign_user_id=?'.' WHERE id=?';
        return Connection::safeQuery($request,[$userId,$idTask],get_called_class());
    }

    public static function find($id){
        return self::where(' id ='.$id)[0];
    }





}
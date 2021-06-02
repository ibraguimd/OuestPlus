<?php

class ExampleDAO{
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
            FROM example';
        $examples=[];
        $results = Connection::safeQuery($request,[]);
        foreach($results as $result){
            $examples[]=new Example($result['id'],$result['name']);
        }
        return $examples;
    }

    public static function find($userId){
        $request='SELECT * 
            FROM example
            WHERE id=?';
        $examples=[];
        $results = Connection::safeQuery($request,[$userId]);
        foreach($results as $result){
            $examples[]=new Example($result['id'],$result['name']);
        }
        return $examples;
    }

    public static function save($name)
    {
        $request = 'INSERT INTO example(name)
                VALUES(?)';
        $results = Connection::safeQuery($request,[$name]);
        return $results;
    }
}
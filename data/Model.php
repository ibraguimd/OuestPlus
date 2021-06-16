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
        $request = 'SELECT * FROM '.self::_getTable();
        return Connection::safeQuery($request, [],get_called_class());
    }

    public static function where($where){
        $request = 'SELECT * FROM '.self::_getTable().' WHERE '.$where;
        return Connection::safeQuery($request,[],get_called_class());
    }

    public static function count($where){
        $request = 'SELECT COUNT(*) AS nbCount FROM '.self::_getTable().' WHERE '.$where;
        return Connection::safeQuery($request,[],get_called_class());
    }


    public static function create($params){
        return Connection::insert(self::_getTable(),$params,get_called_class());
    }

    public static function histories($params){
        return Connection::insert('histories',$params,get_called_class());
    }

    public static function update($params){
        $class= get_called_class();
        return Connection::update($class::_getTable(),$params);
        //$request = 'UPDATE '.self::_getTable().' SET '.' title=?,description=?,location=?,scheduledDate=?,doneDate=?,workDuration=?'.' WHERE id=?';
        //return Connection::safeQuery($request,[$title,$description,$location,$scheduledDate,$doneDate,$workDuration,$id],get_called_class());
    }

    public static function assign($userId,$idTask)
    {
        $request = 'UPDATE '.self::_getTable().' SET '.' user_id=?'.' WHERE id=?';
        return Connection::safeQuery($request,[$userId,$idTask],get_called_class());
    }

    public static function find($id){
        return self::where('id ='.$id)[0];
    }





}
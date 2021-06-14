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

    public static function create($params){
        return Connection::insert(self::_getTable(),$params,get_called_class());
    }

    public static function histories($params){
        return Connection::insert('histories',$params,get_called_class());
    }

    public static function update($title,$description,$location,$scheduledDate,$doneDate,$workDuration,$id){
        $request = 'UPDATE '.self::_getTable().' SET '.' title=?,description=?,location=?,scheduledDate=?,doneDate=?,workDuration=?'.' WHERE id=?';
        return Connection::safeQuery($request,[$title,$description,$location,$scheduledDate,$doneDate,$workDuration,$id],get_called_class());
    }

    public static function assign($userId,$idTask)
    {
        $request = 'UPDATE '.self::_getTable().' SET '.' user_id=?'.' WHERE id=?';
        return Connection::safeQuery($request,[$userId,$idTask],get_called_class());
    }

    public static function find($id){
        return self::where('id ='.$id)[0];
    }

    public static function tasks($id)
    {
        $request = 'SELECT * FROM '.self::_getTable().' WHERE user_id ='.$id;
        return Connection::safeQuery($request,[],get_called_class());
    }

    public static function tasksNumber($userId)
    {
        $request = 'SELECT COUNT(*) AS '.self::_getTable().' FROM '.self::_getTable().' WHERE user_id ='.$userId;
        return Connection::safeQuery($request,[],get_called_class());
    }
}
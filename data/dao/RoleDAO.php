<?php

class RoleDAO{
    function all(){
        $request = 'SELECT *
                FROM role
                order by name
    ';
        return Connection::safeQuery($request,[]);

    }
}
<?php


class MenuUtils
{
    public static function addLine($route,$icon,$titre)
    {
        return '<li class="nav-item"><a href="?route='.$route.'" class="nav-link"><i class="nav-icon fas fa-'.$icon.'"></i><p class="text-light">'.$titre.'</p></a></li>';
    }

}
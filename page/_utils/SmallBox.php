<?php


class SmallBox
{
    private static function display($texte,$data,$type,$icon,$route)
    {
        return '<div class="col-lg-3 col-6 mt-4">
        <!-- small box -->
        <div class="small-box bg-'.$type.'">
            <div class="inner">
                <h3>'.$data.'</h3>
                <p>'.$texte.'</p>
            </div>
            <div class="icon">
                <i class="'.$icon.'"></i>
            </div>
            <a href="?route='.$route.'" class="small-box-footer">Plus d\'infos<i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>';
    }

    public static function info($texte,$data,$route,$icon="fa fa-fw fa-list")
    {
        return self::display($texte,$data,'info',$icon,$route);
    }

    public static function warning($texte,$data,$route,$icon="fas fa-exclamation-triangle")
    {
        return self::display($texte,$data,'warning',$icon,$route);
    }

    public static function danger($texte,$data,$route,$icon="fas fa-ban")
    {
        return self::display($texte,$data,'danger',$icon,$route);
    }

    public static function success($texte,$data,$route,$icon="fas fa-check-circle   ")
    {
        return self::display($texte,$data,'success',$icon,$route);
    }

}
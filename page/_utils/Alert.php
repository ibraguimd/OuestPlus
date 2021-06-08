<?php

class Alert
{
    private static function display($texte,$type,$titre,$icon)
    {
        return '<div class="alert alert-'.$type.' alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  <h5><i class="icon fas fa-'.$icon.'"></i>'.$titre.'</h5>
                  '.$texte.'
                </div>';
    }

    public static function danger($texte,$titre='Erreur',$icon='ban')
    {
        return self::display($texte,'danger',$titre,$icon);
    }

    public static function info($texte,$titre='Info',$icon='info')
    {
        return self::display($texte,'info',$titre,$icon);
    }
}
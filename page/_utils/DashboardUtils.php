<?php


class DashboardUtils
{
    public static function welcome($firstname,$name,$nbEmployee=null,$nbService=null,$nbDirection=null)
    {
        $html = '<div class="card card-widget widget-user">
            <div class="widget-user-header bg-info">
                <h3 class="widget-user-username">Bienvenue !</h3>
                <h5 class="widget-user-desc">'.$firstname.' '.$name.'</h5>
            </div>
            <div class="widget-user-image">
                <img src="https://i.ibb.co/rZ7hNwC/logo-Ouest-Plus.png" alt="Logo OuestPlus" class="brand-image img-circle elevation-3" style="opacity: .8">
            </div>
            
            ';


        $user = unserialize($_SESSION['user']);

        if ($user->can('displayUsersByRole')){
            $html.='<div class="card-footer">
                <div class="row">
                    <div class="col-sm-4 border-right">
                        <div class="description-block">
                            <h5 class="description-header">Nombre d\'employés</h5>
                            <span class="description-text">'.$nbEmployee.'</span>
                        </div>
                    </div>
                    <div class="col-sm-4 border-right">
                        <div class="description-block">
                            <h5 class="description-header">Nombre d\'employés du service de maintenance</h5>
                            <span class="description-text">'.$nbService.'</span>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="description-block">
                            <h5 class="description-header">Nombre de membres de la direction de l\'entreprise</h5>
                            <span class="description-text">'.$nbDirection.'</span>
                        </div>
                    </div>
                </div>  
            </div>
        </div>';
        }
        else{
            $html.= '</div>';
        }
        return $html;
    }

}
<?php
require_once '../../config.php';

$auth = new Auth();

$is_remembered = $auth->isAuthenticated();
$is_auth = $auth->is_user_sess_valid();

if ($is_auth) {
    $usuario = $_SESSION['plasti_usuario'];
} else {
    if ($is_remembered) {
        $auth->startUserSess($auth->getUsuario_name());
        $usuario = $_SESSION['plasti_usuario'];
    } else {
        header("Location: ../credv/");
    }
}

$rrand = StringUtil::generateRandomString();
?>
<!DOCTYPE html>
<html>
    <head>
        <base href="<?php echo DOMAIN; ?>" />
        <link rel="icon" href="resources/img/plastinemor-ico.png" />        
        <meta charset="UTF-8">        
        <meta name='copyright' content='Plastinemor S.A.S'>
        <meta name="viewport" content="width=device-width, initial-scale=1">        
        <meta name='language' content='ES'>
        <meta name='robots' content='noindex,nofollow,noarchive'>
        <meta name='Classification' content='Business'>
        <meta name='author' content='Esteban Rincón, pq.steban90@hotmail.com'>
        <meta name='designer' content='Esteban Rincón'>
        <meta name='reply-to' content='pq.steban90@hotmail.com'>
        <meta name='owner' content='Plastinemor'>
        <meta name='url' content='http:// www.plastinemor.com'>
        <meta name='identifier-URL' content='http://www.plastinemor.com'>
        <meta name='pagename' content='Plastinemor'>
        <meta name='coverage' content='Worldwide'>
        <meta name='distribution' content='Global'>
        <meta name='subtitle' content='Admin'>
        <meta name='target' content='all'>
        <meta itemprop='name' content='jQTouch'>
        <meta http-equiv='Expires' content='0'>
        <meta http-equiv='Pragma' content='no-cache'>
        <meta http-equiv='Cache-Control' content='no-cache'>
        <meta http-equiv='imagetoolbar' content='no'>
        <meta http-equiv='x-dns-prefetch-control' content='off'>

        <meta name='verify-v1' content='googlebdf7b9e2540f1cd3.html'>
        <meta name="google-site-verification" content="o6UuR29WYWm0Wl9a29X0dVHcgzu-rodS6gtuf7z8mQM" />                
        <link rel=”author” href=”https://plus.google.com/u/0/115525682372150964614“/>
        <link rel="canonical" href="https://plastinemor.com" title="Empaques para flores" />
        <meta property="fb:app_id" content="296345170540483" /> 
        <meta property=”og:title” content=”Plastinemor”/>
        <meta property=”og:type” content=”website”/>
        <meta property=”og:image” content=”http://www.plastinemor.com/images/capuchon_white_dots.png”/>
        <meta property=”og:url” content=”http://www.plastinemor.com”/>
        <meta property=”og:description” content="Empaques para flor en colombia" />
        <meta property=”fb:admins” content=”296345170540483”/>  

        <title>Plastinemor - Admin</title>

        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-T8Gy5hrqNKT+hzMclPo118YTQO6cYprQmhrYwIiQ/3axmI1hQomh7Ud2hPOy8SP1" crossorigin="anonymous">                
        <link href="resources/css/plasti.css?<?php echo $rrand; ?>" rel="stylesheet" type="text/css"/>
    </head>
    <body>        

        <nav class="navbar navbar-inverse" id="admin-menu">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span> 
                    </button>
                    <a class="navbar-brand" href="#">Plastinemor Chat</a>
                </div>
                <div class="collapse navbar-collapse" id="myNavbar">
                    <ul class="nav navbar-nav">                        
                        <li><a href="javascript:void();"><?php echo $usuario; ?></a></li>                        
                        <li><a href="javascript:void();" class="time"></a></li>                        
                    </ul>
                    <ul class="nav navbar-nav navbar-right">

                        <li class="dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                <span class="fa fa-gears"></span>
                            </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a href="#" data-toggle="modal" data-target="#send-email-modal">
                                        Enviar Correo <span class="fa fa-envelope"></span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" data-toggle="modal" data-target="#files-modal">
                                        Archivos Adjuntos <span class="fa fa-paperclip"></span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="logout">                                        
                                        Cerrar Sesión 
                                        <span class="glyphicon glyphicon-log-out"></span>
                                    </a>
                                </li>                                
                            </ul>
                        </li>                                               

                    </ul>
                </div>
            </div>
        </nav>      


        <div class="container-fluid" id="admin-chat-container">
            <div class="row no-pad">

                <div class="col-xs-12 col-sm-5 col-md-4 no-pad" id="admin-conversation-list-container">

                </div>

                <div class="col-xs-12 col-sm-7 col-md-8" id="admin-conversations-container">

                </div>                
            </div>
        </div>               

        <!-- Modal ARCHIVOS ADJUNTOS-->
        <div class="modal fade" id="files-modal" role="dialog">
            <div class="modal-dialog modal-md">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Archivos Adjuntos</h4>
                    </div>
                    <div class="modal-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Empresa</th>
                                        <th>Archivo</th>
                                    </tr>
                                </thead>
                                <tbody id="archivos-adjuntos-tbody">
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>   
        <!-- END Modal ARCHIVOS ADJUNTOS-->

        <!-- Modal ENVIAR CORREO -->
        <div class="modal fade" id="send-email-modal" role="dialog">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Nuevo Correo a </h4> <span class="small" id="email-title"></span>
                    </div>
                    <div class="modal-body">
                        <form id="form-send-email">
                            <div class="form-group">
                                <label for="">Enviar a</label>
                                <select class="form-control" id="list_empresas" name="email_empresa" required="true">
                                    <option value="email_empresa">Nombre Empresa</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <textarea class="form-control" rows="5" required="true" id="email_content" name="email_content">                                    
                                </textarea>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-block btn-primary">
                                    Enviar <span class="fa fa-envelope"></span>
                                </button>
                            </div>                            
                        </form>
                    </div>
                </div>
            </div>
        </div>   
        <!-- END  Modal ENVIAR CORREO -->
        
        <?php 
        require_once '../../restricted/components/msg.php';
        ?>

        <script src="https://code.jquery.com/jquery-3.1.0.min.js"   integrity="sha256-cCueBR6CsyA4/9szpPfrX3s49M9vUU5BgtiJj06wt/s="   crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>                
        <script src="resources/js/plasti.js?<?php echo $rrand; ?>" type="text/javascript"></script>
    </body>
</html>

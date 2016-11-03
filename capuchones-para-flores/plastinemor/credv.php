<?php
require_once '../../config.php';

$auth = new Auth();
$is_user_remembered = $auth->isAuthenticated();

if ($is_user_remembered) {
    $auth->startUserSess($auth->getUsuario_name());
    header("Location: ../plasti.php");
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
        <meta name='url' content='http://www.plastinemor.com'>
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

        <title>Plastinemor - Credentials</title>

        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-T8Gy5hrqNKT+hzMclPo118YTQO6cYprQmhrYwIiQ/3axmI1hQomh7Ud2hPOy8SP1" crossorigin="anonymous">                
        <link href="resources/css/admin.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>                        
        <?php
        require_once '../../restricted/components/msg.php';
        ?>

        <form class="form" id="form-credentials">
            <img src="resources/img/loader.gif" alt="loading" id="loader"/>            
            <div class="form-group">
                <label for="usuario">Usuario</label>
                <input type="text" id="usuario" name="usuario" class="form-control form-control-lg" />
            </div>
            <div class="form-group">
                <label for="pwd">Contraseña</label>
                <input type="password" id="pwd" name="pwd" class="form-control form-control-lg" />
            </div>   
            <div class="form-group">                
                <div class="checkbox">
                    <label><input type="checkbox" id="remember-me" name="remember_me" value="si">Recordarme</label>
                </div>                
            </div>               
            <div class="form-group">
                <button type="submit" class="btn btn-flat btn-block btn-success">
                    Ok &checkmark;
                </button>
            </div>           
        </form>

        <script src="https://code.jquery.com/jquery-3.1.0.min.js"   integrity="sha256-cCueBR6CsyA4/9szpPfrX3s49M9vUU5BgtiJj06wt/s="   crossorigin="anonymous"></script>        
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>                        
        <script src="resources/js/admin.js" type="text/javascript"></script>
    </body>        
</html>

<?php
require_once 'config.php';
$rrand = StringUtil::generateRandomString();

$serverUtil = new ServerUtil();
?>
<!DOCTYPE html>
<html>
    <head>
        <base href="<?php echo DOMAIN; ?>" />
        <link rel="icon" href="resources/img/plastinemor-ico.png" />
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name='keywords' content='empaques para flores en colombia,venta de capuchones en colombia, venta de lámina'>
        <meta name='description' content='Plastinemor, de las mejores empresas fabricantes de empaques para flores de exportación, ubicada en Bogotá,Colombia desde 1975, proveemos empaques para flores y materia prima.'>
        <meta name='subject' content='Flores'>
        <meta name='copyright' content='Plastinemor SAS'>
        <meta name='language' content='ES'>
        <meta name='robots' content='index,follow,noodp'>
        <meta name='Classification' content='Business'>
        <meta name='author' content='Esteban Rincón, pq.steban90@hotmail.com'>
        <meta name='designer' content='Esteban Rincón'>
        <meta name='reply-to' content='pq.steban90@hotmail.com'>
        <meta name='owner' content='Plastinemor SAS'>
        <meta name='url' content='http://www.plastinemor.com'>
        <meta name='identifier-URL' content='http://www.plastinemor.com'>
        <meta name='pagename' content='Plastinemor'>
        <meta name='coverage' content='Worldwide'>
        <meta name='distribution' content='Global'>
        <meta name='subtitle' content='Empaques para flores'>
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

        <title>Plastinemor - empaques para flores de exportacion</title>

        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-T8Gy5hrqNKT+hzMclPo118YTQO6cYprQmhrYwIiQ/3axmI1hQomh7Ud2hPOy8SP1" crossorigin="anonymous">        
        <link rel="stylesheet" href="resources/css/global.css?<?php echo $rrand; ?>" />        
        <link rel="stylesheet" href="resources/css/index.css?<?php echo $rrand; ?>" />        
        <link href="resources/css/tdh-font.css" rel="stylesheet" type="text/css"/>

    </head>
    <body>

        <?php        
        require_once 'restricted/components/menu.php';
        require_once 'restricted/components/modal-client-info-gather.php';
        ?>

        <div class="row no-pad row-centered container-flex" id="bouquets-lema">
            <img src="resources/img/bouquests.png" alt="bouquets" id="bouquets-bg"/>
            <img src="resources/img/flores-con-mano.png" alt="empaques para flores" 
                 id="flores-con-mano" 
                 class=""/>            
            <h1 class="tdh-font text-120">CAPUCHONES</h1>
            <h1 class="tdh-font text-70 marg-top-minus-40 text-center">DE TRADICIÓN</h1>
        </div>          

        <!-- PANELS -->
        <div class="row no-pad row-centered marg-top-80">
            <div class="col-xs-12 col-sm-6 col-md-4"   id="info">
                <div class="panel panel-default">                
                    <div class="panel-body">
                        <i class="fa fa-info-circle fa-5x center-block fa-centered info" aria-hidden="true"></i>
                        <h2 class="text-center"><strong>A qué nos dedicamos?</strong></h2>
                        <p class=" text-justify text-dark">
                            Somos una empresa dedicada a la fabricación de empaques para flores de exportación, enfocado en el sector floricultor por más de 40 años, haciendo de Plastinemor líder en la industria de la fabriación de empaques para flores en Colombia y a nivel internacional. 
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-xs-12 col-sm-6 col-md-4"   id="globe">
                <div class="panel panel-default">                
                    <div class="panel-body">
                        <i class="fa fa-globe fa-5x center-block fa-centered globe" aria-hidden="true"></i>
                        <h2 class="text-center"><strong>Me los hacen llegar a otro país?</strong></h2>
                        <p class=" text-justify text-dark">
                            Si,ofrecemos servicios de exportación de los capuchones y los hacemos llegar a cualquier parte del mundo, siendo conocidos en paises como Estados Unidos, España, Japón. 
                        </p>
                    </div>
                </div>
            </div>              

            <div class="col-xs-12 col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-0"   id="question">
                <div class="panel panel-default">                
                    <div class="panel-body">
                        <i class="fa fa-question-circle fa-5x center-block fa-centered question" aria-hidden="true"></i>
                        <h2 class="text-center"><strong>Sólo fabrican lámina?</strong></h2>
                        <p class=" text-justify text-dark">
                            No,aparte de ofrecer servicios para fabricar capuchones, tenemos venta de lámina para las flores y vendemos la materia prima necesaria para su fabricación.
                        </p>
                    </div>
                </div>
            </div>       

            <div class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2"   id="envelope">
                <div class="panel panel-default">                
                    <div class="panel-body">
                        <i class="fa fa-envelope fa-5x center-block fa-centered envelope" aria-hidden="true"></i>
                        <h2 class="text-center bold"><strong>Tienes dudas?</strong></h2>
                        <p class="text-justify text-dark">
                            Plastinemor es la empresa indicada debido a la gran atención que se le proporciona a todos quienes decidan hacer uso de nuestros servicios, Si tiene dudas sobre algo mensionado anteriormente, no dude en <a href="#"><strong>dejarnos un mensaje</strong></a> y nos pondremos en contacto en menos de 24 horas pues en Plastinemor, entendemos que el tiempo y la calidad de los empaques deben ser prioridad numero uno.
                        </p>
                    </div>
                </div>
            </div>       
        </div>
        <!-- ./ PANELS -->


        <div class="row row-centered no-pad container-flex">
            <iframe src="https://www.youtube.com/embed/xdrzmcpZEJY" 
                    id="plasti-video"
                    frameborder="0" 
                    allowfullscreen
                    class="col-xs-12">                
            </iframe>                                    
        </div>

        <div class="container-flex min-h-300 marg-bot-170">
            <div class="col-xs-12 col-sm-10 col-sm-offset-1">
                <h2 class="text-center red">
                    Hoy en día PLASTINEMOR S.A.S está constituida como una de las empresas más reconocidas y de mayor trayectoria a nivel local, se espera que gracias a sus principios y políticas se puedan sentar precedentes para el crecimiento y desarrollo continuo.                
                </h2>                
            </div>
        </div>

        <?php
        require_once 'restricted/components/footer.php';
        require_once 'restricted/components/btn-scroll-up.php';
        require_once 'restricted/components/chat.php';
        require_once 'restricted/components/msg.php';
        ?>

        <script src="https://code.jquery.com/jquery-3.1.0.min.js"   integrity="sha256-cCueBR6CsyA4/9szpPfrX3s49M9vUU5BgtiJj06wt/s="   crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>                
        <script src="https://code.jquery.com/ui/1.12.0-rc.2/jquery-ui.min.js" integrity="sha256-55Jz3pBCF8z9jBO1qQ7cIf0L+neuPTD1u7Ytzrp2dqo=" crossorigin="anonymous"></script>
        <script src="resources/js/index.js?<?php echo $rrand; ?>" type="text/javascript"></script>
        <script src="resources/js/transit.js" type="text/javascript"></script>
        <script src="resources/js/global.js" type="text/javascript"></script>        
    </body>
</html>

<?php
$menuItem = new MenuItem();
$urlUtil = new UrlUtil();
?>
<div class="border-radius-just-bottom-3px menu-styling vw-100" id="menu-styling">
    <div class="col-sm-6 col-sm-offset-3">
        <h1 class="menu-title">
            <a href="<?php echo DOMAIN;?>index/"
               style="font-weight: lighter;color: #00426e"
               id="plasti-title">
                Plastinemor
            </a>
        </h1>
        <div class="menu-underline col-xs-12"></div>
    </div>
    <div class="col-xs-12 col-sm-8 col-sm-offset-2 horiz-ul">
        <ul class="list-inline list-unstyled">
            <?php
            require_once 'MenuItem.php';

            echo $menuItem->getMenuItem("Nosotros", "capuchones-para-flores/empaques-para-flores-colombia/",NULL);
            echo $menuItem->getMenuItem("Contacto", NULL," bring ");
            echo $menuItem->getMenuItem("Productos", "capuchones-para-flores/capuchones-productos/",NULL);
            ?>                                    
        </ul>        
    </div>
</div>
<?php    
class MenuItem {   
    
    public $urlutil;
    
    public function __construct() {
        $this->urlutil = new UrlUtil();
    }


    /**
     * Creates an HTML <li> item. <br />
     * If the URL is passed, then it'll create a <a href>  tag inside. <br />
     * If URL not needed then NULL is required.
     * @param type $itemValue
     * @param type $url
     * @return type String
     */
    public  function getMenuItem($itemValue,$url,$classes) {
        if($url == NULL){
            return "<li class='menu-item col-xs-4".$classes."'><span>" 
            . $itemValue . "</span><div class='menu-item-underline' /></li>";
        }else{
            return "<li class='menu-item col-xs-4".$classes."'><a href='"
                    .DOMAIN.$url."'>" 
                    . $itemValue . "</a><div class='menu-item-underline' /></li>";
        }
    }    
}
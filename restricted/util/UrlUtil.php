<?php
    class UrlUtil{
        
        private $directories;
        
        public function __construct() {
            $this->directories = array("capuchones-para-flores" => array("empaques-para-flores-colombia/",
                "capuchones-para-flores-bogota-colombia/"));
        }
        
        private function getParentFolder(){
            return basename(__DIR__);
        }
        
        public function setRelativeUrl($url){
            if(strpos($url, "index") !== false){
                return DOMAIN.$url;
            }else{
                if($this->getParentFolder() === ($goDir = $this->iterateDirectories($url))){                   
//                    return DOMAIN . $url;
                    return DOMAIN . $goDir . $url;
                }else{
                    return DOMAIN . $goDir . $url;
                }
            }
        }
        
        private function iterateDirectories($requestedPage){
            foreach($this->directories as $dir => $pages){
                foreach($pages as $page){
                    if(strpos($page, $requestedPage) !== false){
                        return $dir."/";
                    }
                }
            }
            return "";
        }// ./ iterateDirectories
    }
<?php
/**
 *
 * @author Esteban Rincón
 */
interface IAuth {
    
    function authenticate($usr,$pwd);
    
    function isAuthenticated();
    
    function destroyByTokn();
    
    function rememberUser($usr);
    
    
}
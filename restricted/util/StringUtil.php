<?php

class StringUtil {

    public static function generateRandomString($length = 10) {
        $characters = '%&/_#!0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public static function cleanTextForShow($text) {
        $s1 = htmlspecialchars(trim($text));
        return filter_var($s1,FILTER_SANITIZE_STRING);
    }

    public static function cleanTextForInsertion($text) {
        $step1 = trim(trim($text), "DELETE * FROM");
        $step2 = trim($step1, "WHERE 1");
        $step3 = trim($step2, "WHERE 1=1");
        $step4 = trim($step3, "delete * from");
        $step5 = trim($step4, "where 1");
        $step6 = trim($step5, "where 1=1");
        $step7 = trim($step6, "WHERE 1 = 1");
        $step8 = trim($step7, "WHERE 1= 1");
        $step9 = trim($step8, "WHERE 1 =1");
        $step10 = trim($step9, "where 1 = 1");
        $step11 = trim($step10, "where 1 =1");
        $step12 = trim($step11, "where 1= 1");
        
        return filter_var($step12,FILTER_SANITIZE_STRING);
    }

    public static function email_sanitize_and_validate($email){
        $emai = filter_var($email,FILTER_SANITIZE_EMAIL);
        return (!filter_var($emai, FILTER_VALIDATE_EMAIL) === false);
    }
}
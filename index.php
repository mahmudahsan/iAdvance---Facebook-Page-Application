<?php

    include_once "fbmain.php";

    //if user is logged in and session is valid.
    if ($user){
        $userInfo           = $facebook->api("/$user");
         
        //fql query example using legacy method call and passing parameter
        try{
            $fql    =   "select name, hometown_location, sex, pic_square from user where uid=" . $user;
            $param  =   array(
                'method'    => 'fql.query',
                'query'     => $fql,
                'callback'  => ''
            );
            $fqlResult   =   $facebook->api($param);
        }
        catch(Exception $o){
            d($o);
        }
    }

    //This is the signed_request decoded data
    $decodedSignedRequest = parse_signed_request($_REQUEST['signed_request'], $fbconfig['secret']);

    
    //set page to include default is home.php
    $page   =   "home.php";
    include_once "template.php";

    
?>
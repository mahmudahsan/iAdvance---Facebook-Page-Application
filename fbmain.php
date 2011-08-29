<?php
    //facebook application
    //@author: Mahmud Ahsan (http://mahmud.thinkdiff.net)
    include_once "config.php";
    
    $user            =   null; //facebook user uid
    try{
        include_once "facebook.php";
    }
    catch(Exception $o){
        error_log($o);
    }
    // Create our Application instance.
    $facebook = new Facebook(array(
      'appId'  => $fbconfig['appid'],
      'secret' => $fbconfig['secret'],
      'cookie' => true,
    ));

    //Facebook Authentication part
    $user       = $facebook->getUser();
    // We may or may not have this data based 
    // on whether the user is logged in.
    // If we have a $user id here, it means we know 
    // the user is logged into
    // Facebook, but we don’t know if the access token is valid. An access
    // token is invalid if the user logged out of Facebook.
    
    
    $loginUrl   = $facebook->getLoginUrl(
            array(
                'scope'         => 'email,offline_access,publish_stream,user_birthday,user_location,user_work_history,user_about_me,user_hometown',
                'redirect_uri'  => $fbconfig['appPageUrl'],
            )
    );
    
    $logoutUrl  = $facebook->getLogoutUrl(); 
    
    
    //if user doesn't allow your app and you want your user to see this on the app page then uncomment this code
    //and comment the next 49-52 lines code
    /*
    if (!$user) {
        echo "<a href='{$loginUrl}' target='_top'>Allow Access This App</a>";
        exit;
    }
    */
        
    //redirect user to login page if user is not logged in facebook and not authorized your application
    if (!$user) {
        echo "<script type='text/javascript'>top.location.href = '$loginUrl';</script>";
        exit;
    }

    function d($d) {
        echo '<pre>';
        print_r($d);
        echo '</pre>';
    }

    /**
     * This function is used to decoding signed_request data
     * more information is here http://developers.facebook.com/docs/authentication/signed_request
     */
    function parse_signed_request($signed_request, $secret) {
        list($encoded_sig, $payload) = explode('.', $signed_request, 2);

        // decode the data
        $sig = base64_url_decode($encoded_sig);
        $data = json_decode(base64_url_decode($payload), true);

        if (strtoupper($data['algorithm']) !== 'HMAC-SHA256') {
            error_log('Unknown algorithm. Expected HMAC-SHA256');
            return null;
        }

        // check sig
        $expected_sig = hash_hmac('sha256', $payload, $secret, $raw = true);
        if ($sig !== $expected_sig) {
            error_log('Bad Signed JSON signature!');
            return null;
        }

        return $data;
    }

    function base64_url_decode($input) {
        return base64_decode(strtr($input, '-_', '+/'));
    }

?>


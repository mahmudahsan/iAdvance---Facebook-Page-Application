<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:fb="http://www.facebook.com/2008/fbml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <title>iAdvance - Graph API & Iframe base Facebook Page App Development | Thinkdiff.net</title>
        <link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" rel="stylesheet" type="text/css"/>
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js"></script>
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"></script>
        <style type="text/css">
            a{
                text-decoration: none;
                color: blue;
            }
            a:hover{
                text-decoration: underline;
                color: olive;
            }
        </style>
        <script type="text/javascript">
            jQuery(document).ready(function () {
                jQuery("#tabs").tabs();
                jQuery("#other").bind('click', other);
            });

            function updateStatus(){
                var status  =   document.getElementById('status').value;
                
                jQuery.ajax({
                    type: "POST",
                    url: "<?=$fbconfig['baseUrl']?>/ajax.php",
                    data: "status=" + status,
                    success: function(msg){
                        alert(msg);
                    },
                    error: function(msg){
                        alert(msg);
                    }
                });
            }
            function updateStatusViaJavascriptAPICalling(){
                var status  =   document.getElementById('status').value;
                    FB.api('/me/feed', 'post', { message: status }, function(response) {
                        if (!response || response.error) {
                             alert('Error occured');
                        } else {
                             alert('Status updated Successfully');
                        }
                   });
            }
            function streamPublish(name, description, hrefTitle, hrefLink, userPrompt){
                FB.ui(
                {
                    method: 'stream.publish',
                    message: '',
                    attachment: {
                        name: name,
                        caption: '',
                        description: (description),
                        href: hrefLink
                    },
                    action_links: [
                        { text: hrefTitle, href: hrefLink }
                    ],
                    user_prompt_message: userPrompt
                },
                function(response) {

                });
            }
            function publishStream(){
                streamPublish("Stream Publish", 'Thinkdiff.net is again awesome. I just learned how to develop Iframe base facebook page application development. ', 'Checkout the Tutorial', 'http://thinkdiff.net', "Demo Facebook Application Tutorial");
            }
            
            function increaseIframeSize(w,h){
                var obj =   new Object;
                obj.width=w;
                obj.height=h;
                FB.Canvas.setSize(obj);
            }

            function newInvite(){
                 FB.ui({ method: 'apprequests',
                 message: 'come on man checkout my application. visit http://thinkdiff.net'});

            }

            function other(){
                jQuery("#pageload").load('other.php');
            }
        </script>
    </head>
<body>
    <div id="fb-root"></div>
    <script type="text/javascript" src="http://connect.facebook.net/en_US/all.js"></script>
     <script type="text/javascript">
       FB.init({
         appId  : '<?=$fbconfig['appid']?>',
         status : true, // check login status
         cookie : true, // enable cookies to allow the server to access the session
         xfbml  : true  // parse XFBML
       });
       
     </script>

    <?php echo $tutorialLink; ?>
    <br /><br />
    
    <a href="<?=$fbconfig['appPageUrl']?>" target="_top">Home</a> |
    <a href="#" onclick="newInvite(); return false;">Invite</a> |
    <a id="other"  href="#">Other Iframe</a>

    <br /><br />
    <div id="pageload">
     <?php
        if (isset($page)) {
             include_once $page;
        }
    ?>
    </div>
    </body>
</html>
<style type="text/css">
    #tabs ul li{
        font-size: 80%;
    }
    #tabs pre{
        font-size: 138%;
    }
    #tabs{
        font-size: 70%;
    }
    #tabs div a{
        color: blue;
    }
    .ui-tabs .ui-tabs-nav {
        padding: 0 !important;
    }
</style>
<div id="tabs">
    <ul>
        <li><a href="#fragment-1"><span>User Info</span></a></li>
        <li><a href="#fragment-2"><span>FQL Query</span></a></li>
        <li><a href="#fragment-3"><span>Stream Publish</span></a></li>
        <li><a href="#fragment-4"><span>Status Update</span></a></li>
        <li><a href="#fragment-5"><span>Social Plugin</span></a></li>
        <li><a href="#fragment-6"><span>Signed Request</span></a></li>
    </ul>
    <div id="fragment-1">
        <a href="#" onclick="increaseIframeSize(300, 500); return false;">Click Here Iframe width=300,height=500</a>
        <br />
        <a href="#" onclick="increaseIframeSize(500, 1800); return false;">Click Here Iframe width=500,height=1800</a>
        <br />
        
        <img src="http://graph.facebook.com/<?=$user?>/picture" alt="user photo" />
        <br />
        <div style="height: 400px; overflow: auto">
            <?php if (isset($userInfo)){ d($userInfo); } ?>
        </div>
    </div>
    <div id="fragment-2">
        <div style="height: 400px; overflow: auto">
        <?php
            echo "FQL QUERY: " . $fql;
            d($fqlResult);
        ?>
        </div>
    </div>
    <div id="fragment-3">
        <a href="#" onclick="publishStream(); return false;">Click Here To Show A DEMO Stream Publish Box</a>
    </div>
    <div id="fragment-4">
        <form name="statusUpdate" action="" method="">
            <textarea name="status" id="status" rows="4" cols="50"></textarea>
            <br />
            <input type="button" onclick="updateStatus(); return false;" value="Update Status via AJAX And PHP API" />
            <br />
            <input type="button" onclick="updateStatusViaJavascriptAPICalling(); return false;" value="Update Status via Facebook Javascript Library" />
        </form>
    </div>

    <div id="fragment-5">
        <a href="http://developers.facebook.com/docs/reference/plugins/comments" target="_blank">Facebook Comment Plugin</a>
         <fb:comments xid="aiwsh" numposts="10" width="425" publish_feed="true"></fb:comments>
    </div>

    <div id="fragment-6">
        <a href="http://developers.facebook.com/docs/authentication/signed_request" target="_blank">
            signed_request parameter is utilized to share information between Facebook and app
        </a>
        <table border="1" cellpadding="3" cellspacing="3">
            <tr>
                <td>
                    User's UID
                </td>
                <td>
                    <?=$decodedSignedRequest['user_id']?>
                </td>
            </tr>
            <tr>
                <td>
                    User like this page
                </td>
                <td>
                    <?php
                    if ($decodedSignedRequest['page']['liked'] == 1){
                        echo "Yes";
                    }
                    else{
                        echo "No";
                    }
                    ?>
                </td>
            </tr>
            <tr>
                <td>
                    User's Country
                </td>
                <td>
                    <?=$decodedSignedRequest['user']['country']?>
                </td>
            </tr>
        </table>
        <?php
            d($decodedSignedRequest);
        ?>
    </div>
</div>
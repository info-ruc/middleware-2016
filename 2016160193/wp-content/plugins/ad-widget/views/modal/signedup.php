<?php require 'header.php' ?>
<div id="header">
        <h1>Welcome to the Club!</h1>
        </div>
        <div id="clients-section">
            <table id="clients">
                <tr>
                    <td><a href="http://baristanet.com/"><img src="http://broadstreetads.com/assets/images/featured-clients/baristanet.png" /></a></td>
                    <td><a href="http://thebatavian.com/"><img src="http://broadstreetads.com/assets/images/featured-clients/batavian.png" /></a></td>
                    <td><a href="http://arlnow.com/"><img src="http://broadstreetads.com/assets/images/featured-clients/arlingtonnow.png" /></a></td>
                    <td><a href="http://hulafrog.com/"><img src="http://broadstreetads.com/assets/images/featured-clients/hulafrog.png" /></a></td>
                </tr>
                <tr>
                    <td><a href="http://natomasbuzz.com/"><img src="http://broadstreetads.com/assets/images/featured-clients/natomas.png" /></a></td>
                    <td><a href="http://www.sheepsheadbites.com/"><img src="http://broadstreetads.com/assets/images/featured-clients/sheepshead.png" /></a></td>
                    <td><a href="http://www.pvpost.com/"><img src="http://broadstreetads.com/assets/images/featured-clients/pvpost.png" /></a></td>
                    <td><a href="http://njnewscommons.com/"><img src="http://broadstreetads.com/assets/images/featured-clients/njnewscommons.png" /></a></td>
                </tr>
            </table>
        </div>
        <div id="info">
            
                <h2>
                    Your existing ads and any ads you create going forward will
                    have reporting available and be hosting in our cloud. You will
                    soon receive a welcome email. Thank you for taking a spin with Broadstreet!
                    <br />
                    <small><strong>Be sure to save unsaved widgets and refresh the widgets page after closing this window.</strong></small>
                </h2>    
            <div id="call-to-action">
                <a href="#" onclick="bs_close()" class="btn call-to-action">Close this Window</a>
            </div>

        </div>
<script>
    function bs_close() {
        var win = window.dialogArguments || opener || parent || top;

        if(typeof win.send_to_editor === 'function') 
        {
            win.send_to_editor();
        }
        else
        {
            win.tb_remove();
        }
    }
</script>
<?php require 'footer.php' ?>

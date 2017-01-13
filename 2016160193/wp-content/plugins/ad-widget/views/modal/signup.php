<?php require 'header.php' ?>
<div id="header">
            <h1>Join <span id="pub-count">500+</span> Publishers Who Upgraded</h1>
        </div>
        <div id="clients-section">
            <table id="clients">
                <tr>
                    <td><a href="http://baristanet.com/"><img src="http://broadstreetads.com/assets/app/images/featured-clients/baristanet.png" /></a></td>
                    <td><a href="http://thebatavian.com/"><img src="http://broadstreetads.com/assets/app/images/featured-clients/batavian.png" /></a></td>
                    <td><a href="http://arlnow.com/"><img src="http://broadstreetads.com/assets/app/images/featured-clients/arlingtonnow.png" /></a></td>
                    <td><a href="http://hulafrog.com/"><img src="http://broadstreetads.com/assets/app/images/featured-clients/hulafrog.png" /></a></td>
                </tr>
                <tr>
                    <td><a href="http://natomasbuzz.com/"><img src="http://broadstreetads.com/assets/app/images/featured-clients/natomas.png" /></a></td>
                    <td><a href="http://www.sheepsheadbites.com/"><img src="http://broadstreetads.com/assets/app/images/featured-clients/sheepshead.png" /></a></td>
                    <td><a href="http://www.pvpost.com/"><img src="http://broadstreetads.com/assets/app/images/featured-clients/pvpost.png" /></a></td>
                    <td><a href="http://njnewscommons.com/"><img src="http://broadstreetads.com/assets/app/images/featured-clients/njnewscommons.png" /></a></td>
                </tr>
            </table>
        </div>
        <div id="call-to-action">
            <form id="signup" action="?step=signup&status=agree" method="post">
                <?php if(!Broadstreet_Adwidget_Mini_Utility::getNetworkID()): ?>
                <input id="email" type="text" name="email" placeholder="your@email.com" value="<?php echo get_bloginfo('admin_email') ?>" />
                <a href="#" onclick="$('#signup').submit();" class="btn call-to-action">$5 / month. Click for an Instant Signup</a>
                <?php else: ?>
                <input type="hidden" name="resub" value="1" />
                <a href="#" onclick="$('#signup').submit();" class="btn call-to-action">$5 / month. Click to re-subscribe.</a>
                <?php endif; ?>
            </form>
        </div>
        <div id="info">
            <h2>Or, watch a demo first (and <a href="http://broadstreetads.com">check out our website</a>)</h2>    
        </div>
        <div style="width: 660px; margin: 0 auto 22px auto;">
            <iframe width="660" height="370" src="//www.youtube.com/embed/yAFFhjWnOgk" frameborder="0" allowfullscreen></iframe>
        </div>
<?php require 'footer.php' ?>

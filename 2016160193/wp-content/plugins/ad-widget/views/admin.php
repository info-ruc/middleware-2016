<div style="float: left; width: 550px;">
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=313569238757581";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<script>window.admin_email = '<?php bloginfo('admin_email'); ?>';</script>
<script>
    jQuery(function() {
        var bs = new Broadstreet.Network();
        bs.postList('#bs-blog');
    });
</script>

<h1>Wordpress Ad Widget</h1>
<script src="https://broadstreet-common.s3.amazonaws.com/broadstreet-net/init.js"></script>
<script type="text/javascript" src="http://cdn.broadstreetads.com/init.js"></script>


<?php if(Broadstreet_Adwidget_Mini_Utility::hasAdserving()): ?>

<h2>Adserver Subscription</h2>

You are currently subscribed to Broadstreet's Adserver, giving your site stress-free adserving,
and click/view reporting. You can cancel this subscription here. Canceling will revert
your ads to start serving from your site instead of an adserver.

<form method="post">
    <input style="background-color: red; color: white;" type="submit" name="cancel" value="Cancel Adserving Subscription">
</form>

<?php endif; ?>

<?php if(!Broadstreet_Adwidget_Mini_Utility::hasAdserving() && Broadstreet_Adwidget_Mini_Utility::hasNetwork()): ?>

<h2>Adserver Subscription</h2>

You were once subscribed to Broadstreet's Adserver, giving your site stress-free adserving,
and click/view reporting. You can re-enable your subscription here. Changes will
be immediate.

<form method="post">
    <input style="background-color: green; color: white;" type="submit" name="subscribe" value="Subscribe me for $5 / month">
</form>

<?php endif; ?>

<p>Thank you for using our plugin! This plugin was built by <a href="http://broadstreetads.com">Broadstreet</a>, the
company for independent publishers.</p>

<p>If you're a local publisher, please <strong><a href="http://broadstreetads.us5.list-manage.com/subscribe?u=508de363fda633d674a0a123b&id=e2fbcef169">sign up for our newsletter</a></strong>, and join the community.</p>

<p>To put an ad on your website, just go to <a href="widgets.php">the widgets page</a>, 
    and look for:</p>

<ul>
    <li><strong>Ad: HTML/Javascript Ad</strong></li>
    <li><strong>Ad: Image/Banner Ad</strong></li>
</ul>

<p>
Drag one of those into your a widget area, like a sidebar, and follow the
instructions! Send questions to kenny@broadstreetads.com .
</p>

<p>
Here's a short instructional video if you need help:
</p>

<iframe src="http://www.screenr.com/embed/u0t7" width="550" height="396" frameborder="0"></iframe>

</div>

<div style="float: left; width: 300px; margin-top: 10px; margin-left: 20px;">
<script type="text/javascript">broadstreet.zone(423);</script>
<br/>

<div>
    <div class="fb-like" data-href="http://www.facebook.com/broadstreetads" data-send="false" data-layout="box_count" data-width="450" data-show-faces="true"></div>
    <a href="https://twitter.com/broadstreetads" class="twitter-follow-button" data-show-count="false">Follow @broadstreetads</a>
    <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>    
</div>

<h2>The Streetlight</h2>
<p>A blog for local news publishers</p>
<div id="bs-blog"></div>



</div>

<div style="clear:both;"></div>
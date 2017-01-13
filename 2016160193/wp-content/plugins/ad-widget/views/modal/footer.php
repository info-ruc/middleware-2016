        <div id="footer">
            Broadstreet Ads &copy; <?php echo date('Y') ?> &minus; www.broadstreetads.com
        </div>
        <script src="https://broadstreet-common.s3.amazonaws.com/broadstreet-net/init.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
        <script type="text/javascript">

            var broadstreet  = new Broadstreet.Network();
            broadstreet.getNetworkStats(function(data){
                $('#pub-count').text(data.network_count);
            });
  
        </script>
    </body>
</html>
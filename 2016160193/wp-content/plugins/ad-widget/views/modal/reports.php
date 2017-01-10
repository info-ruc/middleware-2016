<?php

$ad_id  = sanitize_text_field($_GET['ad_id']);
$adv_id = sanitize_text_field($_GET['adv_id']);
$net_id = Broadstreet_Adwidget_Mini_Utility::getNetworkID();

$start  = sanitize_text_field(@$_GET['start']);
$end    = sanitize_text_field(@$_GET['end']);

$day = 60 * 60 * 24 * 31;

if($start && !$end)   $end = date('Y-m-d');
if($end   && !$start) $start = date('Y-m-d', strtotime($end) - $day);
if(!$start && !$end)  { $end = date('Y-m-d'); $start = date('Y-m-d', time() - $day); }

$api   = Broadstreet_Adwidget_Mini_Utility::getClient();
$error = false;
$stats = array();

try {
    $stats = $api->getAdvertisementReport($net_id, $adv_id, $ad_id, $start, $end);
} catch(Exception $ex) {
    $error = 'There was an error retrieving your report. Try selecting a valid date range of 2 years or smaller.';
}

?>
<?php require 'header.php' ?>
<style type="text/css">
    .datagrid table { border-collapse: collapse; text-align: left; width: 100%; } .datagrid {font: normal 12px/150% Arial, Helvetica, sans-serif; background: #fff; overflow: hidden; border: 1px solid #006699; -webkit-border-radius: 3px; -moz-border-radius: 3px; border-radius: 3px; }.datagrid table td, .datagrid table th { padding: 3px 10px; }.datagrid table thead th {background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #006699), color-stop(1, #00557F) );background:-moz-linear-gradient( center top, #006699 5%, #00557F 100% );filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#006699', endColorstr='#00557F');background-color:#006699; color:#FFFFFF; font-size: 15px; font-weight: bold; border-left: 1px solid #0070A8; } .datagrid table thead th:first-child { border: none; }.datagrid table tbody td { color: #00557F; border-left: 1px solid #E1EEF4;font-size: 12px;font-weight: normal; }.datagrid table tbody .alt td { background: #E1EEf4; color: #00557F; }.datagrid table tbody td:first-child { border-left: none; }.datagrid table tbody tr:last-child td { border-bottom: none; }.datagrid table tfoot td div { border-top: 1px solid #006699;background: #E1EEf4;} .datagrid table tfoot td { padding: 0; font-size: 12px } .datagrid table tfoot td div{ padding: 2px; }.datagrid table tfoot td ul { margin: 0; padding:0; list-style: none; text-align: right; }.datagrid table tfoot  li { display: inline; }.datagrid table tfoot li a { text-decoration: none; display: inline-block;  padding: 2px 8px; margin: 1px;color: #FFFFFF;border: 1px solid #006699;-webkit-border-radius: 3px; -moz-border-radius: 3px; border-radius: 3px; background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #006699), color-stop(1, #00557F) );background:-moz-linear-gradient( center top, #006699 5%, #00557F 100% );filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#006699', endColorstr='#00557F');background-color:#006699; }.datagrid table tfoot ul.active, .datagrid table tfoot ul a:hover { text-decoration: none;border-color: #00557F; color: #FFFFFF; background: none; background-color:#006699;}
    body { padding-bottom: 50px; }
    .date-container {
        background-color: #fff;
        padding: 10px;
        text-align: center;
    }
    .alert {
        padding: 8px 35px 8px 14px;
        text-shadow: 0 1px 0 rgba(255, 255, 255, 0.5);
        background-color: #fcf8e3;
        border: 1px solid #fbeed5;
    }
    .alert-error {
        color: #b94a48;
        background-color: #f2dede;
        border-color: #eed3d7;
    }

</style>
<div id="header">
    <h1>Click Report from <?php echo $start ?> to <?php echo $end ?></h1>
</div>
<?php if($error): ?>
<div class="alert alert-error">
    <?php echo $error; ?>
</div>
<?php endif; ?>
<div class="date-container">
    <form id="report" action="?" method="get">
        <input type="text" name="start" placeholder="your@email.com" value="<?php echo $start ?>" />
            &nbsp;&nbsp;&nbsp;&nbsp; through &nbsp;&nbsp;&nbsp;&nbsp;
        <input type="text" name="end" placeholder="your@email.com" value="<?php echo $end ?>" />
        <input type="hidden" name="ad_id" value="<?php echo $ad_id ?>" />
        <input type="hidden" name="adv_id" value="<?php echo $adv_id ?>" />
        <input type="hidden" name="step" value="reports" />
        <a href="#" onclick="$('#report').submit();" class="btn call-to-action">Go </a>
    </form>
</div>
<div style="padding: 0px 0px 5px 5px; color: #808080;">* Stats are delayed by roughly 10 minutes</div>
<div style="margin: 0 5px;" class="datagrid">
    <table id="stats">
        <thead>
            <tr>
                <th>Date</th>
                <th>Views</th>
                <th>Clicks</th>
                <th>Click-Through Rate</th>
            </tr>
        </thead>
        <tbody>
            <?php if(count($stats)): ?>
            <?php $count = 0; foreach($stats as $day): ?>
            <tr <?php if($count % 2 == 0) echo "class='alt'" ?>>
                <td><?php echo $day->date ?></td>
                <td><?php echo $day->views ?></td>
                <td><?php echo $day->clicks ?></td>
                <td><?php if($day->views == 0) echo 'NA'; else echo round($day->clicks / $day->views, 2) . '' ?></td>
            </tr>
            <?php $count++; endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
</div>
<div id="call-to-action">
        <a href="#" onclick="(window.dialogArguments || opener || parent || top).tb_remove(); return false;" class="btn call-to-action">Close</a>
</div>
<?php require 'footer.php' ?>

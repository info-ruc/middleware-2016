<div class="wrap">
	<div id="icon-options-general" class="icon32"><br></div><h2>WP Solo Share设置</h2><br>
	<form method="post" action="options.php">
		<?php 
			settings_fields( 'wpshare_setting_group' );
			$setting = wpshare_get_setting();
		?>
		<table class="form-table">
			<tbody>
				<tr valign="top">
					<th scope="row"><label>使用方法</label></th>
					<td>
						添加 <code>&lt;?php wp_share();?&gt;</code> 到需要的位置
					</td>
				</tr>
				<tr valign="top">
					<th scope="row"><label>二维码设置</label></th>
					<td>
						<ul class="wpshare-color-ul">
                            <?php $pay_img = array(
									array(
										'title' => '二维码地址',
										'key' => 'pay_img',
										'default' => ''
									)
								);
								foreach ($pay_img as $key => $V) {
									?>
									<li class="wpshare-color-li">
										<code><?php echo $V['title'];?></code>
										<?php $pay_img = $setting[$V['key']] ? $setting[$V['key']] : $V['default'];?>
										<input name="<?php echo wpshare_setting_key($V['key']);?>" type="text" value="<?php echo $pay_img;?>" id="wpshare-default-color" data-default-color="<?php echo $V['default'];?>" class="regular-text" />
									</li>
								<?php } 
							?>
						</ul>
						<p class="description">本插件由<strong> 水冷眸博客 </strong>出品，另有纯代码版本，点此查看<a href="http://www.slmwp.com/transplant-zan-share-admire.html" target="_blank">【原创】移植知更鸟的点赞、分享、打赏的样式教程</a></p>
					</td>
				</tr>
			</tbody>
		</table>
		<div class="wpshare-submit-form">
			<input type="submit" class="button-primary muhermit_submit_form_btn" name="save" value="<?php _e('Save Changes') ?>"/>
		</div>
	</form>
	<style>
		.wpshare-color-li{position: relative;padding-left: 80px}
		.wpshare-color-li code{position: absolute;left: 0;top: 1px;}
	</style>		
</div>
<div class="wrap">
	<?php 
	echo '<h2>' . __( 'Theme Links', 'ttt-201501' ) . '</h2>';

	// Save and Update
	if (isset($_POST['ttt_update_settings'])) {

		update_option('ttt_fsc_page', $_POST['ttt_fsc_page'] );
		update_option('ttt_svane_page', $_POST['ttt_svane_page'] );
		update_option('ttt_terms_page', $_POST['ttt_terms_page'] );

		echo '<div id="message" class="updated">' . __( 'Settings saved', 'ttt-201501' ) . '</div>';
	}
		
		
	$fscPage	= get_option("ttt_fsc_page");
	$svanePage	= get_option("ttt_svane_page");
	$termsPage	= get_option("ttt_terms_page");
	$pages = get_pages();

	?>

	<form method="POST" action="">
		<table class="form-table">
			<tr valign="top">
				<th scope="row">
					<label for="fsc-page">
						<?php _e( 'FSC certifikat', 'ttt-201501' ); ?>
					</label> 
				</th>
				<td>
					
					<select name="ttt_fsc_page" id="fsc-page">
					<?php
						foreach ($pages as $page) :
							echo '<option value="' . $page->ID . '" ' . selected( $fscPage, $page->ID, false ) . '>';
								echo $page->post_title;
							echo '</option>';
						endforeach;
					?>
					</select>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row">
					<label for="svane-page">
						<?php _e( 'Svanemærkning', 'ttt-201501' ); ?>
					</label> 
				</th>
				<td>
					<?php $pages = get_pages(); ?>
					
					<select name="ttt_svane_page" id="svane-page">
					<?php
						foreach ($pages as $page) :
							echo '<option value="'. $page->ID . '" ' . selected( $svanePage, $page->ID, false ) . '>';
								echo $page->post_title;
							echo '</option>';
						endforeach;
					?>
					</select>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row">
					<label for="terms-page">
						<?php _e( 'Terms and Conditions', 'ttt-201501' ); ?>
					</label> 
				</th>
				<td>
					<?php $pages = get_pages(); ?>
					
					<select name="ttt_terms_page" id="terms-page">
					<?php
						foreach ($pages as $page) :
							echo '<option value="'. $page->ID . '" ' . selected( $termsPage, $page->ID, false ) . '>';
								echo $page->post_title;
							echo '</option>';
						endforeach;
					?>
					</select>
				</td>
			</tr>
		</table>
		<input type="hidden" name="ttt_update_settings" value="Y" />
		<p>
			<input type="submit" value="<?php _e( 'Save settings', 'ttt-201501' ); ?>" class="button-primary"/>
		</p>
	</form>
</div>
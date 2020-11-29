<?php
/**
 * Template for displaying search forms in Twenty Eleven
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */
?>
	<form method="get" id="searchform1" action="">
		<label for="s" class="assistive-text"><?php _e( 'Search', 'twentyeleven' ); ?></label>
		<input type="text" class="field" name="lfp" id="s" placeholder="<?php esc_attr_e( 'photos ', 'twentyeleven' ); ?>" />
		<input type="text" style=" display:none;visibility: hidden;" name="uID" id="uq-uid" value="<?php echo $_GET['uID'];?>" />
		<input type="text" style=" display:none;visibility: hidden;" name="sID" id="uq-uid" value="<?php echo $_GET['sID'];?>" />
		<input type="text" style=" display:none;visibility: hidden; "name="offset" id="uq-uid" value="<?php echo $_GET['offset'];?>" />
		<input type="submit" class="submit" name="submit" id="searchsubmit" value="<?php esc_attr_e( 'Search', 'twentyeleven' ); ?>" />
	</form>

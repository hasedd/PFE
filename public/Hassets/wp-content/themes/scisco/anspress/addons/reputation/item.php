<?php
/**
 * Template for user reputation item.
 *
 * Render reputation item in authors page.
 *
 * @author  Rahul Aryan <support@anspress.io>
 * @link    https://anspress.io/
 * @since   4.0.0
 * @package AnsPress
 */

?>
<div class="scisco-rep-item">
	<div class="scisco-rep-item-icon">
		<i class="<?php $reputations->the_icon(); ?> <?php $reputations->the_event(); ?>"></i>
	</div>
	<div class="scisco-rep-item-activity">
		<div class="scisco-rep-item-activity-title"><?php $reputations->the_activity(); ?> <?php $reputations->the_date(); ?></div>
		<div class="scisco-rep-item-activity-content"><?php $reputations->the_ref_content(); ?></div>
	</div>
	<div class="scisco-rep-item-points">
		<span><?php $reputations->the_points(); ?></span>
	</div>
</div>
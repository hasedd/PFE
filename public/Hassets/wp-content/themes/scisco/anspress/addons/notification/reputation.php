<?php
/**
 * Notification reputation type template.
 *
 * Render notification item if ref_type is reputation.
 *
 * @author  Rahul Aryan <support@anspress.io>
 * @link    https://anspress.io/
 * @since   4.0.0
 * @package AnsPress
 */

?>
<div class="ap-noti-item clearfix <?php if ($this->object->noti_seen == 0) { echo 'not-seen'; } ?>">
	<div class="ap-noti-rep"><?php $this->the_reputation_points(); ?></div>
	<a class="ap-noti-inner" href="<?php $this->the_permalink(); ?>">
		<?php $this->the_verb(); ?>
		<time class="ap-noti-date"><i class="fas fa-clock"></i> <?php $this->the_date(); ?></time>
	</a>
</div>

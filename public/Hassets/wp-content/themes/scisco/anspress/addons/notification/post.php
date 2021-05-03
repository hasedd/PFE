<div class="ap-noti-item clearfix <?php if ($this->object->noti_seen == 0) { echo 'not-seen'; } ?>">
	<?php if ( 'vote_down' === $this->object->noti_verb ) : ?>
		<div class="ap-noti-icon <?php $this->the_icon(); ?>"></div>
	<?php else : ?>
		<div class="ap-noti-avatar"><?php $this->the_actor_avatar(100); ?></div>
	<?php endif; ?>
	<a class="ap-noti-inner" href="<?php $this->the_permalink(); ?>">
		<strong class="ap-not-actor"><?php $this->the_actor(); ?></strong> <?php $this->the_verb(); ?>
		<strong class="ap-not-ref"><?php $this->the_ref_title(); ?></strong>
		<time class="ap-noti-date"><i class="fas fa-clock"></i> <?php $this->the_date(); ?></time>
	</a>
</div>

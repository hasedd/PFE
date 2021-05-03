<?php 
$scisco_icons = get_theme_mod( 'scisco_footer_icons' );
foreach ($scisco_icons as $entry) {
$icon = $desc = $destination = $target = $tooltip_output = '';
if ( isset( $entry['icon'] ) ) {            
    $icon = $entry['icon'];
} 
if ( isset( $entry['desc'] ) ) {            
    $desc = $entry['desc'];
}
if ( isset( $entry['destination_url'] ) ) {            
    $destination = $entry['destination_url'];
}
if ( isset( $entry['link_target'] ) ) {            
    $target = $entry['link_target'];
}

if (!empty($desc)) {
?>
<li data-toggle="tooltip" data-placement="top" title="<?php echo esc_attr($desc); ?>">
    <a class="scisco-social-btn btn-<?php echo esc_attr($icon); ?>" href="<?php echo esc_url($destination); ?>" target="<?php echo esc_attr($target); ?>"><span aria-hidden="true" class="fab fa-<?php echo esc_attr($icon); ?>"></span></a>
</li>
<?php } else { ?>
<li>
    <a class="scisco-social-btn btn-<?php echo esc_attr($icon); ?>" href="<?php echo esc_url($destination); ?>" target="<?php echo esc_attr($target); ?>"><span aria-hidden="true" class="fab fa-<?php echo esc_attr($icon); ?>"></span></a>
</li>
<?php } 
} ?>
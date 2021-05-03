<?php
/**
 * Template for search form.
 * Different from WP default searchfrom.php. This only search for question and answer.
 *
 * @package AnsPress
 * @author  Rahul Aryan <support@anspress.io>
 *
 * @since   3.0.0
 * @since   4.1.0 Changed action link to home. Added post_type hidden field.
 */

?>

<form id="ap-search-form" class="ap-search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
    <div class="input-group">
	<input type="text" class="form-control autocomplete-questions" placeholder="<?php esc_attr_e('Search questions...', 'scisco'); ?>" name="s" />
	<input type="hidden" name="post_type" value="question" />
        <div class="input-group-append"> 
            <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i></button>
        </div>
    </div>
</form>

<form role="search" method="get" action="<?php echo esc_url(home_url( '/' )); ?>">
    <div class="input-group">
    <input type="text" class="form-control autocomplete-posts" placeholder="<?php esc_attr_e('Enter a keyword...', 'scisco'); ?>" name="s" />
        <div class="input-group-append"> 
            <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i></button>
        </div>
    </div>
</form>
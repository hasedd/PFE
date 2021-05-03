<?php
function scisco_get_breadcrumb_parents( $id, $tax, $visited = array() ) {
    $chain = '';
    $parent = get_term( $id, $tax );
  
    if ( is_wp_error( $parent ) ) {
        return $parent;
    }
  
    $name = $parent->name;
  
    if ( $parent->parent && ( $parent->parent != $parent->term_id ) && !in_array( $parent->parent, $visited ) ) {
        $visited[] = $parent->parent;
        $chain .= scisco_get_breadcrumb_parents( $parent->parent, $tax, $visited );
    }
  
    $chain .= '<li class="breadcrumb-item"><a href="' . esc_url( get_category_link( $parent->term_id ) ) . '">' . $name. '</a>' . '</li>';
  
    return $chain;
}


function scisco_bootstrap_breadcrumb() {
    global $post;
  
    $html = '<ol class="breadcrumb breadcrumb-links breadcrumb-dark">';
  
    if (is_front_page()) {
        $html .= '<li class="breadcrumb-item active"><i class="fas fa-home"></i></li>';
    }

    elseif (is_home()) {
        $html .= '<li class="breadcrumb-item"><a href="' . esc_url(home_url('/')) . '"><i class="fas fa-home"></i></a></li>';
        $html .= '<li class="breadcrumb-item active">' . esc_html__( 'Blog', 'scisco' ) . '</li>';
    }
  
    else {
        $html .= '<li class="breadcrumb-item"><a href="' . esc_url(home_url('/')) . '"><i class="fas fa-home"></i></a></li>';

        if ( is_attachment() ) {
            $parent = get_post($post->post_parent);
            $categories = get_the_category($parent->ID);
      
            if ( $categories[0] ) {
                $html .= scisco_get_breadcrumb_parents($categories[0], 'category');
            }
      
            $html .= '<li class="breadcrumb-item"><a href="' . esc_url( get_permalink( $parent ) ) . '">' . $parent->post_title . '</a></li>';
            $html .= '<li class="breadcrumb-item active">' . get_the_title() . '</li>';
        }
    
        elseif ( is_category() ) {
            $category = get_category( get_query_var( 'cat' ) );
            
            if (get_option( 'page_for_posts' )) {
                $html .= '<li class="breadcrumb-item"><a href="' . get_permalink( get_option( 'page_for_posts' ) ) . '">' . esc_html__( 'Blog', 'scisco' ) . '</a></li>';
            }
      
            if ( $category->parent != 0 ) {
                $html .= scisco_get_breadcrumb_parents( $category->parent, 'category' );
            }
            
            $html .= '<li class="breadcrumb-item active">' . single_cat_title( '', false ) . '</li>';
        }
    
        elseif ( is_page() && !is_front_page() ) {
            $parent_id = $post->post_parent;
            $parent_pages = array();
      
            while ( $parent_id ) {
                $page = get_page($parent_id);
                $parent_pages[] = $page;
                $parent_id = $page->post_parent;
            }
      
            $parent_pages = array_reverse( $parent_pages );
      
            if ( !empty( $parent_pages ) ) {
                foreach ( $parent_pages as $parent ) {
                    $html .= '<li class="breadcrumb-item"><a href="' . esc_url( get_permalink( $parent->ID ) ) . '">' . get_the_title( $parent->ID ) . '</a></li>';
                }
            }
      
            $html .= '<li class="breadcrumb-item active">' . get_the_title() . '</li>';
        }
    
        elseif ( is_singular( 'post' ) ) {
            $categories = get_the_category();
      
            if (isset($categories[0])) {
                $html .= scisco_get_breadcrumb_parents($categories[0], 'category');
            }
      
            $html .= '<li class="breadcrumb-item active">' . get_the_title() . '</li>';
        }

        elseif ( is_singular( 'job_listing' ) ) {
            if (get_option('job_manager_jobs_page_id')) {
                $jobs_page_url = get_permalink(get_option('job_manager_jobs_page_id'));
                $jobs_page_title = get_the_title(get_option('job_manager_jobs_page_id'));
                $html .= '<li class="breadcrumb-item"><a href="' . esc_url($jobs_page_url) . '">' . esc_html($jobs_page_title) . '</a></li>';
            }

            $html .= '<li class="breadcrumb-item active">' . get_the_title() . '</li>';
        }
    
        elseif ( is_tag() ) {
            if (get_option( 'page_for_posts' )) {
                $html .= '<li class="breadcrumb-item"><a href="' . get_permalink( get_option( 'page_for_posts' ) ) . '">' . esc_html__( 'Blog', 'scisco' ) . '</a></li>';
            }
            $html .= '<li class="breadcrumb-item active">' . single_tag_title( '', false ) . '</li>';
        }
    
        elseif ( is_day() ) {
            if (get_option( 'page_for_posts' )) {
                $html .= '<li class="breadcrumb-item"><a href="' . get_permalink( get_option( 'page_for_posts' ) ) . '">' . esc_html__( 'Blog', 'scisco' ) . '</a></li>';
            }
            $html .= '<li class="breadcrumb-item"><a href="' . esc_url( get_year_link( get_the_time( 'Y' ) ) ) . '">' . get_the_time( 'Y' ) . '</a></li>';
            $html .= '<li class="breadcrumb-item"><a href="' . esc_url( get_month_link( get_the_time( 'Y' ), get_the_time( 'm' ) ) ) . '">' . get_the_time( 'm' ) . '</a></li>';
            $html .= '<li class="breadcrumb-item active">' . get_the_time('d') . '</li>';
        }
    
        elseif ( is_month() ) {
            if (get_option( 'page_for_posts' )) {
                $html .= '<li class="breadcrumb-item"><a href="' . get_permalink( get_option( 'page_for_posts' ) ) . '">' . esc_html__( 'Blog', 'scisco' ) . '</a></li>';
            }
            $html .= '<li class="breadcrumb-item"><a href="' . esc_url( get_year_link( get_the_time( 'Y' ) ) ) . '">' . get_the_time( 'Y' ) . '</a></li>';
            $html .= '<li class="breadcrumb-item active">' . get_the_time( 'F' ) . '</li>';
        }
    
        elseif ( is_year() ) {
            if (get_option( 'page_for_posts' )) {
                $html .= '<li class="breadcrumb-item"><a href="' . get_permalink( get_option( 'page_for_posts' ) ) . '">' . esc_html__( 'Blog', 'scisco' ) . '</a></li>';
            }
            $html .= '<li class="breadcrumb-item active">' . get_the_time( 'Y' ) . '</li>';
        }
    
        elseif ( is_author() ) {
            $html .= '<li class="breadcrumb-item active">' . get_the_author() . '</li>';
        }
    
        elseif ( is_search() ) {
      
        }
    
        elseif ( is_404() ) {
      
        }
    
  }
  
  $html .= '</ol>';
  
  echo wp_kses_post($html);
}
?>
<?php
/**
 * Display a list of campaigns.
 *
 * Override this template by copying it to yourtheme/charitable/widgets/campaigns.php
 *
 * @author  Studio 164a
 * @since   1.0.0
 */

$campaigns = $view_args[ 'campaigns' ];

$show_thumbnail = isset( $view_args[ 'show_thumbnail' ] ) ? $view_args[ 'show_thumbnail' ] : true;
$thumbnail_size = apply_filters( 'charitable_campaign_widget_thumbnail_size', 'borntogive-70x70' );

    $terms = get_terms('campaign_category');



if ( ! $campaigns->have_posts() ) :
    return;
endif;

echo $view_args[ 'before_widget' ];

if ( ! empty( $view_args[ 'title' ] ) ) :

    echo $view_args[ 'before_title' ] . $view_args[ 'title' ] . $view_args[ 'after_title' ];

endif;

?>

<ol class="campaigns">
<?php
//do_shortcode('[campaigns category="Educazione"]');
//add_filter( 'widget_text', 'do_shortcode' );
    $terms = get_terms('campaign_category');

while( $campaigns->have_posts() ) :
//echo do_shortcode('[campaigns id=188]');

  //  do_shortcode('[campaigns category="Educazione"]');
    do_shortcode('[campaigns id=67]');
    echo do_shortcode('[campaigns id=67]');
    echo 'test------| id'.do_shortcode('[campaigns id=67]');

echo 'test------category |'.do_shortcode('[campaigns category=educazione]');

//do_shortcode('[campaigns category=Educazione]');
    $campaigns->the_post();

        $terms = get_terms('campaign_category');

    
        $campaign = new Charitable_Campaign( get_the_ID() );
                    $donated = $campaign->get_percent_donated();
                    $donated = str_replace("%", "", $donated);
                    if($donated<=30)
                    {
                            $color = 'F23827';
                    }
                    elseif($donated>30&&$donated<=60)
                    {
                            $color = 'F6bb42';
                    }
                    else
                    {
                            $color = '8cc152';
                    }
    ?>
<li>
    <a href="<?php the_permalink() ?>" class="cause-thumb">
    
    <?php 
        if ( $show_thumbnail && has_post_thumbnail() ) :
            the_post_thumbnail( $thumbnail_size, array('class'=>'img-thumbnail') );
		else :
			echo '<img src="'.get_template_directory_uri().'/images/cause-thumb.png" alt="">';
        endif;
        ?>
                                        <div class="cProgress" data-complete="<?php echo esc_attr($donated); ?>" data-color="<?php echo esc_attr($color); ?>">
                                            <strong></strong>
                                        </div>
                                    </a>
                                   	<h5><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h5>
                                    <span class="meta-data"><?php echo ''.$campaign->get_time_left(); ?></span>
                                </li>

<?php  endwhile;
  wp_reset_query();
?>

</ol>

<?php

echo $view_args[ 'after_widget' ];

wp_reset_postdata();
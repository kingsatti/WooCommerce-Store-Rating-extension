<?php
/**
 * Plugin Name: Qaisar Satti Store Rating
 * Plugin URI: https://store.qaisarsatti.com
 * Description: Get the store rating.
 * Version: 1.0.0
 * Text Domain: Qaisar Satti Store
 * Author: Qaisar Satti
 * Author URI: https://store.qaisarsatti.com
 */
 if (!in_array('woocommerce/woocommerce.php', apply_filters('active_plugins', get_option('active_plugins'))) ) {
	function qaisarsatti_storerating_admin_notice() {
		$covid19_allowed_tags = array(
			'a' => array(
				'class' => array(),
				'href'  => array(),
				'rel'   => array(),
				'title' => array(),
			),
			'b' => array(),
			'div' => array(
				'class' => array(),
				'title' => array(),
				'style' => array(),
			),
			'p' => array(
				'class' => array(),
			),
			'strong' => array(),
		);
		// Deactivate the plugin
		deactivate_plugins(__FILE__);
		$covid19_woo_check = '<div id="message" class="error">
			<p><strong>Store Rating plugin is inactive.</strong> The <a href="http://wordpress.org/extend/plugins/woocommerce/">WooCommerce plugin</a> must be active for this plugin to work. Please install &amp; activate WooCommerce »</p></div>';
		echo wp_kses( __( $covid19_woo_check, 'qaisarsatti-storerating' ), $covid19_allowed_tags);
	}
	add_action('admin_notices', 'qaisarsatti_storerating_admin_notice');
}

function object_to_array($object){

    if (is_array($object) OR is_object($object)){

        $result = array(); 
        foreach($object as $key => $value){ 

        	if($value->get_review_count()){

            	$result[$key] = array('rating_counts'=>$value->get_rating_counts(),
            					'average_rating'=>$value->get_average_rating(),
            					'review_count'=>$value->get_review_count());
            }

        }

        return $result;
    }

    return $object;
}

function qaisarsatti_storerating($atts){	

	ob_start();
	
	$products = wc_get_products( array( 'status' => 'publish', 'limit' => -1 ) );

	$arrays = object_to_array($products);

	?>

	<style>

		.qst-ulstorerating {
	    	margin: 0;
	    	list-style:none;
	    	padding:0;
	    	margin-bottom: 55px;
		}

		.qst-rating-box p{
			margin: 0;
		}

		.qst-title-style{
			margin:0;
		}

		.qst-ulstorerating h4,
		.qst-style-5 h4,
		.qst-style-6 h4,
		.qst-style-7 h4,
		.qst-style-8 h4{
			font-size: 18px;
			line-height: 28px;
			font-weight: bold;
		}

		.qst-ulstorerating .qst-listorerating{
	    	display: inline-block;
	    	vertical-align: middle;
	    	margin:5px 10px 5px 0px;
		}

		.qst-style-5 li,
		.qst-style-6 li{
			margin: 10px 0px;
		}

		.qst-style-4{
			box-sizing: border-box;
			padding: 25px 25px 0px;
			margin-bottom: 25px;
			border: 1px solid #eee;
			text-align: left;
			box-shadow: 3px 0 12px 0 rgb(154 168 255 / 19%);
			border-radius: 8px;
		}

		.qst-style-5{
			box-sizing: border-box;
			padding: 45px 20px;
			border: 1px solid #eee;
			text-align: center;
			border-radius: 50%;
			width: 220px;
			height: 220px;
			margin: 20px auto;
			-webkit-transition: 0.5s;
		    -o-transition: 0.5s;
		    -moz-transition: 0.5s;
		    transition: 0.5s;
		    background-color: white;
		    box-shadow: 3px 0 12px 0 rgb(154 168 255 / 19%);
		}

		.qst-style-5 .star-rating,
		.qst-style-6 .star-rating,
		.qst-style-7 .star-rating,
		.qst-style-8 .star-rating{
			margin: 10px auto;
		}

		.qst-style-6{
			box-sizing: border-box;
			padding: 25px;
			border: 1px solid #eee;
			text-align: center;
			border-radius: 20px;
			width: 220px;
			height: 220px;
			margin: 20px auto;
			-webkit-transition: 0.5s;
		    -o-transition: 0.5s;
		    -moz-transition: 0.5s;
		    transition: 0.5s;
		    background-color: #f8f9ff;
		    box-shadow: 3px 0 12px 0 rgb(154 168 255 / 19%);
		}

		.qst-style-6 h3,
		.qst-style-7 h3,
		.qst-style-8 h3{
			text-align: center;
			font-size: 44px;
			line-height: 56px;
			font-weight: 600;
			margin: 0;
		}

		.qst-style-7 h3,
		.qst-style-7 h4,
		.qst-style-8 h4,
		.qst-style-8 h3{
			color: white;
		}

		.qst-style-7{
			box-sizing: border-box;
		    padding: 20px 20px;
		    border: 1px solid #eee;
		    text-align: center;
		    border-radius: 20px;
		    width: 260px;
		    height: 260px;
		    margin: 20px auto;
		    -webkit-transition: 0.5s;
		    -o-transition: 0.5s;
		    -moz-transition: 0.5s;
		    transition: 0.5s;
		    background-color: #1f2439;
		    box-shadow: 3px 0 12px 0 rgb(154 168 255 / 19%);
		    color: white;
		}

		.qst-style-7 .qst-bold-border{
			display: block;
		    border: 5px solid #e55469;
		    border-radius: 50%;
		    height: 210px;
		    width: 210px;
		    padding: 15px;
		    margin: 0 auto;
		}

		.qst-bold-border .star-rating span:before{
			color: #e55469 !important;
		}

		.qst-style-8{
			box-sizing: border-box;
		    padding: 35px 25px;
		    width: 235px;
		    height: 235px;
		    margin: 20px auto;
		    -webkit-transition: 0.5s;
		    -o-transition: 0.5s;
		    -moz-transition: 0.5s;
		    transition: 0.5s;
		    background-color: #1f2439;;
		    box-shadow: 3px 0 12px 0 rgb(154 168 255 / 19%);
		    color: white;
		    border: 5px solid #e55469;
		    border-radius: 50%;
		    text-align: center;
		}

		.qst-bold-border .star-rating span:before{
			color: #e55469 !important;
		}


	</style>

	<?php
		$total = 0; 
		$j = 0;
		$totalRating = 0;

    	if($arrays){

      		foreach($arrays as $array){

       			if($array['review_count'] > 0)

   				$total = $total+ $array['review_count'];

   				$j = $j+1;

   			 	$totalRating = $totalRating + $array['average_rating'];

            }
            
        }
        if(!$j)
        {
        	return;
        }
    ?>

    	<div class="qst-rating-box">

    		
    		<?php if(isset($atts['style']) && $atts['style']=='style1') { ?>
    		<div class="qst-style-8">
    			<div class="qst-bold-border">
    				<h4 class="qst-title-style"><?php echo esc_html( __( 'Store Rating', 'qaisarsatti_topseller' ) ); ?></h4>
	    			<h3><?php echo round($totalRating/$j,1); ?></h3>
	    			<?php echo wc_get_rating_html( round($totalRating/$j,1), $total ); ?>
	    			<p><strong><?php echo $total; ?> <?php echo esc_html( 'Customer Ratings', 'qaisarsatti_topseller'); ?></strong></p>
    			</div>
	      	</div>
	      <?php } else if(isset($atts['style']) && $atts['style']=='style2') { ?>

	      	<div class="qst-style-7">
    			<div class="qst-bold-border">
    				<h4 class="qst-title-style"><?php echo esc_html( __( 'Store Rating', 'qaisarsatti_topseller' ) ); ?></h4>
	    			<h3><?php echo round($totalRating/$j,1); ?></h3>
	    			<?php echo wc_get_rating_html( round($totalRating/$j,1), $total ); ?>
	    			<p><strong><?php echo $total; ?> <?php echo esc_html( 'Customer Ratings', 'qaisarsatti_topseller'); ?></strong></p>
    			</div>
	      	</div>

	      	 <?php } else if(isset($atts['style']) &&  $atts['style']=='style3') { ?>

	      	 	<div class="qst-style-5">
    			<h4 class="qst-title-style"><?php echo esc_html( __( 'Store Rating', 'qaisarsatti_topseller' ) ); ?></h4>
    			<?php echo wc_get_rating_html( round($totalRating/$j,1), $total ); ?>
    			<?php echo wc_get_star_rating_html( round($totalRating/$j,1), $total ); ?>
	      	</div>
    		
			<?php }  else  { ?>
	      		<div class="qst-style-6">
    			<h4 class="qst-title-style"><?php echo esc_html( __( 'Store Rating', 'qaisarsatti_topseller' ) ); ?></h4>
    			<h3><?php echo round($totalRating/$j,1); ?></h3>
    			<?php echo wc_get_rating_html( round($totalRating/$j,1), $total ); ?>
    			<p><strong><?php echo $total; ?> <?php echo esc_html( 'Customer Ratings', 'qaisarsatti_topseller'); ?></strong></p>
	      	</div>
			<?php } ?>

    	</div>


    <?php
        
	return ob_get_clean();
}

add_shortcode('qaisarsatti-storerating', 'qaisarsatti_storerating');





<?php 

/**

 * Template Name: Portfolio Board Phase 2

 */


require_once 'twitter-feed.php';

require_once 'instagram-feed.php';

require_once 'product-feed.php';


get_header(); ?>
    
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDwOnAPNVy7G2ygx0Ju2lMPGzy3IAAmWfw"></script>
    
	<div id="map-container">
    	<div id="map">
        </div>
        <div class="list-filters">
            <ul>
                <li id="all" class="filter" lat="41" long="-80" zoom="5" >All<span></span></li>
                <li id="chicago" class="filter" lat="41.8819" long="-87.6278" zoom="8" >Chicago</li>
                <li id="pittsburgh" lat="40.455367" long="-80" zoom="10" class="filter">Pittsburgh</li>
                <li id="maryland" lat="39.191353" long="-76.889840" zoom="10" class="filter">Maryland</li>
                <li id="washington" lat="38.905063" long="-77.028389" zoom="7" class="filter">Washington D.C.</li>
                <li id="philadelphia" lat="39.943790" long="-75.185184" zoom="10" class="filter">Philadelphia</li>
                <li id="brooklyn" lat="40.830336" long="-73.932584" zoom="9" class="filter">Brooklyn</li>
                <li id="hartford" lat="41.769478" long="-72.682144" zoom="10" class="filter">Hartford</li>
                <li id="boston" lat="42.154245" long="-71.224355" zoom="9" class="filter">Boston</li>
                <li id="upstate" lat="42.130428," long="-75.874549" zoom="7" class="filter">Upstate</li>
            </ul>
        </div>
        <div id="map-list">
        </div>
    </div>
        
    <div id="map-cta" class="closed">
        <span class="cta-arrow desktop-arrow">&#x25BC;</span>
        <span id="text">See where we're bringing the BOOM.</span>
        <span class="cta-arrow">&#x25BC;</span>
        <span class="cta-arrow mobile-arrow">&#x25BC;</span>
    </div>

	<?php
	
	$grid = array();
	
	$grid = array_merge($grid, $feedTweets);
	
	//$grid = array_sprinkle($grid, $feedMusic);
	$grid = array_sprinkle($grid, $feedInstagram);
	$grid = array_sprinkle($grid, $feedProducts, false, 3);
	
	?>
    
    <div id="grid-container" class="gdl-page-item mb20 twelve columns">
    
    <div class="grid-filters">
    	<ul>
        	<li id="filter-by">Filter by</li>
           <!-- <li id="music" class="filter">Music<span></span></li>-->
			<li id="all" class="filter">All<span></span></li>
            <li id="photo" class="filter">Photos<span></span></li>
        	<li id="social" class="filter">Social<span></span></li>
            <li id="product" class="filter">Products<span></span></li>
        </ul>
    </div>
    
    <a href="https://www.facebook.com/Boomchickapop/app_112053162216760" target="_blank">
    <div class="grid-item big sweepstakes" style="background: url('wp-content/themes/rocketboard-v1-02/images/ANG_boomtour_sweeps_image_sm.png'); background-size:cover;">
    
    </div>
    </a>
    
    <?php
	foreach($grid as $item) : ?>
        
		<?php if($item['type'] == "social" || $item['type'] == "music" ) : ?>
        	<a href="http://twitter.com/<?php echo $item['user'] ?>/status/<?php echo $item['id'] ?>" target="_blank">
                <div class="grid-item <?php 
					echo $item['type'];
					if($item['type'] == 'social'){
						echo " ";
					}
					?>">
                    <div><span></span></div>
                    <p><?php echo '"' . $item['text'] . ' ' . '"'; ?></p>
                </div>
            </a>
        <?php endif; ?>
        
		<?php if($item['type'] == "photo") : ?>
        	<a href="<?php echo $item['image'] ?>" title="<p><?php echo $item['caption'] ?></p><p><a href='<?php echo $item['link'] ?>' target='_blank'>View on Instagram</a></p>" class="image-popup-fit-width" >
                <div class="grid-item <?php echo $item['type'] ?>" style="background: url('<?php echo $item['low_resolution'] ?>'); background-size:cover;" lat="<?php echo $item['lat'] ?>" long="<?php echo $item['long'] ?>" thumbnail="<?php echo $item['thumbnail'] ?>" link="<?php echo $item['link'] ?>" caption="<?php echo $item['caption'] ?>" >
                <div><span></span><p><?php echo trimCaption($item['caption']) ?></p></div>
                </div>
            </a>
        <?php endif; ?>
        
		<?php if($item['type'] == "product") : ?>
        	<a href="<?php echo $item['link'] ?>" target="_blank" >
                <div class="grid-item <?php echo $item['type'] ?>" style="background: url('wp-content/themes/rocketboard-v1-02/images/products/<?php echo $item['image'] ?>'); background-size:cover;">
                	<div><span></span></div>
                </div>
            </a>
        <?php endif; ?>

		
	<?php endforeach; ?>
    
	</div>	



		<div class="clear"></div>

	</div> <!-- page wrapper -->

	<script src="wp-content/themes/rocketboard-v1-02/javascript/magnific.js"></script>
	<script src="wp-content/themes/rocketboard-v1-02/javascript/grid.js"></script>
        
<?php get_footer(); ?>
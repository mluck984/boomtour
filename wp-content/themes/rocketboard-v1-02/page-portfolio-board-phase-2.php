<?php 

/**

 * Template Name: Portfolio Board Phase 2

 */


require_once 'twitter-feed.php';

require_once 'instagram-feed.php';


get_header(); ?>

	<div id="map-cta">
    	See where we're bringing the BOOM.
    </div>

	<div id="map-container">
			
            <iframe width='100%' height='500px' frameBorder='0' src='https://a.tiles.mapbox.com/v4/growsoomboom.j5j6e7lm/attribution,zoompan,zoomwheel,geocoder,share.html?access_token=pk.eyJ1IjoiZ3Jvd3Nvb21ib29tIiwiYSI6IlhFZF9teHcifQ.3RPlJ6MFwiK4JR-sO0MrCQ'></iframe>
    
    </div>

	<?php
	
	$grid = array();
	
	$grid = array_merge($grid, $feedTweets);
	
	//$grid = array_sprinkle($grid, $feedMusic);
	$grid = array_sprinkle($grid, $feedInstagram);
	
	?>
    
    <div id="grid-container" class="gdl-page-item mb20 twelve columns">
    
    <div class="grid-filters">
    	<ul>
        	<li id="filter-by">Filter by</li>
           <!-- <li id="music" class="filter">Music<span></span></li>-->
            <li id="photo" class="filter">Photos<span></span></li>
        	<li id="social" class="filter">Social<span></span></li>
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
        	<a href="<?php echo $item['image'] ?>" title="<?php echo $item['caption'] ?>" class="image-popup-fit-width" >
                <div class="grid-item <?php echo $item['type'] ?>" style="background: url('<?php echo $item['thumbnail'] ?>'); background-size:cover;">
                <div><span></span><p><?php echo trimCaption($item['caption']) ?></p></div>
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
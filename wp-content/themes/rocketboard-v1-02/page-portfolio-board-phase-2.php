<?php 

/**

 * Template Name: Portfolio Board Phase 2

 */


require_once 'twitter-feed.php';

require_once 'instagram-feed.php';

require_once 'product-feed.php';

require_once 'polls-feed.php';


get_header(); ?>
    
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDwOnAPNVy7G2ygx0Ju2lMPGzy3IAAmWfw"></script>
    
    <div id="preload">
    	<img src="wp-content/themes/rocketboard-v1-02/images/check-on.png"  />
    </div>
    
	<div id="map-container">
    	<div id="map">
        </div>
        <div class="list-filters">
            <ul>
                <li id="all" class="filter" lat="41" long="-80" zoom="5" >All<span></span></li>
                <li id="chicago" class="filter" lat="41.8819" long="-87.6278" zoom="8" >Chicago</li>
                <li id="pittsburgh" lat="40.455367" long="-80" zoom="10" class="filter">Pittsburgh</li>
                <li id="washington" lat="38.905063" long="-77.028389" zoom="7" class="filter">Washington&nbsp;D.C.</li>
                <li id="maryland" lat="39.191353" long="-76.889840" zoom="10" class="filter">Baltimore</li>
                <li id="brooklyn" lat="40.830336" long="-73.932584" zoom="9" class="filter">Brooklyn</li>
                <li id="boston" lat="42.154245" long="-71.224355" zoom="9" class="filter">Boston</li>
                <li id="hartford" lat="41.769478" long="-72.682144" zoom="10" class="filter">Hartford</li>
                <li id="rhode" lat="41.826411" long="-71.413014" zoom="10" class="filter">Rhode&nbsp;Island</li>
                <li id="philadelphia" lat="39.943790" long="-75.185184" zoom="10" class="filter">Philadelphia</li>
                <li id="upstate" lat="42.130428," long="-75.874549" zoom="7" class="filter">Upstate,&nbsp;NY</li>
            </ul>
        </div>
        <div id="map-list">
        </div>
    </div>
        
    <div id="map-cta" class="closed">
        <span class="cta-arrow desktop-arrow">&#x25BC;</span>
        <span id="text">CLICK HERE TO VIEW BOOM TOUR™ MAP</span>
        <span class="cta-arrow">&#x25BC;</span>
        <span class="cta-arrow mobile-arrow">&#x25BC;</span>
    </div>

	<?php
	
	$grid = array();
	
	$grid = array_merge($grid, $feedTweets);
	
	//$grid = array_sprinkle($grid, $feedMusic);
	$grid = array_sprinkle($grid, $feedInstagram);
	$grid = array_sprinkle($grid, $feedPolls);
	$grid = array_sprinkle($grid, $feedProducts, false, 3);
	?>
    
    <div id="grid-container" class="gdl-page-item mb20 twelve columns">
    
    <div class="grid-filters">
    	<ul>
        	<li id="filter-by">Filter by</li>
           <!-- <li id="music" class="filter">Music<span></span></li>-->
			<li id="all" class="filter">All<span></span></li>
            <li id="music" class="filter">Music<span></span></li>
            <li id="photo" class="filter">Instagram<span></span></li>
        	<li id="social" class="filter">Twitter<span></span></li>
            <li id="poll" class="filter">Polls<span></span></li>
            <li id="product" class="filter">Products<span></span></li>
        </ul>
    </div>
    
    </div>
    
    </div>
    
    <div id="grid">
    
    	<div class="grid-sizer"></div>
    
        <a href="https://www.facebook.com/Boomchickapop/app_112053162216760" target="_blank">
        <div class="grid-item big sweepstakes">
        	<img src="wp-content/themes/rocketboard-v1-02/images/ANG_boomtour_sweeps_image_sm.png"  />
        
        </div>
        </a>
        
        <div class="grid-item big music">
            <img src="wp-content/themes/rocketboard-v1-02/images/BoomTourSetlist.jpg" />
<object width="250" height="250" classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" id="gsPlaylist10022749652" name="gsPlaylist10022749652"><param name="movie" value="http://grooveshark.com/widget.swf" /><param name="wmode" value="window" /><param name="allowScriptAccess" value="always" /><param name="flashvars" value="hostname=grooveshark.com&playlistID=100227496&p=0&bbg=000000&bth=000000&pfg=000000&lfg=000000&bt=FFFFFF&pbg=FFFFFF&pfgh=FFFFFF&si=FFFFFF&lbg=FFFFFF&lfgh=FFFFFF&sb=FFFFFF&bfg=666666&pbgh=666666&lbgh=666666&sbh=666666" /><object type="application/x-shockwave-flash" data="http://grooveshark.com/widget.swf" width="250" height="250"><param name="wmode" value="window" /><param name="allowScriptAccess" value="always" /><param name="flashvars" value="hostname=grooveshark.com&playlistID=100227496&p=0&bbg=000000&bth=000000&pfg=000000&lfg=000000&bt=FFFFFF&pbg=FFFFFF&pfgh=FFFFFF&si=FFFFFF&lbg=FFFFFF&lfgh=FFFFFF&sb=FFFFFF&bfg=666666&pbgh=666666&lbgh=666666&sbh=666666" /><span><a href="http://grooveshark.com/search/playlist?q=Boom%20Tour%20Angies%20Boomchickapop" title="Boom Tour by Angies Boomchickapop on Grooveshark">Boom Tour by Angies Boomchickapop on Grooveshark</a></span></object></object>
            <div><span></span></div>       
        </div>
        
        <?php
        foreach($grid as $item) : ?>
            
            <?php if($item['type'] == "social" || $item['type'] == "music" ) : ?>
                <a href="http://twitter.com/<?php echo $item['user'] ?>/status/<?php echo $item['id'] ?>" target="_blank">
                    <div class="grid-item <?php 
                        echo $item['type'];
                        if($item['type'] == 'social'){
                            echo " wide";
                        }
                        ?>">
                        <img src="wp-content/themes/rocketboard-v1-02/images/tile_<?php echo $item['type'] ?>.png" />
                        <img class="profile-pic" src="<?php echo $item['profile_image'] ?>" />
                        <div><span></span></div>
                        <p><?php echo '"' . $item['text'] . ' ' . '"'; ?></p>
                    </div>
                </a>
            <?php endif; ?>
            
            <?php if($item['type'] == "photo") : ?>
                <a href="<?php echo $item['image'] ?>" title="<p><?php echo $item['caption'] ?></p><p><a href='<?php echo $item['link'] ?>' target='_blank'>View on Instagram</a></p>" class="image-popup-fit-width" >
                    <div class="grid-item <?php echo $item['type'] ?>" lat="<?php echo $item['lat'] ?>" long="<?php echo $item['long'] ?>" thumbnail="<?php echo $item['thumbnail'] ?>" link="<?php echo $item['link'] ?>" caption="<?php echo $item['caption'] ?>" >
                     <img src="<?php echo $item['low_resolution'] ?>" />
                    <div><span></span></div>
                    <p><?php echo trimCaption($item['caption']) ?></p>
                    </div>
                </a>
            <?php endif; ?>
            
            <?php if($item['type'] == "product") : ?>
                <a href="<?php echo $item['link'] ?>" id="<?php echo $item['name'] ?>" target="_blank" >
                    <div class="grid-item <?php echo $item['type'] ?>" >
                    	<img src="wp-content/themes/rocketboard-v1-02/images/products/<?php echo $item['image'] ?>" />
                        <div><span></span></div>
                    </div>
                </a>
            <?php endif; ?>
            
            <?php if($item['type'] == "poll") : ?>
            	<?php $sum = array_sum($item['results']); ?>
                <div class="grid-item <?php echo $item['type'] ?> wide" >
					<img src="wp-content/themes/rocketboard-v1-02/images/tile_<?php echo $item['type'] ?>.png" />
                    <div><span></span></div>
                    <div class="tile-content">
                        <p><?php echo $item['question'] ?></p>
                        <?php if($item['answered'] == false) : ?>
                            <ul class="answers" poll="<?php echo $item['id'] ?>" sum="<?php echo $sum ?>">
                            <?php $i = 0; ?>
                            <?php foreach($item['answers'] as $answer) : ?>
                                <li answer="<?php echo $i; ?>" result="<?php echo  $item['results'][$i] ?>"><?php echo $answer ?></li>
                                <?php $i++; ?>
                            <?php endforeach; ?>
                            </ul>
                        <?php else: ?>
                            <ul class="results">
                            <?php $i = 0; ?>                           
                            <?php foreach($item['answers'] as $answer) : 
								$width = 100 * ($item['results'][$i] / $sum);	
								$percentage = floor($width) . "%";						
							?>
                                <li answer="<?php echo $i; ?>" style="background-size: <?php echo $width ?>% 100%" ><div><?php echo $percentage; ?></div><div class="answer-text"><?php echo $answer ?></div></li>
                                <?php $i++; ?>
                            <?php endforeach; ?>
                            </ul>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endif; ?>
    
            
        <?php endforeach; ?>
    
    </div>


		<div class="clear"></div>

	</div> <!-- page wrapper -->

	<script src="wp-content/themes/rocketboard-v1-02/javascript/magnific.js"></script>
	<script src="wp-content/themes/rocketboard-v1-02/javascript/grid.js"></script>
        
<?php get_footer(); ?>
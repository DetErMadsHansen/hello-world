<form action="<?php bloginfo('siteurl'); ?>" id="searchform" class="searchform" method="get">
        <!--<label for="s" class="screen-reader-text">Hvad s&oslash;ger du?</label>-->
        <input type="text" id="s" class="search grid-30 mobile-grid-30" name="s" value="" placeholder="<?php _e( 'What are you looking for?', 'lmp-textdomain' ); ?>" />
        
        <button type="submit" id="searchsubmit" class="submit grid-70 mobile-grid-70" ><?php _e( 'Search', 'lmp-textdomain' ); ?></button>
        <div class="clear"></div>
</form>
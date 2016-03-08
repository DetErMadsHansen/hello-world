<div id="footer" class="widespan">
	<div class="grid-container">
		<?php
/*
		$fscPageID		= get_option("ttt_fsc_page");
		$svanePageID	= get_option("ttt_svane_page");
		$termsPageID	= get_option("ttt_terms_page");


		echo '<div class="grid-25 mobile-grid-33 grid-parent link svanemaerket">';
			echo '<a href="' . get_permalink( $svanePageID ) . '" class="logo grid-100 mobile-grid-100"></a>';
			echo '<p class="text grid-100 hide-on-mobile"><a href="' . get_permalink( $svanePageID ) . '">Svanen er Nordens officielle miljømærkning</a></p>';
			echo '<div class="clear"></div>';
		echo '</div>';


		echo '<div class="grid-25 mobile-grid-33 grid-parent link fsc">';
			echo '<a href="' . get_permalink( $fscPageID ) . '" class="logo grid-100 mobile-grid-100"></a>';
			echo '<p class="text grid-100 hide-on-mobile"><a href="' . get_permalink( $fscPageID ) . '">Miljømærket for ansvarligt skovbrug</a></p>';
		echo '</div>';


		echo '<div class="grid-25 mobile-grid-33 grid-parent link betingelser">';
			echo '<a href="' . get_permalink( $termsPageID ) . '" class="logo grid-100 mobile-grid-100"></a>';
			echo '<p class="text grid-100 hide-on-mobile"><a href="' . get_permalink( $termsPageID ) . '">trykteams salgs- og leveringsbetingelser</a></p>';
			echo '<div class="clear"></div>';
		echo '</div>';
*/
		
/*
		// --- First : Footer --- //
		if( has_nav_menu( 'footer01-menu' ) ) {

			$menuFooter01 = array(
				'theme_location'  => 'footer01-menu',
				'menu'            => '',
				'container'       => 'div',
				'container_class' => 'grid-25 mobile-grid-100',
				'container_id'    => 'siteMenuFooter',
				'menu_class'      => 'menu',
				'menu_id'         => '',
				'echo'            => true,
				'fallback_cb'     => 'wp_page_menu',
				'before'          => '',
				'after'           => '',
				'link_before'     => '',
				'link_after'      => '',
				'items_wrap'      => '<ul id="%1$s" class="%2$s"><h5>' . __('Environment', 'ttt-201501') . '</h5>%3$s</ul>',
				'depth'           => 0,
				'walker'          => ''
			);
			
			wp_nav_menu( $menuFooter01 );

		}


		// --- Second : Footer --- //
		if( has_nav_menu( 'footer02-menu' ) ) {

			$menuFooter02 = array(
				'theme_location'  => 'footer02-menu',
				'menu'            => '',
				'container'       => 'div',
				'container_class' => 'grid-25 mobile-grid-100',
				'container_id'    => 'siteMenuFooter',
				'menu_class'      => 'menu',
				'menu_id'         => '',
				'echo'            => true,
				'fallback_cb'     => 'wp_page_menu',
				'before'          => '',
				'after'           => '',
				'link_before'     => '',
				'link_after'      => '',
				'items_wrap'      => '<ul id="%1$s" class="%2$s"><h5>' . __('Technical', 'ttt-201501') . '</h5>%3$s</ul>',
				'depth'           => 0,
				'walker'          => ''
			);
			
			wp_nav_menu( $menuFooter02 );

		}
*/
/*
		// --- Third : Footer --- //
		if( has_nav_menu( 'footer03-menu' ) ) {

			$menuFooter03 = array(
				'theme_location'  => 'footer03-menu',
				'menu'            => '',
				'container'       => 'div',
				'container_class' => 'grid-25 mobile-grid-100',
				'container_id'    => 'siteMenuFooter',
				'menu_class'      => 'menu',
				'menu_id'         => '',
				'echo'            => true,
				'fallback_cb'     => 'wp_page_menu',
				'before'          => '',
				'after'           => '',
				'link_before'     => '',
				'link_after'      => '',
				'items_wrap'      => '<ul id="%1$s" class="%2$s"><h5>' . __('Terms and Conditions', 'ttt-201501') . '</h5>%3$s</ul>',
				'depth'           => 0,
				'walker'          => ''
			);
			
			wp_nav_menu( $menuFooter03 );

		}
*/
		?>
		
		
		<div class="grid-25 mobile-grid-100">
			<h5>Firmanavn</h5>
			<p>
			Vejnavn og nummer<br />
			Postnr. By<br />
			Telefon xx xx xx xx<br />
			CVR nr. xx xx xx xx<br />
			<a href="mai&#108;&#116;o:kontak&#116;&#64;mail.dk?subject=Forespørgsel&body=Hejsa%0D%0A">kontakt&#64;mail.dk</a>
			</p>
		</div>
	</div>
</div>

	
	<?php wp_footer(); ?> 

</body>

</html>

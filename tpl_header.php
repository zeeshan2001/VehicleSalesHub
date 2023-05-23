	<header class="header">
			<div class="nav-container">
				<div class="wrapper">
					<div class="header-item-left">
					<a href="/" class="brand"><img src="/img/ukcd-logo.svg" width="200" height="53" class="ukcd-logo" alt="UK Car Discount"><img src="/img/ukcd-logo-small.svg" width="100" height="26" class="ukcd-logo-small" alt="UK Car Discount"></a>
					</div>
					<!-- Section: Navbar Menu -->
					<div class="header-item-center">
						<div class="overlay"></div>
						<nav class="menu">
							<div class="menu-mobile-header">
								<button type="button" class="menu-mobile-arrow"><i class="fas fa-chevron-left"></i></button>
								<div class="menu-mobile-title"></div>
								<button type="button" class="menu-mobile-close"><i class="fas fa-times light"></i></button>
							</div>
							<ul class="menu-section">
								<li><a href="/">Home</a></li>
								<li class="menu-item-has-children">
									<a href="#">About <i class="fas fa-angle-down"></i></a>
									<div class="menu-subs menu-column-1">
										<ul>
				<?php

		while (!$pages->EOF) {
			if ($pages->Fields('page_cat_top_about') == 1) { ?>
											<li><a href="/<?php echo $pages->Fields('page_slug'); ?>"><?php echo $pages->Fields('page_link_text'); ?></a></li>
						<?php
			}
		$pages->MoveNext();
	}
?>
										</ul>
									</div>
								</li>
								<li class="menu-item-has-children">
									<a href="#">Hot Deals <i class="fas fa-fire-flame-curved"></i></a>
									<div class="menu-subs menu-column-1">
										<ul>
											<li><a href="/hot-deals">Special Offers</a></li>
											<li><a href="/stock-deals">Stock Deals</a></li>
										</ul>
									</div>
								</li>
								<li class="menu-item-has-children">
									<a href="/sell-your-car">Sell Your Car <i class="fas fa-car"></i></a>
								</li>
								<li class="menu-item-has-children">
									<a href="#">Cars <i class="fas fa-angle-down"></i></a>
									<div class="menu-subs menu-mega menu-column-4">
										<div class="list-item">
											<h4 class="title"><i class="fas fa-car"></i> Cars By Manufacturer</h4>
											<ul>
												<?php
	while (!$car_manufacturers->EOF) {
?>
												<li><a href="/new-cars/<?php echo $car_manufacturers->Fields('make_seo'); ?>"><?php echo $car_manufacturers->Fields('name'); ?></a></li>
								<?php
		$car_manufacturers->MoveNext();
	}
?>
											</ul>
										</div>
										<div class="list-item">
											<ul>
												<?php
	while (!$car_manufacturers2->EOF) {
?>
												<li><a href="/new-cars/<?php echo $car_manufacturers2->Fields('make_seo'); ?>"><?php echo $car_manufacturers2->Fields('name'); ?></a></li>
								<?php
		$car_manufacturers2->MoveNext();
	}
?>
												<li><a href="/new-cars" class="mega-button">VIEW ALL <i class="fas fa-chevron-circle-right"></i></a></li>
											</ul>
										</div>
										<div class="list-item">
											<h4 class="title car-icon"><img src="/img/car_icons/suv_crossover.svg" alt="SUVs and Crossovers"> SUVs & CROSSOVERS</h4>
											<ul>
												<li><a href="/new-cars-types/small-crossover-suv">Compact SUVs/Crossovers</a></li>
												<li><a href="/new-cars-types/medium-crossover-suv">Medium SUVs/Crossover</a></li>
												<li><a href="/new-cars-types/large-suv">Large SUVs</a></li>
											</ul>
											<h4 class="title car-icon"><img src="/img/car_icons/family_car.svg" alt="Family Cars"> TRADITIONAL FAMILY</h4>
											<ul>
												<li><a href="/new-cars-types/hatchback">Hatchback</a></li>
												<li><a href="/new-cars-types/saloon">Saloon</a></li>
												<li><a href="/new-cars-types/estate">Estate</a></li>
												<li><a href="/new-cars-types/mpv">MPV</a></li>
												<li><a href="/new-cars-seats/7">7-Seats</a></li>
											</ul>
										</div>
										<div class="list-item">
										<h4 class="title car-icon"><img src="/img/car_icons/lifestyle_car.svg" alt="Lifestyle Cars"> LIFESTYLE & LEISURE</h4>
											<ul>
												<li><a href="/new-cars-types/coupe">Coupe</a></li>
												<li><a href="/new-cars-types/convertible">Convertible</a></li>
											</ul>
											<h4 class="title"><i class="fas fa-plug"></i> GO ELECTRIC</h4>
											<ul>
												<li><a href="/new-cars-fuel-types/electric">Full Electric Cars</a></li>
												<li><a href="/new-cars-fuel-types/plug-in-hybrid">Plug-in Hybrids (PHEV)</a></li>
												<li><a href="/new-cars-fuel-types/full-self-charging-hybrid">Self Charging Hybrids</a></li>
												<li><a href="/new-cars-fuel-types" class="mega-button">ALL FUEL TYPES <i class="fas fa-chevron-circle-right"></i></a></li>
												<!--<li><a href="#" class="mega-button">ADVANCED SEARCH <i class="fas fa-chevron-circle-right"></i></a></li>-->
											</ul>
										</div>
									</div>
								</li>
								<li class="menu-item-has-children">
									<a href="#">Vans <i class="fas fa-angle-down"></i></a>
									<div class="menu-subs menu-mega menu-column-2 half-size">
										<div class="list-item">
											<h4 class="title car-icon"><img src="/img/car_icons/large_van.svg" alt="Vans By Manufacturer"/> Manufacturers</h4>
											<ul>
												<?php
	while (!$van_manufacturers->EOF) {
?>
												<li><a href="/new-vans/<?php echo $van_manufacturers->Fields('make_seo'); ?>"><?php echo $van_manufacturers->Fields('name'); ?></a></li>
								<?php
		$van_manufacturers->MoveNext();
	}
?>
												<li><a href="/new-vans" class="mega-button">BROWSE ALL <i class="fas fa-chevron-circle-right"></i></a></li>

											</ul>
										</div>
										<div class="list-item">
											<h4 class="title car-icon"><img src="/img/car_icons/pick-up.svg" alt="Vans By Type" /> Vans By Type</h4>
											<ul>
												<li><a href="/new-vans-types/pickup">Pick-ups</a></li>
												<li><a href="/new-vans-types/luton-van">Luton vans</a></li>
												<li><a href="/new-vans-types/dropside">Dropside Vans</a></li>
												<li><a href="/new-vans-types/combi">Combi Vans</a></li>
												<li><a href="/new-vans-types/small-van">Small Vans</a></li>
												<li><a href="/new-vans-types/medium-van-standard">Medium Van (Standard)</a></li>
												<li><a href="/new-vans-types/medium-van-high">Medium Van (High)</a></li>
												<li><a href="/new-vans-types/medium-van-extra-high">Medium Van (Extra High)</a></li>
												<li><a href="/new-vans-types/large-van-standard">Large Van (Standard)</a></li>
												<li><a href="/new-vans-types/large-van-high">Large Van (High)</a></li>
												<li><a href="/new-vans-types/large-van-extra-high">Large Van (Extra High)</a></li>
												<!--<li><a href="#" class="mega-button">ADVANCED SEARCH <i class="fas fa-chevron-circle-right"></i></a></li>-->
											</ul>
										</div>
									</div>
								</li>
								<li class="menu-item-has-children">
									<a href="#">News & Tips <i class="fas fa-angle-down"></i></a>
									<div class="menu-subs menu-mega menu-column-4">
										<div class="list-item">
											<h4 class="title"><i class="fas fa-car"></i> Car Reviews, News & Tips</h4>
											<ul>
												<li><a href="/news/<?php echo $news->Fields('news_slug'); ?>" class="news-primary-image" style="background-image: url('<?php echo $news->Fields('news_image_path'); ?><?php echo $news->Fields('news_image'); ?>')"></a></li>
												<li><a href="/news/<?php echo $news->Fields('news_slug'); ?>"><?php echo $news->Fields('news_h1'); ?> <i class="fas fa-arrow-circle-right"></i></a></li>
											</ul>
										</div>
										<div class="list-item">
											<ul>
												<?php
	$news->move(1);
	while (!$news->EOF) {
?>
												<li><a href="/news/<?php echo $news->Fields('news_slug'); ?>"><?php echo $news->Fields('news_h1'); ?> <i class="fas fa-arrow-circle-right"></i></a></li>
		<?php
		$news->MoveNext();
	}
?>
												<li><a href="/news" class="mega-button">MORE NEWS & REVIEWS <i class="fas fa-chevron-circle-right"></i></a></li>

											</ul>
										</div>
										<div class="list-item">
											<h4 class="title"><i class="fas fa-question-circle"></i> Jargon Buster</h4>
											<ul>
												<li><a href="/jargon/<?php echo $jargon->Fields('jargon_slug'); ?>" class="news-primary-image" style="background-image: url('<?php echo $jargon->Fields('jargon_image_path').$jargon->Fields('jargon_image'); ?>')"></a></li>
												<li><a href="/jargon/<?php echo $jargon->Fields('jargon_slug'); ?>"><?php echo $jargon->Fields('jargon_h1'); ?> <i class="fas fa-arrow-circle-right"></i></a></li>
											</ul>
										</div>
										<div class="list-item">
											<ul>
												<?php
	$jargon->move(1);
	while (!$jargon->EOF) {
?>
												<li><a href="/jargon/<?php echo $jargon->Fields('jargon_slug'); ?>"><?php echo $jargon->Fields('jargon_h1'); ?> <i class="fas fa-arrow-circle-right"></i></a></li>
		<?php
		$jargon->MoveNext();
	}
?>
											<li><a href="/jargon" class="mega-button">MORE JARGON <i class="fas fa-chevron-circle-right"></i></a></li>


											</ul>
										</div>
									</div>
								</li>
								<li><a href="/contact-us">Contact</a></li>
							</ul>
						</nav>
					</div>

					<div class="header-item-right">
						<a href="#" class="menu-icon" title="Phone us on 0161 946 3500"><i class="fas fa-phone"></i></a>
						<?php
// If user session var exists
if (isset($_SESSION['kt_login_id'])) {
echo '<a href="/login" class="menu-icon" title="Profile, saved vehicles and logout options"><i class="fas fa-user"></i></a>';
} else {
echo '<a href="/login" class="menu-icon" title="Login/Register"><i class="fas fa-user"></i></a>';
}
?>
					<!--	<a href="/login" class="menu-icon" title="Login or register to updated your profile and save vehicles"><i class="fas fa-user"></i></a> -->
						<a href="#" class="menu-icon social-icon-top" title="connect with us on facebook"><i class="fab fa-facebook-square"></i></a>
						<a href="#" class="menu-icon social-icon-top" title="follow us on twitter"><i class="fab fa-twitter"></i></a>
						<a href="#" class="menu-icon social-icon-top" title="follow us on instagram"><i class="fab fa-instagram"></i></a>
						<button type="button" class="menu-mobile-trigger">
							<span></span>
							<span></span>
							<span></span>
							<span></span>
						</button>
					</div>

				</div>
			</div>
		</header>

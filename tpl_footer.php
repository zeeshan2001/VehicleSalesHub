<footer>
<div id="footer-info-outer">
<div id="footer-info">
<div id="useful-info">
	<div class="footer-info-header">USEFUL INFO</div>
				<?php
	$pages->moveFirst();
	while (!$pages->EOF) {
if ($pages->Fields('page_cat_footer_about') == 1) { ?>
	<div><a href="./<?php echo $pages->Fields('page_slug'); ?>"><i class="fas fa-check-circle"></i> <?php echo $pages->Fields('page_link_text'); ?></a></div>
	<?php }
		$pages->MoveNext();
	}
?>
	</div>
<div id="trustpilot-info">
	<div class="footer-info-header">TRUSTPILOT</div>
	<div> We are one of the highest rated new car dealers on independent review platform Trustpilot.</div>
	<div><img src="img/trustpilot_footer.svg" alt="one of the highest rated new car dealers on Trustpilot"></div>
	</div>

<div id="social-info">
	<div class="footer-info-header">CONNECT WITH US</div>
	<div>Keep in touch for the latest deals, news and car reviews.</div>
	<div><i class="fas fa-phone-square"></i> 0161 946 3500</div>
	<div> <a href="https://www.facebook.com/UkCarDiscount" target="_blank" title="follow us facebook"><i class="fab fa-facebook-square"></i> Facebook</a></div>
	<div> <a href="https://twitter.com/UKCarDiscount" target="_blank" title="follow us on twitter"><i class="fab fa-twitter"></i> Twitter</a></div>
	<div> <a href="https://www.instagram.com/uk_car_discount" target="_blank" title="connect on instagram"><i class="fab fa-instagram"></i> Instagram</a></div>
	<div> <a href="https://www.linkedin.com/company/uk-car-discount/" target="_blank" title="connect on linkedin"><i class="fab fa-linkedin"></i> Linkedin</a></div>
	</div>
<div id="subscribe-info">
	<div class="footer-info-header">STAY IN THE LOOP</div>
	<div> Subscribe to get the latest deals and motoring news by email.</div>
	<div><input type="text" placeholder="Your Name"></div>
	<div><input type="text" placeholder="Your Email"></div>
	<div><input type="submit" value="Subscribe"></div>
	</div>

	</div>
	</div>
<div id="footer-lower-outer">
<div id="copyright">
	<div>Copyright &copy; <?php echo date("Y"); ?> UK Car Discount Ltd</div>
	<div>Registered Office : 45-49 Greek Street, Stockport, Cheshire, SK3 8AX | Registered in England and Wales Company Reg No : 05004960</div>
	</div>
<div id="terms">
	<div id="terms-disclaimer">*Vehicles shown are for illustration purposes only. Vehicle data and images are supplied by a third party. UK Car Discount shall not be held responsible for related errors or omissions.</div>
	<div id="terms-links"><span><?php
	$pages->moveFirst();
	while (!$pages->EOF) {
		if ($pages->Fields('page_cat_footer_terms') == 1) { ?>
		<a href="./<?php echo $pages->Fields('page_slug'); ?>"> <?php echo $pages->Fields('page_link_text'); ?> </a><?php
			}
		$pages->MoveNext();
	}
?> <a href="./contact-us">Contact us</a>
</span></div>
	</div>
	</div>
	</footer>

    <!-- ez-consent -->
    <script type="text/javascript" src="assets/js/cookie_cdn.js"></script>
    	
	<script>
		ez_consent.init(
		{
			is_always_visible: false,       // Always shows banner on load, default: false
			privacy_url: "/cookies-policy",        // URL that "more" button goes to, default: "/privacy/"
			more_button: {
			    target_attribute : "_blank",  // Determines what the behavior of the 'more' button is, default: "_blank", opens the privacy page in a new tab
			    is_consenting: false           // Determines whether clicking on 'more' button gives consent and removes the banner, default: true
			},
			texts: {
                main: "In order to deliver an optimised user experience this site uses cookies. By continuing to use this site, you agree to our use of cookies.",       // The text that's shown on the banner, default: "This website uses cookies & similar."
                buttons:{
                    ok: "OK",                   // OK button to hide the text, default: "ok"
                    more: "View Policy"                // More button that shows the privacy policy, default "more"
                }
			}
		});
	</script>

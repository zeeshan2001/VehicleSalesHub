
<div class="header" style="text-align:center;background-color:#fff;"></div>
	<div id="nav-container">
	<nav>
		<label for="drop" class="toggle"><img src="includes/header/hamburger.svg" style="height:40px;width:auto;padding:0;margin:0;" alt="menu"></label>
		<input type="checkbox" id="drop" />
			<ul class="menu">
			<li>
				<!-- Drop Down 1 -->
				<label for="drop-1" class="toggle">Home &nbsp;<i class="fas fa-home"></i></label>
				<a href="#">Home &nbsp;<i class="fas fa-home"></i></a>
		<?php
// Show IF Conditional has_dashboards_access
if (@$_SESSION['kt_user_permissions_dashboards'] == 1) {
?>
				<input type="checkbox" id="drop-1"/>
				<ul>
					<li><a href="welcome.php">Status</a></li>
					<li><a href="dash1.php">Dashboard 1</a></li>
					<li><a href="dash2.php">Dashboard 2</a></li>
					<li><a href="dash3.php">Dashboard 3</a></li>
				</ul>		    <?php }
// endif Conditional has_dashboards_access
?>
				</li>
				<li>
				<!-- Drop Down 2 -->
				<label for="drop-2" class="toggle">Vehicles &nbsp;<i class="fas fa-car"></i></label>
				<a href="#">Vehicles &nbsp;<i class="fas fa-car"></i></a>
		<?php
// Show IF Conditional has_vehicle_access
if (@$_SESSION['kt_user_permissions_vehicles'] == 1) {
?>
				<input type="checkbox" id="drop-2"/>
				<ul>
					<li><a href="car_test.php">Core Data Test</a></li>
					<li><a href="manufacturers.php">Manufacturers (Cars)</a></li>
					<li><a href="manufacturers_vans.php">Manufacturers (Vans)</a></li>
					<li><a href="cars.php">Cars</a></li>
					<li><a href="vans.php">Vans</a></li>
					<li><a href="specials.php">Special Offers</a></li>
					 <li><a href="xml_feeds.php">XML Feeds</a></li>
				</ul>		    <?php }
// endif Conditional has_vehicle_access
?>
				</li>
				<li>
				<!-- Drop Down 3 -->
				<label for="drop-3" class="toggle">CRM &nbsp;<i class="fas fa-users"></i></label>
				<a href="#">CRM &nbsp;<i class="fas fa-users"></i></a>
		<?php
// Show IF Conditional has_crm_access
if (@$_SESSION['kt_user_permissions_crm'] == 1) {
?>
				<input type="checkbox" id="drop-3"/>
				<ul>
					<li><a href="calendar.php">Calendar</a></li>
					<li><a href="customers.php">Customers</a></li>
					<li><a href="enquiries.php">Enquiries</a></li>
					<li><a href="orders.php">Orders</a></li>
					<li><a href="quotes.php">Quotes</a></li>
					<li><a href="suppliers.php">Suppliers</a></li>
				</ul>		    <?php }
// endif Conditional has_crm_access
?>
				</li>
				<li>
				<!-- Drop Down 4 -->
				<label for="drop-4" class="toggle">CMS &nbsp;<i class="fas fa-edit"></i></label>
				<a href="#">CMS &nbsp;<i class="fas fa-edit"></i></a>
		<?php
// Show IF Conditional has_cms_access
if (@$_SESSION['kt_user_permissions_cms'] == 1) {
?>
				<input type="checkbox" id="drop-4"/>
				<ul>
					<li><a href="pages.php">Pages</a></li>
					<li><a href="news.php">News Articles</a></li>
					<li><a href="jargon.php">Jargon Buster</a></li>
					<li><a href="trustpilot.php">TrustPilot Quotes</a></li>
				</ul>		    <?php }
// endif Conditional has_cms_access
?>
				</li>
				<li>
				<!-- Drop Down 5 -->
				<label for="drop-5" class="toggle">Settings &nbsp;<i class="fas fa-cog"></i></label>
				<a href="#">Settings &nbsp;<i class="fas fa-cog"></i></a>
		<?php
// Show IF Conditional has_settings_access
if (@$_SESSION['kt_user_permissions_settings'] == 1) {
?>
				<input type="checkbox" id="drop-5"/>
				<ul>
					<li><a href="callback_options.php">Callback Options</a></li>
					<li><a href="globals.php?global_id=1">Globals</a></li>
					<li><a href="jargon_cats.php">Jargon Categories</a></li>
					<li><a href="news_cats.php">News Categories</a></li>
					<li><a href="order_status.php">Order Status</a></li>
					<li><a href="sales_extras.php">Sales Extras</a></li>
					<li><a href="supplier_types.php">Supplier Types</a></li>
				</ul>		    <?php }
// endif Conditional has_settings_access
?>
				</li>
								<li>
				<!-- Drop Down 6 -->
				<label for="drop-6" class="toggle">Logs &nbsp;<i class="fas fa-list-alt"></i></label>
				<a href="#">Logs &nbsp;<i class="fas fa-list-alt"></i></a>
		<?php
// Show IF Conditional has_logs_access
if (@$_SESSION['kt_user_permissions_logs'] == 1) {
?>
				<input type="checkbox" id="drop-6"/>
				<ul>
					<li><a href="auth_log.php">Authentication Log</a></li>
					<li><a href="activity_log.php">Activity log</a></li>
				</ul>		    <?php }
// endif Conditional has_logs_access
?>
				</li>
								<li>
				<!-- Drop Down 6 -->
				<label for="drop-6" class="toggle">User &nbsp;<i class="fas fa-user-cog"></i></label>
				<a href="#">User &nbsp;<i class="fas fa-user-cog"></i></a>
				<input type="checkbox" id="drop-6"/>
				<ul>
					<?php
// Show IF Conditional has_profile_access
if (@$_SESSION['kt_user_permissions_profile'] == 1) {
?>
<li><a href="profile.php">Update My Profile</a></li>
					<?php }
// endif Conditional has_profile_access
?>
					<?php
// Show IF Conditional has_users_access
if (@$_SESSION['kt_user_permissions_users'] == 1) {
?>
					<li><a href="users.php">User Manager</a></li>
					<li><a href="signup.php">Add User</a></li>
					<?php }
// endif Conditional has_users_access
?>
					<li><a href="logout.php">Logout</a></li>
				</ul>
				</li>
			</ul>
		</nav>
		</div>

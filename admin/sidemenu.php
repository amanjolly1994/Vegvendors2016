<?php

require_once('dbConfig.php');
$query5 = $db->query("SELECT sno FROM sub_orders WHERE svid='0'");
$coun = mysqli_num_rows($query5); 
 
 
?>

<div id="sidebar-left" class="span2">
				<div class="nav-collapse sidebar-nav">
					<ul class="nav nav-tabs nav-stacked main-menu">
						<li><a href="dashboard.php"><i class="icon-bar-chart"></i><span class="hidden-tablet"> Dashboard</span></a></li>
                        <li><a href="specialorders.php"><i class="icon-heart"></i><span class="hidden-tablet">Veg Vendors Special Orders</span><span class="label label-important"><?php echo $coun; ?></span></a></li>						
						<li><a href="phonenumber.php"><i class="icon-edit"></i><span class="hidden-tablet">Book new orders</span></a></li>
						<li><a href="messages.php"><i class="icon-envelope"></i><span class="hidden-tablet"> Messages</span></a></li>
						<li><a href="total_vendors.php"><i class="icon-signal"></i><span class="hidden-tablet">Sales (Vendor Wise)</span></a></li>
					    <li><a href="topvendors.php"><i class= "icon-text-width"></i><span class="hidden-tablet">Total Vendors</span></a></li>
						<li><a href="totalorders.php"><i class="icon-hand-right"></i><span class="hidden-tablet">Complaints</span></a></li>
					    <li><a href="ksldfsdkf"><i class= "icon-envelope"></i><span class="hidden-tablet">Send Message</span></a></li>
					    <li><a href="placecode_select.php"><i class= "icon-eye-open"></i><span class="hidden-tablet">Toggle availability</span></a></li>
					    <li><a href="placecode_select_price.php"><i class= "icon-eye-open"></i><span class="hidden-tablet">Define/change price </span></a></li>
						
						
						
						<li><a href="tasks.php"><i class="icon-tasks"></i><span class="hidden-tablet"> Tasks</span></a></li>
						
						
						
						
						<li><a href="ui.php"><i class="icon-eye-open"></i><span class="hidden-tablet"> UI Features</span></a></li>
						<li><a href="widgets.php"><i class="icon-dashboard"></i><span class="hidden-tablet"> Widgets</span></a></li>
						<li>
							<a class="dropmenu" href="#"><i class="icon-folder-close-alt"></i><span class="hidden-tablet"> Dropdown</span><span class="label label-important"> 3 </span></a>
							<ul>
								<li><a class="submenu" href="submenu.php"><i class="icon-file-alt"></i><span class="hidden-tablet"> Sub Menu 1</span></a></li>
								<li><a class="submenu" href="submenu2.php"><i class="icon-file-alt"></i><span class="hidden-tablet"> Sub Menu 2</span></a></li>
								<li><a class="submenu" href="submenu3.php"><i class="icon-file-alt"></i><span class="hidden-tablet"> Sub Menu 3</span></a></li>
							</ul>	
						</li>
						<li><a href="form.php"><i class="icon-edit"></i><span class="hidden-tablet"> Forms</span></a></li>
						<li><a href="chart.php"><i class="icon-list-alt"></i><span class="hidden-tablet"> Charts</span></a></li>
						<li><a href="typography.php"><i class="icon-font"></i><span class="hidden-tablet"> Typography</span></a></li>
						<li><a href="gallery.php"><i class="icon-picture"></i><span class="hidden-tablet"> Gallery</span></a></li>
						<li><a href="table.php"><i class="icon-align-justify"></i><span class="hidden-tablet"> Tables</span></a></li>
						<li><a href="calendar.php"><i class="icon-calendar"></i><span class="hidden-tablet"> Calendar</span></a></li>
						<li><a href="file-manager.php"><i class="icon-folder-open"></i><span class="hidden-tablet"> File Manager</span></a></li>
						<li><a href="icon.php"><i class="icon-star"></i><span class="hidden-tablet"> Icons</span></a></li>
						<li><a href="login.php"><i class="icon-lock"></i><span class="hidden-tablet"> Login Page</span></a></li>
						<li><a href="phonenumber.php"><i class="icon-edit"></i><span class="hidden-tablet">Book new orders</span></a></li>
                        

					</ul>
				</div>
			</div>
			
<?php

?>			
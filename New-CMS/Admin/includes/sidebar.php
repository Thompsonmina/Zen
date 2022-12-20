<div class="span3">
					<div class="sidebar">


<ul class="widget widget-menu unstyled">
							<li>
								<a class="collapsed" data-toggle="collapse" href="complaints.php">
									<i class="menu-icon icon-cog"></i>
									<i class="icon-chevron-down pull-right"></i><i class="icon-chevron-up pull-right"></i>
									Manage Complaint
								</a>
								<ul id="togglePages" class="collapse unstyled">
									<li>
									<a href="complaints.php?status=Pending&status-num=1">
											<i class="icon-tasks"></i>
											Pending Complaints
											<?php
$status=1;
$rt = mysqli_query($bd, "SELECT * FROM complaint where status = '1'");
$num1 = mysqli_num_rows($rt);
{?>
		
											<b class="label orange pull-right"><?php echo htmlentities($num1); ?></b>
											<?php } ?>
										</a>
									</li>
									<li>
									<a href="complaints.php?status=In-Progres&status-num=2">
											<i class="icon-tasks"></i>
											Complaints Being Looked At
                   <?php 
$status=2;                   
$rt = mysqli_query($bd, "SELECT * FROM complaint where status='$status'");
$num1 = mysqli_num_rows($rt);
{?><b class="label orange pull-right"><?php echo htmlentities($num1); ?></b>
<?php } ?>
										</a>
									</li>
									<li>
										<a href="complaints.php?status=closed&status-num=3">
											<i class="icon-inbox"></i>
											Closed Complaints
	     <?php 
$status=3;                   
$rt = mysqli_query($bd, "SELECT * FROM complaint where status='$status'");
$num1 = mysqli_num_rows($rt);
{?><b class="label green pull-right"><?php echo htmlentities($num1); ?></b>
<?php } ?>

										</a>
									</li>
								</ul>
							</li>
							
							<li>
								<a href="manage-users.php">
									<i class="menu-icon icon-group"></i>
									Manage users
								</a>
							</li>
						</ul>


						<ul class="widget widget-menu unstyled">
								<li><a href="manage_lecturers.php"><i class="menu-icon icon-tasks"></i> Manage Lecturers </a></li>
                                <li><a href="manage_courses.php"><i class="menu-icon icon-tasks"></i> Manage Courses </a></li>
                        
                            </ul><!--/.widget-nav-->

						<ul class="widget widget-menu unstyled">
							<li><a href="user-logs.php"><i class="menu-icon icon-tasks"></i>User Login Log </a></li>
							
							<li>
								<a href="logout.php">
									<i class="menu-icon icon-signout"></i>
									Logout
								</a>
							</li>
						</ul>

					</div><!--/.sidebar-->
				</div><!--/.span3-->

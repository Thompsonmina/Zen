<ul class="h-screen w-2/5 bg-gray-800 text-white md:w-1/5 max-w-xs border-r border-black p-4 flex flex-col gap-y-5">
	<li>
		<a href="complaints.php">
			Manage Complaint
		</a>
		<ul class="pl-5 flex flex-col gap-y-2 mt-3">
			<li>
				<a href="complaints.php?status=Pending&status-num=1">
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
					<?php }
				?>
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
						<?php }
					?>
				</a>
			</li>
		</ul>
	</li>			
	<li>
		<a href="manage_students.php">
			<i class="menu-icon icon-group"></i>
			Manage Students
		</a>
	</li>
	<li class="w-full">
		<a class="w-full" href="manage_lecturers.php">Manage Lecturers </a>
	</li>
	<li class="w-full"><a class="w-full" href="manage_courses.php">Manage Courses </a></li>
</ul>
	

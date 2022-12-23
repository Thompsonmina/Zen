
<?php


function displayComplaints($conn, $status, $all=False, $custom_query=""){
	$status_map = array(1=> "Pending", 2 => "In Progress", 3 => "Closed");

    $html_beginning = <<<'EOD'
    <div class="module">
							<div class="module-head">
								<h3>Complaints</h3>
							</div>
							<div class="module-body table">


							
								<table cellpadding="0" cellspacing="0" border="0" class="datatable-1 table table-bordered table-striped	 display" >
									<thead>
										<tr>
											<th>Complaint No</th>
											<th> Complaint </th>
											<th> Complainer's Matric</th>
											<th> Lecturer's Name </th>
											<th> Course Code</th>
											<th>Reg Date</th>
											<th>Status</th>
											
											<th>Action</th>
											
										
										</tr>
									</thead>
								
<tbody>
EOD;

$stat = $status;
echo $stat;
$query_str = "SELECT c.id, c.complaint_text, c.regDate, c.status, s.matric_number, l.fullName, co.code FROM complaint c JOIN student s ON c.student_id = s.id JOIN lecturer l ON c.lecturer_id = l.id JOIN course co ON c.course_id = co.id WHERE c.status = $stat";

if ($all){
    $query_str = 'SELECT c.id, c.complaint_text, c.regDate, c.status, s.matric_number, l.fullName, co.code FROM complaint c JOIN student s ON c.student_id = s.id JOIN lecturer l ON c.lecturer_id = l.id JOIN course co ON c.course_id = co.id';  
}
if ($custom_query){
	if (str_contains(strtolower($query_str), "where")){
		$query_str = $query_str." and ".$custom_query;
	}
	$query_str = $query_str." where ".$custom_query;
	// echo $query_str;
}

$query=mysqli_query($conn, $query_str);
// echo $query_str;


$table_data = "";
while($row=mysqli_fetch_assoc($query))
{

	$table_part = <<<EOD
	 <tr>
											<td>{$row["id"]}</td>
											<td>{$row['complaint_text']}</td>
											<td>{$row['matric_number']}</td>
											<td>{$row['fullName']}</td>
											<td>{$row['code']}</td>
											<td>{$row['regDate']}</td>
										
											<td><button type="button" class="btn btn-danger">{$status_map[$row['status']]}</button></td>
											
											<td>   <a href="complaint_details.php?complaintid={$row["id"]}"> View Details</a> 
											</td>
											</tr>
EOD;
											$table_data = $table_data.$table_part;
										}



$html_end = <<<'EOD'
										</tbody>
								</table>
							</div>
						</div>						

EOD;	
return $html_beginning.$table_data.$html_end;
}


function displayLecturerSidebar($conn, $lecturer_id)
{

	
	$query=mysqli_query($conn, "select fullName from lecturer where email='".$_SESSION['login_lecturer']."'");
	$row=mysqli_fetch_array($query);
	$name = $row["fullName"];

	$query_str = "select c.id as course_id, c.code from course_lecturer cl join course c join lecturer l where cl.lecturer_id = '$lecturer_id' and l.id = cl.lecturer_id and c.id = cl.course_id;";
	$query=mysqli_query($conn, $query_str);


	$courses_links = "";
	while($row=mysqli_fetch_assoc($query)){
		$courses_links = $courses_links."<li><a  href="."complaints.php?courseid={$row['course_id']}".">{$row['code']}</a></li>";
	}
	echo "omo";
	$html = <<<EOD
	<aside>
          <div id="sidebar"  class="nav-collapse ">
              <!-- sidebar menu start-->
              <ul class="sidebar-menu" id="nav-accordion">
              	  	
                  <li class="mt">
                      <a href="dashboard.php">
                          <i class="fa fa-dashboard"></i>
                          <span>Dashboard</span>
                      </a>
                  </li>


                  <li class="sub-menu">
                      <a href="javascript:;" >
                          <i class="fa fa-cogs"></i>
                          <span>Account Setting</span>
                      </a>
                      <ul class="sub">
                          <li><a  href="change-password.php">Change Password</a></li>
                        
                      </ul>
                  </li>
                  <li class="sub-menu">
                      <a href="complaints.php" >
                          <i class="fa fa-cogs"></i>
                          <span>Complaints</span>
                      </a>
                      <ul class="sub">
						$courses_links
                        
                      </ul>
                  </li>
                  
                 
              </ul>
              <!-- sidebar menu end-->
          </div>
      </aside>
EOD;


	return $html;
}
?>

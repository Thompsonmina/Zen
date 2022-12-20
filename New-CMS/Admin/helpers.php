
<?php

function displayComplaints($status, $all=False){
    $html = <<<'EOD'
    <div class="module">
							<div class="module-head">
								<h3>Pending Complaints</h3>
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
<?php
$stat = $status;

$query_str = 'SELECT c.id, c.complaint_text, c.regDate, s.matric_number, l.fullName, co.code FROM complaint c JOIN student s ON c.student_id = s.id JOIN lecturer l ON c.lecturer_id = l.id JOIN course co ON c.course_id = co.id WHERE c.status = $status' 
if ($all){
    $query_str = 'SELECT c.id, c.complaint_text, c.regDate, s.matric_number, l.fullName, co.code FROM complaint c JOIN student s ON c.student_id = s.id JOIN lecturer l ON c.lecturer_id = l.id JOIN course co ON c.course_id = co.id'  
}
$query=mysqli_query($bd, $query_str);
while($row=mysqli_fetch_array($query))
{
?>										
										<tr>
											<td><?php echo htmlentities($row['id']);?></td>
											<td><?php echo htmlentities($row['complaintText']);?></td>
											<td><?php echo htmlentities($row['matric_number']);?></td>
											<td><?php echo htmlentities($row['fullName']);?></td>
											<td><?php echo htmlentities($row['code']);?></td>
											<td><?php echo htmlentities($row['regDate']);?></td>
										
											<td><button type="button" class="btn btn-danger">Not process yet</button></td>
											
											<td>   <a href="complaint-details.php?cid=<?php echo htmlentities($row['complaintNumber']);?>"> View Details</a> 
											</td>
											</tr>

										<?php  } ?>
										</tbody>
								</table>
							</div>
						</div>						

"	
EOD;
return $html;										
}
?>

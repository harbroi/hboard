<div class="container-fluid px-4">
	<h1 class="mt-4">Back Logs</h1>
	<ol class="breadcrumb">
		<?php
		$proj = mysqli_fetch_array(mysqli_query($con,"select * from project limit 1"));
		?>
		<li class="breadcrumb-item active"><?php echo $proj["title"]; ?></li>
	</ol>
	<a class="btn btn-sm btn-success mb-4" href="index.php?pg=newtask">New Ticket</a>
	<div class="row scrollable-row table-responsive">
		<table class="table table-sm table-bordered table-striped table-hover w-100 small">
			<tr class="small text-uppercase">
				<th class="text-secondary small">Title</th>
				<th class="text-secondary text- small">Assigned To</th>
				<th class="text-secondary small">Severity</th>
				<th class="text-secondary small">Type</th>
				<th class="text-secondary small">Status</th>
				<th class="text-secondary small">Reported Date</th>
				<th class="text-secondary small">Reported By</th>
			</tr>
			<?php
				$q = mysqli_query($con, 
					"
					select 
						t.*, 
						concat(r1.firstname,' ',r1.lastname) `assignedto`, 
						r1.img `assignedtoimg`, 
						r1.initials `initials1`, 
						concat(r2.firstname,' ',r2.lastname) `reporter`,
						r2.img `reporterimg`, 
						r2.initials `initials2`
					from 
						tasks t 
						left join resources r1 on t.assignee=r1.id 
						left join resources r2 on t.reportedby=r2.id 
					order by 
						field(t.status, 'To Do', 'In Progress', 'Code Review','In QA','Done')
					");
				while($r = mysqli_fetch_array($q)){
				?>
					<tr class="small">
						<td title="View Ticket Details" class="fw-bold" style="cursor:pointer;" onclick="javascript:window.location='index.php?pg=details&id=<?php echo $r["id"]; ?>'"><?php echo $r["title"]; ?></td>
						<td>
							<?php
							if(strlen($r["assignedto"])==0){
								echo "<i class='text-secondary'>Unassigned</i> (<a href=''>Assign</a>)";
							}
							else{
							?>
								<div title="<?php echo $r["assignedto"]; ?>" class="d-inline-flex align-items-center justify-content-center bg-dark text-white rounded-circle avatar">
									<?php
									if(strlen($r["assignedtoimg"]) > 0){
									?>
										<span><img src="<?php echo $r["assignedtoimg"]; ?>" class="avatar-img"></span>
									<?php
									}
									else{
										echo $r["initials1"];
									}
									?>
								</div>
								<?php echo $r["assignedto"]; ?>
							<?php
							}
							?>
						</td>
						<td><?php echo $r["severity"]; ?></td>
						<td>
							<?php
								if($r["type"]=="Task"){
									$color = "primary";
								}
								if($r["type"]=="Enhancement"){
									$color = "success";
								}
								if($r["type"]=="Bug"){
									$color = "danger";
								}
							?>
							<span class="fw-normal badge bg-<?php echo $color; ?>" style="font-size:0.90em;"><?php echo $r["type"]; ?></span>
						</td>
						<td><?php echo $r["status"]; ?></td>
						<td><?php echo date_format(date_create($r["dateadded"]),"l, F j, Y"); ?></td>
						<td>
							<div title="<?php echo $r["reporter"]; ?>" class="d-inline-flex align-items-center justify-content-center bg-dark text-white rounded-circle avatar">
								<?php
								if(strlen($r["reporterimg"]) > 0){
								?>
									<span><img src="<?php echo $r["reporterimg"]; ?>" class="avatar-img"></span>
								<?php
								}
								else{
									echo $r["initials2"];
								}
								?>
							</div>
							<?php echo $r["reporter"]; ?>
						</td>
					</tr>
				<?php
				}
			?>
		</table>
	</div>
</div>
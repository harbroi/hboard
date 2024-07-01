<div class="container-fluid px-4">
	<h1 class="mt-4">Ticket Details</h1>
	<ol class="breadcrumb">
		<?php
		$proj = mysqli_fetch_array(mysqli_query($con,"select * from project limit 1"));
		$ticket = mysqli_fetch_array(mysqli_query($con,"
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
			where
				t.id= $_GET[id]
			"
		));
		?>
		<li class="breadcrumb-item active"><?php echo $proj["title"]; ?></li>
	</ol>
	<form method="POST">
		<div class="row small mb-3 bg-light">
			<div class="col-9">
				<div class="form-group p-2">
					<label class="fw-bolder text-secondary">Title</label><br/>
					<?php echo "<b>[$proj[abbr]-$ticket[id]]</b> $ticket[title]"; ?>
				</div>
			</div>
		</div>
		<div class="row small mb-3 bg-light">
			<div class="col-3">
				<div class="form-group p-2">
					<label class="fw-bolder text-secondary">Severity</label><br/>
					<?php echo $ticket["severity"]; ?>
				</div>
			</div>
			<div class="col-3">
				<div class="form-group p-2">
					<label class="fw-bolder text-secondary">Type</label><br/>
					<?php
						if($ticket["type"]=="Task"){
							$color = "primary";
						}
						if($ticket["type"]=="Enhancement"){
							$color = "success";
						}
						if($ticket["type"]=="Bug"){
							$color = "danger";
						}
					?>
					<span class="fw-normal badge bg-<?php echo $color; ?>" style="font-size:0.90em;"><?php echo $ticket["type"]; ?></span>
				</div>
			</div>
			<div class="col-3">
				<div class="form-group p-2">
					<label class="fw-bolder text-secondary">Status</label><br/>
					<?php echo $ticket["status"]; ?>
				</div>
			</div>
		</div>
		<div class="row small mb-3 bg-light">
			<div class="col-3">
				<div class="form-group p-2">
					<label class="fw-bolder text-secondary">Assigned To</label><br/>
					<?php
					if(strlen($ticket["assignedto"])==0){
						echo "<i class='text-secondary'>Unassigned</i> (<a href=''>Assign</a>)";
					}
					else{
					?>
						<div title="<?php echo $ticket["assignedto"]; ?>" class="d-inline-flex align-items-center justify-content-center bg-dark text-white rounded-circle avatar">
							<?php
							if(strlen($ticket["assignedtoimg"]) > 0){
							?>
								<span><img src="<?php echo $ticket["assignedtoimg"]; ?>" class="avatar-img"></span>
							<?php
							}
							else{
								echo $ticket["initials1"];
							}
							?>
						</div>
						<?php echo $ticket["assignedto"]; ?>
					<?php
					}
					?>
				</div>
			</div>
			<div class="col-3">
				<div class="form-group p-2">
					<label class="fw-bolder text-secondary">Reported By</label><br/>
					<div title="<?php echo $ticket["reporter"]; ?>" class="d-inline-flex align-items-center justify-content-center bg-dark text-white rounded-circle avatar">
						<?php
						if(strlen($ticket["reporterimg"]) > 0){
						?>
							<span><img src="<?php echo $ticket["reporterimg"]; ?>" class="avatar-img"></span>
						<?php
						}
						else{
							echo $ticket["initials2"];
						}
						?>
					</div>
					<?php echo $ticket["reporter"]."<br/><span class='small text-secondary'>".date_format(date_create($ticket["dateadded"]),"l, F j, Y h:i:s A")."</span>"; ?>
				</div>
			</div>
		</div>
		<div class="row small mb-3 bg-light">
			<div class="col-12">
				<div class="form-group p-2">
					<label class="fw-bolder text-secondary">Description</label><br/>
					<?php echo $ticket["description"]; ?>
				</div>
			</div>
		</div>
		<div class="row small">
			<div class="col-12">
				<a href="index.php?pg=board" class="btn btn-outline-success">Back to Board</a>
				<a href="index.php?pg=edittask&id=<?php echo $ticket["id"]; ?>" class="btn btn-success">Edit Ticket</a>
				<?php
					if(isset($_POST["btnsave"])){
						$title = addslashes($_POST["title"]);
						$description = addslashes($_POST["description"]);
						$severity = $_POST["severity"];
						$type = $_POST["type"];
						$assignee = $_POST["assignee"];
						$maxseq = mysqli_fetch_array(mysqli_query($con,"select ifnull(max(seq),0) from tasks where status='To Do'"));
						$max = ($maxseq[0] > 0) ? ($maxseq[0] + 1): 0;
						mysqli_query($con,"insert into tasks(title,description,img,assignee,severity,type,status,dateadded,reportedby,seq) values('$title','$description',NULL,$assignee,'$severity','$type','To Do',NOW(),$_SESSION[id],$max)");
						echo "<script>window.location='index.php?pg=board';</script>";
					}
				?>
			</div>
		</div>
	</form>
</div>
<div class="container-fluid px-4">
	<h1 class="mt-4">New Ticket</h1>
	<ol class="breadcrumb">
		<?php
		$proj = mysqli_fetch_array(mysqli_query($con,"select * from project limit 1"));
		?>
		<li class="breadcrumb-item active"><?php echo $proj["title"]; ?></li>
	</ol>
	<form method="POST">
		<div class="row small mb-3">
			<div class="col-12">
				<div class="form-group">
					<label class="fw-bolder text-secondary">Title</label>
					<input type="text" name="title" class="form-control" required></input>
				</div>
			</div>
		</div>
		<div class="row small mb-3">
			<div class="col-4">
				<div class="form-group">
					<label class="fw-bolder text-secondary">Severity</label>
					<select name="severity" class="form-control" required>
						<option>Low</option>
						<option>Medium</option>
						<option>High</option>
					</select>
				</div>
			</div>
			<div class="col-4">
				<div class="form-group">
					<label class="fw-bolder text-secondary">Type</label>
					<select name="type" class="form-control" required>
						<option>Task</option>
						<option>Enhancement</option>
						<option>Bug</option>
					</select>
				</div>
			</div>
			<div class="col-4">
				<div class="form-group">
					<label class="fw-bolder text-secondary">Assigned To</label>
					<select name="assignee" class="form-control" required>
						<option value="0" selected>Unassigned</option>
						<?php
						$q = mysqli_query($con, "select * from resources order by firstname");
						while($r = mysqli_fetch_array($q)){
						?>
							<option value="<?php echo $r["id"]; ?>"><?php echo $r["firstname"]." ".$r["lastname"]; ?></option>
						<?php
						}
						?>
					</select>
				</div>
			</div>
		</div>
		<div class="row small mb-3">
			<div class="col-12">
				<div class="form-group">
					<label class="fw-bolder text-secondary">Description</label>
					<textarea name="description" id="description" class="w-100" rows="8"></textarea>
				</div>
			</div>
		</div>
		<div class="row small">
			<div class="col-12">
				<input type="submit" class="btn btn-success" name="btnsave" value="Add Ticket"></input>
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
<script src="js/nicEdit.js"></script>
<script type="text/javascript">
	bkLib.onDomLoaded(function() { nicEditors.allTextAreas() });
	
	function save(){
		nicEditors.findEditor('description').saveContent();
	}
</script>
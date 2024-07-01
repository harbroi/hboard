<div class="container-fluid px-4">
	<h1 class="mt-4">Board</h1>
	<ol class="breadcrumb">
		<?php
		$proj = mysqli_fetch_array(mysqli_query($con,"select * from project limit 1"));
		?>
		<li class="breadcrumb-item active"><?php echo $proj["title"]; ?></li>
	</ol>
	<a class="btn btn-sm btn-success mb-4" href="index.php?pg=newtask">New Ticket</a>
	<div class="row scrollable-row">
		<div class="col-xl-2 col-md-2">
			<div class="card bg-light text-secondary border-0">
				<div class="card-header">
					<label class="text-uppercase text-secondary small fw-bolder">TO DO</label>
				</div>
				<div class="card-body sortable" id="todo">
					<?php
					$q = mysqli_query($con, "select * from tasks t where status='To Do' order by seq, id");
					while($r = mysqli_fetch_array($q)){
						if($r["type"]=="Task"){
							$icon = "fas fa-thumbtack text-primary"; 
							$color = "primary";
						}
						if($r["type"]=="Enhancement"){
							$icon = "fas fa-square-plus text-success";
							$color = "success";
						}
						if($r["type"]=="Bug"){
							$icon = "fas fa-bug text-danger";
							$color = "danger";
						}
						if($r["status"]=="Done"){
							$color = "warning";
						}
						?>
						<div class="card bg-white text-black small mb-2" id="id_<?php echo $r["id"]; ?>">
							<div class="card-header small text-black small fw-bolder bg-<?php echo $color; ?> border-0 pb-0" style="--bs-bg-opacity: .1;" onclick="javascript:window.location='index.php?pg=details&id=<?php echo $r["id"]; ?>'">
								<span class="<?php echo $icon; ?>" title="<?php echo $r["type"]; ?>"></span> <?php echo $proj["abbr"]; ?>-<?php echo $r["id"]; ?>
							</div>
							<div class="card-body bg-<?php echo $color; ?>" style="--bs-bg-opacity: .1;" onclick="javascript:window.location='index.php?pg=details&id=<?php echo $r["id"]; ?>'">
								<span class="small d-block"><?php echo $r["title"]; ?></span>
							</div>
							<div class="card-footer small d-flex justify-content-between align-items-center">
								<span class="small">
									<?php
									$aq = mysqli_query($con, "select * from resources where id=$r[assignee]");
									if(mysqli_num_rows($aq) > 0){
										$ar = mysqli_fetch_array($aq);
										?>
										<div title="<?php echo $ar["firstname"]." ".$ar["lastname"]; ?>" class="d-inline-flex align-items-center justify-content-center bg-dark text-white rounded-circle avatar">
											<?php
											if(strlen($ar["img"]) > 0){
											?>
												<img src="<?php echo $ar["img"]; ?>" class="avatar-img">
											<?php
											}
											else{
												echo $ar["initials"];
											}
											?>
										</div>
										<?php
									}
									else{
										echo "Unassigned (<a href=''>Assign</a>)";
									}
									?>
									
								</span>
								<span class="text-secondary small"><?php echo $r["severity"]; ?></span>
							</div>
						</div>
					<?php
					}
					?>
				</div>
			</div>
		</div>
		<div class="col-xl-2 col-md-2">
			<div class="card bg-light text-secondary border-0">
				<div class="card-header">
					<label class="text-uppercase text-secondary small fw-bolder">IN PROGRESS</label>
				</div>
				<div class="card-body sortable" id="inprogress">
					<?php
					$q = mysqli_query($con, "select * from tasks t where status='In Progress' order by seq, id");
					while($r = mysqli_fetch_array($q)){
						if($r["type"]=="Task"){
							$icon = "fas fa-thumbtack text-primary"; 
							$color = "primary";
						}
						if($r["type"]=="Enhancement"){
							$icon = "fas fa-square-plus text-success";
							$color = "success";
						}
						if($r["type"]=="Bug"){
							$icon = "fas fa-bug text-danger";
							$color = "danger";
						}
						if($r["status"]=="Done"){
							$color = "warning";
						}
						?>
						<div class="card bg-white text-black small mb-2" id="id_<?php echo $r["id"]; ?>">
							<div class="card-header small text-black small fw-bolder bg-<?php echo $color; ?> border-0 pb-0" style="--bs-bg-opacity: .1;" onclick="javascript:window.location='index.php?pg=details&id=<?php echo $r["id"]; ?>'">
								<span class="<?php echo $icon; ?>" title="<?php echo $r["type"]; ?>"></span> <?php echo $proj["abbr"]; ?>-<?php echo $r["id"]; ?>
							</div>
							<div class="card-body bg-<?php echo $color; ?>" style="--bs-bg-opacity: .1;" onclick="javascript:window.location='index.php?pg=details&id=<?php echo $r["id"]; ?>'">
								<span class="small d-block"><?php echo $r["title"]; ?></span>
							</div>
							<div class="card-footer small d-flex justify-content-between align-items-center">
								<span class="small">
									<?php
									$aq = mysqli_query($con, "select * from resources where id=$r[assignee]");
									if(mysqli_num_rows($aq) > 0){
										$ar = mysqli_fetch_array($aq);
										?>
										<div title="<?php echo $ar["firstname"]." ".$ar["lastname"]; ?>" class="d-inline-flex align-items-center justify-content-center bg-dark text-white rounded-circle avatar">
											<?php
											if(strlen($ar["img"]) > 0){
											?>
												<img src="<?php echo $ar["img"]; ?>" class="avatar-img">
											<?php
											}
											else{
												echo $ar["initials"];
											}
											?>
										</div>
										<?php
									}
									else{
										echo "Unassigned (<a href=''>Assign</a>)";
									}
									?>
									
								</span>
								<span class="text-secondary small"><?php echo $r["severity"]; ?></span>
							</div>
						</div>
					<?php
					}
					?>
				</div>
			</div>
		</div>
		<div class="col-xl-2 col-md-2">
			<div class="card bg-light text-secondary border-0">
				<div class="card-header">
					<label class="text-uppercase text-secondary small fw-bolder">CODE REVIEW</label>
				</div>
				<div class="card-body sortable" id="codereview">
					<?php
					$q = mysqli_query($con, "select * from tasks t where status='Code Review' order by seq, id");
					while($r = mysqli_fetch_array($q)){
						if($r["type"]=="Task"){
							$icon = "fas fa-thumbtack text-primary"; 
							$color = "primary";
						}
						if($r["type"]=="Enhancement"){
							$icon = "fas fa-square-plus text-success";
							$color = "success";
						}
						if($r["type"]=="Bug"){
							$icon = "fas fa-bug text-danger";
							$color = "danger";
						}
						if($r["status"]=="Done"){
							$color = "warning";
						}
						?>
						<div class="card bg-white text-black small mb-2" id="id_<?php echo $r["id"]; ?>">
							<div class="card-header small text-black small fw-bolder bg-<?php echo $color; ?> border-0 pb-0" style="--bs-bg-opacity: .1;" onclick="javascript:window.location='index.php?pg=details&id=<?php echo $r["id"]; ?>'">
								<span class="<?php echo $icon; ?>" title="<?php echo $r["type"]; ?>"></span> <?php echo $proj["abbr"]; ?>-<?php echo $r["id"]; ?>
							</div>
							<div class="card-body bg-<?php echo $color; ?>" style="--bs-bg-opacity: .1;" onclick="javascript:window.location='index.php?pg=details&id=<?php echo $r["id"]; ?>'">
								<span class="small d-block"><?php echo $r["title"]; ?></span>
							</div>
							<div class="card-footer small d-flex justify-content-between align-items-center">
								<span class="small">
									<?php
									$aq = mysqli_query($con, "select * from resources where id=$r[assignee]");
									if(mysqli_num_rows($aq) > 0){
										$ar = mysqli_fetch_array($aq);
										?>
										<div title="<?php echo $ar["firstname"]." ".$ar["lastname"]; ?>" class="d-inline-flex align-items-center justify-content-center bg-dark text-white rounded-circle avatar">
											<?php
											if(strlen($ar["img"]) > 0){
											?>
												<img src="<?php echo $ar["img"]; ?>" class="avatar-img">
											<?php
											}
											else{
												echo $ar["initials"];
											}
											?>
										</div>
										<?php
									}
									else{
										echo "Unassigned (<a href=''>Assign</a>)";
									}
									?>
									
								</span>
								<span class="text-secondary small"><?php echo $r["severity"]; ?></span>
							</div>
						</div>
					<?php
					}
					?>
				</div>
			</div>
		</div>
		<div class="col-xl-2 col-md-2">
			<div class="card bg-light text-secondary border-0">
				<div class="card-header">
					<label class="text-uppercase text-secondary small fw-bolder">IN QA</label>
				</div>
				<div class="card-body sortable" id="inqa">
					<?php
					$q = mysqli_query($con, "select * from tasks t where status='In QA' order by seq, id");
					while($r = mysqli_fetch_array($q)){
						if($r["type"]=="Task"){
							$icon = "fas fa-thumbtack text-primary"; 
							$color = "primary";
						}
						if($r["type"]=="Enhancement"){
							$icon = "fas fa-square-plus text-success";
							$color = "success";
						}
						if($r["type"]=="Bug"){
							$icon = "fas fa-bug text-danger";
							$color = "danger";
						}
						if($r["status"]=="Done"){
							$color = "warning";
						}
						?>
						<div class="card bg-white text-black small mb-2" id="id_<?php echo $r["id"]; ?>">
							<div class="card-header small text-black small fw-bolder bg-<?php echo $color; ?> border-0 pb-0" style="--bs-bg-opacity: .1;" onclick="javascript:window.location='index.php?pg=details&id=<?php echo $r["id"]; ?>'">
								<span class="<?php echo $icon; ?>" title="<?php echo $r["type"]; ?>"></span> <?php echo $proj["abbr"]; ?>-<?php echo $r["id"]; ?>
							</div>
							<div class="card-body bg-<?php echo $color; ?>" style="--bs-bg-opacity: .1;" onclick="javascript:window.location='index.php?pg=details&id=<?php echo $r["id"]; ?>'">
								<span class="small d-block"><?php echo $r["title"]; ?></span>
							</div>
							<div class="card-footer small d-flex justify-content-between align-items-center">
								<span class="small">
									<?php
									$aq = mysqli_query($con, "select * from resources where id=$r[assignee]");
									if(mysqli_num_rows($aq) > 0){
										$ar = mysqli_fetch_array($aq);
										?>
										<div title="<?php echo $ar["firstname"]." ".$ar["lastname"]; ?>" class="d-inline-flex align-items-center justify-content-center bg-dark text-white rounded-circle avatar">
											<?php
											if(strlen($ar["img"]) > 0){
											?>
												<img src="<?php echo $ar["img"]; ?>" class="avatar-img">
											<?php
											}
											else{
												echo $ar["initials"];
											}
											?>
										</div>
										<?php
									}
									else{
										echo "Unassigned (<a href=''>Assign</a>)";
									}
									?>
									
								</span>
								<span class="text-secondary small"><?php echo $r["severity"]; ?></span>
							</div>
						</div>
					<?php
					}
					?>
				</div>
			</div>
		</div>
		<div class="col-xl-2 col-md-2">
			<div class="card bg-light text-secondary border-0">
				<div class="card-header">
					<label class="text-uppercase text-secondary small fw-bolder">DONE</label>
				</div>
				<div class="card-body sortable" id="done">
					<?php
					$q = mysqli_query($con, "select * from tasks t where status='Done' order by seq, id");
					while($r = mysqli_fetch_array($q)){
						if($r["type"]=="Task"){
							$icon = "fas fa-thumbtack text-primary"; 
							$color = "primary";
						}
						if($r["type"]=="Enhancement"){
							$icon = "fas fa-square-plus text-success";
							$color = "success";
						}
						if($r["type"]=="Bug"){
							$icon = "fas fa-bug text-danger";
							$color = "danger";
						}
						if($r["status"]=="Done"){
							$color = "warning";
						}
						?>
						<div class="card bg-white text-black small mb-2" id="id_<?php echo $r["id"]; ?>">
							<div class="card-header small text-black small fw-bolder bg-<?php echo $color; ?> border-0 pb-0" style="--bs-bg-opacity: .1;" onclick="javascript:window.location='index.php?pg=details&id=<?php echo $r["id"]; ?>'">
								<span class="<?php echo $icon; ?>" title="<?php echo $r["type"]; ?>"></span> <?php echo $proj["abbr"]; ?>-<?php echo $r["id"]; ?>
							</div>
							<div class="card-body bg-<?php echo $color; ?>" style="--bs-bg-opacity: .1;" onclick="javascript:window.location='index.php?pg=details&id=<?php echo $r["id"]; ?>'">
								<span class="small d-block"><?php echo $r["title"]; ?></span>
							</div>
							<div class="card-footer small d-flex justify-content-between align-items-center">
								<span class="small">
									<?php
									$aq = mysqli_query($con, "select * from resources where id=$r[assignee]");
									if(mysqli_num_rows($aq) > 0){
										$ar = mysqli_fetch_array($aq);
										?>
										<div title="<?php echo $ar["firstname"]." ".$ar["lastname"]; ?>" class="d-inline-flex align-items-center justify-content-center bg-dark text-white rounded-circle avatar">
											<?php
											if(strlen($ar["img"]) > 0){
											?>
												<img src="<?php echo $ar["img"]; ?>" class="avatar-img">
											<?php
											}
											else{
												echo $ar["initials"];
											}
											?>
										</div>
										<?php
									}
									else{
										echo "Unassigned (<a href=''>Assign</a>)";
									}
									?>
									
								</span>
								<span class="text-secondary small"><?php echo $r["severity"]; ?></span>
							</div>
						</div>
					<?php
					}
					?>
				</div>
			</div>
		</div>
		<div class="col-xl-2 col-md-2">
			<div class="card bg-dark text-white border-0">
				<div class="card-header">
					<label class="text-uppercase text-white small fw-bolder">RESOURCES</label>
				</div>
				<div class="card-body">
					<ul class="list-group small">
						<?php
						$q = mysqli_query($con, "select * from resources");
						while($r = mysqli_fetch_array($q)){
						?>
						<li class="list-group-item small d-flex justify-content-between align-items-center">
							<span class="text-dark small"><b class="text-uppercase"><?php echo $r["firstname"]." ".$r["lastname"]; ?></b><br/><span class="text-secondary small"><?php echo $r["role"]; ?></span></span>
							<div title="<?php echo $r["firstname"]." ".$r["lastname"]; ?>" class="d-inline-flex align-items-center justify-content-center bg-dark text-white rounded-circle avatar small">
								<?php
								if(strlen($r["img"]) > 0){
								?>
									<img src="<?php echo $r["img"]; ?>" class="avatar-img">
								<?php
								}
								else{
									echo $r["initials"];
								}
								?>
							</div>
						</li>
						<?php
						}
						?>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>
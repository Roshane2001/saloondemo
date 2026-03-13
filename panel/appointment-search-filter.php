<div class="form-grids row widget-shadow" data-example-id="basic-forms" style="margin: 10px 0;"> 
	<div class="form-title">
		<h4>Filter Appointments:</h4>
	</div>
	<div class="form-body">
		<form method="post" class="row">
			<div class="form-group col-md-3">
				<label>Search</label>
				<input type="text" class="form-control" name="searchdata" placeholder="Apt No, Name, or Phone" value="<?php echo isset($_POST['searchdata']) ? htmlspecialchars($_POST['searchdata'], ENT_QUOTES, 'UTF-8') : ''; ?>">
			</div>
			<div class="form-group col-md-3">
				<label>Branch</label>
				<select class="form-control" name="branch_id">
					<option value="">All Branches</option>
					<?php
					$query_branch = mysqli_query($con, "select * from tblbranch");
					while ($row_branch = mysqli_fetch_array($query_branch)) {
						$selected = (isset($_POST['branch_id']) && $_POST['branch_id'] == $row_branch['branch_id']) ? 'selected' : '';
						echo '<option value="' . $row_branch['branch_id'] . '" ' . $selected . '>' . $row_branch['branch_name'] . '</option>';
					}
					?>
				</select>
			</div>
			<div class="form-group col-md-2">
				<label>From Date</label>
				<input type="date" class="form-control" name="fromdate" value="<?php echo isset($_POST['fromdate']) ? $_POST['fromdate'] : ''; ?>">
			</div>
			<div class="form-group col-md-2">
				<label>To Date</label>
				<input type="date" class="form-control" name="todate" value="<?php echo isset($_POST['todate']) ? $_POST['todate'] : ''; ?>">
			</div>
			<div class="form-group col-md-2" style="padding-top: 22px;">
				<button type="submit" name="filter" class="btn btn-primary">Filter</button>
			</div>
		</form>
	</div>
</div>
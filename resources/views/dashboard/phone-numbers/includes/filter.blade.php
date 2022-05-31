<div class="row">
	<div class="col-md-12 pl-0 pr-0">
		<div class="collapse mb-4" id="collapseFilter">
			<form class="formFilter mt-4">

				<div class="col-md-12 mb-3">
					<div class="row">

						<div class="col-md-3 mb-3">
							<div class="form-group">
								<label class="form-control-label text-sm" for="number">Phone Number</label>
								<input type="text" name="number" id="number" class="form-control form-control-sm" placeholder="Phone Number">
							</div>
						</div>

						<div class="col-md-3 mb-3">
							<div class="form-group">
								<label class="form-control-label text-sm" for="nik">NIK</label>
								<input type="text" name="nik" id="nik" class="form-control form-control-sm" placeholder="NIK">
							</div>
						</div>

						<div class="col-md-3 mb-3">
							<div class="form-group">
								<label class="form-control-label text-sm" for="name">Name</label>
								<input type="text" name="name" id="name" class="form-control form-control-sm" placeholder="Name">
							</div>
						</div>

						<div class="col-md-3 mb-3">
							<div class="form-group">
								<label class="form-control-label text-sm" for="email">Email</label>
								<input type="text" name="email" id="email" class="form-control form-control-sm" placeholder="Email">
							</div>
						</div>

						<div class="col-md-3 mb-3">
							<div class="form-group">
								<label class="form-control-label text-sm" for="status">Status</label>
								<select name="status" id="status" class="form-control form-control-sm" style="height:33px;">
									<option value="">- Select Status -</option>
									<option value="active">Active</option>
									<option value="inactive">Inactive</option>
									<option value="unknown">Unknown</option>
								</select>
							</div>
						</div>

						<div class="col-md-3 mb-3">
							<div class="form-group">
								<label class="form-control-label text-sm" for="expired_date">Expired Date</label>
								<input type="date" name="expired_date" id="expired_date" class="form-control form-control-sm" placeholder="Expired Date">
							</div>
						</div>

						<div class="col-md-3 mb-3">
							<div class="form-group">
								<label class="form-control-label text-sm" for="created_at">Created Date</label>
								<input type="date" name="created_at" id="created_at" class="form-control form-control-sm" placeholder="Created Date">
							</div>
						</div>

					</div>
				</div>

				<div class="col-md-12">
					<center>
						<button type="button" onclick="filterTable()" class="btn btn-sm mb-3 btn-primary">
							<i class="fa fa-search"></i>&nbsp;Filter
						</button>
						<button type="button" onclick="clearForm()" class="btn btn-sm mb-3 btn-primary">
							<i class="fa fa-close"></i>&nbsp;Clear
						</button>
						<button type="button" onclick="exportData()" class="btn btn-sm mb-3 btn-primary">
							<i class="fa fa-download"></i>&nbsp;Export
						</button>
					</center>
				</div>

			</form>
		</div>
	</div>
</div>

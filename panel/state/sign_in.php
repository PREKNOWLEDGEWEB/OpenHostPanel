<body>
	<main class="d-flex w-100">
		<div class="container d-flex flex-column">
			<div class="row vh-100">
				<div class="col-sm-10 col-md-8 col-lg-6 mx-auto d-table h-100">
					<div class="d-table-cell align-middle">

						<div class="text-center mt-4">
							<h1 class="h2">OHS (Open Host Panel)</h1>
							<p class="lead">
								Sign in to Continue to OHS
							</p>
						</div>

						<div class="card">
							<div class="card-body">
								<div class="m-sm-4">
									<form method="POST" action="config/api.php">
                                        <?php if(isset($_GET['status'])){ ?>
                                        <div class="mb-3">
                                            <div class="card alert-danger" style="background:red; color:white; padding:20px;">
                                                Failed to Login
                                            </div>
                                        </div>
                                        <?php } ?>
										<div class="mb-3">
											<label class="form-label">Username</label>
											<input class="form-control form-control-lg" value="ohs_admin" type="text" name="username" placeholder="Enter your Username" />
										</div>
										<div class="mb-3">
											<label class="form-label">Password</label>
											<input class="form-control form-control-lg" type="password" name="password" placeholder="Enter your password" />
										</div>
										<div class="mt-3">
											<button type="submit" name="validate_login" class="btn btn-lg btn-primary">Login</button>
										</div>
									</form>
								</div>
							</div>
						</div>

					</div>
				</div>
			</div>
		</div>
	</main>
</body>

<style>

</style>

<nav id="sidebar">
	<div class="containerrr">
		<div class="logo1">
		<img src="./assets/img/logo.png" alt="">
		</div>
	<div class="sidebar-list">
		<?php if($_SESSION['login_type'] == 2): ?>
				<a href="index.php?page=home" class="nav-item nav-home"><span class="icon-field"><i class="ri-home-5-line"></i></i></span>Dashboard</a>
				<a href="index.php?page=loans" class="nav-item nav-loans"><span class="icon-field"><i class="ri-bank-card-line"></i></span>Loans</a>	
				<a href="index.php?page=payments" class="nav-item nav-payments"><span class="icon-field"><i class="ri-wallet-2-line"></i></span>Payments</a>
				<a href="index.php?page=borrowers" class="nav-item nav-borrowers"><span class="icon-field"><i class="ri-user-line"></i></span>Borrowers</a>
				<a href="index.php?page=plan" class="nav-item nav-plan"><span class="icon-field"><i class="ri-list-check"></i></span>Loan Plans</a>	
				<a href="index.php?page=loan_type" class="nav-item nav-loan_type"><span class="icon-field"><i class="ri-list-check"></i></span>Loan Types</a>		
				<?php endif; ?>
				<?php if($_SESSION['login_type'] == 1): ?>
					<a href="index.php?page=home" class="nav-item nav-home"><span class="icon-field"><i class="ri-home-5-line"></i></i></span>Dashboard</a>
				<a href="index.php?page=loans" class="nav-item nav-loans"><span class="icon-field"><i class="ri-bank-card-line"></i></span>Loans</a>	
				<a href="index.php?page=payments" class="nav-item nav-payments"><span class="icon-field"><i class="ri-wallet-2-line"></i></span>Payments</a>
				<a href="index.php?page=borrowers" class="nav-item nav-borrowers"><span class="icon-field"><i class="ri-user-line"></i></span>Borrowers</a>
				<a href="index.php?page=plan" class="nav-item nav-plan"><span class="icon-field"><i class="ri-list-check"></i></span>Loan Plans</a>	
				<a href="index.php?page=loan_type" class="nav-item nav-loan_type"><span class="icon-field"><i class="ri-list-check"></i></span>Loan Types</a>		
				
				<a href="index.php?page=users" class="nav-item nav-users"><span class="icon-field"><i class="ri-shield-user-line"></i></span>Users</a>
			<?php endif; ?>
		</div>
		</div>
</nav>
<script>
	$('.nav-<?php echo isset($_GET['page']) ? $_GET['page'] : '' ?>').addClass('active')
</script>
<?php
session_start();
if (!isset($_SESSION['username'])) 
{
die(header('Location: ../index.php'));
}

include('connection.php');
$qry = "SELECT count(*), sum(basic), sum(meal), sum(housing), sum(transport), sum(entertainment), sum(long_service), sum(tax), sum(totall), monthname(date_s) FROM salary GROUP BY month(date_s)";
$run = mysqli_query($conn, $qry) or die(mysqli_error($conn));

$qry2 = "SELECT count(*) FROM register_staff";
$run2 = mysqli_query($conn, $qry2) or die(mysqli_error($conn));

$qry3 = "SELECT *, count(*) FROM register_staff GROUP BY sex";
$run3 = mysqli_query($conn, $qry3) or die(mysqli_error($conn));

$qry4 = "SELECT *, count(*) FROM register_staff GROUP BY position";
$run4 = mysqli_query($conn, $qry4) or die(mysqli_error($conn));

$qry5 = "SELECT *, count(*) FROM register_staff GROUP BY department";
$run5 = mysqli_query($conn, $qry5) or die(mysqli_error($conn));

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Dashboard</title>
<link rel="stylesheet" href="../css/style.css?v=20250107" type="text/css" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
<script type="text/javascript">
	function proceed() {
		return confirm('Update Payment Variables?');
	}
</script>
</head>

<body>

<div class="app-shell">

	<div class="headerbar">
		<div class="brand-wrap">
			<button class="hamburger" id="sidebarToggle" aria-label="Toggle sidebar">
				<span></span>
				<span></span>
				<span></span>
			</button>
			<div class="brand">
				<i class="fas fa-chart-line"></i>
				Payroll Admin Dashboard
			</div>
		</div>
		<div class="user-profile">
			<div class="avatar" id="profileAvatar">A</div>
			<span class="profile-label">Administrator</span>
			<div class="profile-dropdown" id="profileDropdown">
				<ul>
					<li><a href="profile.php"><i class="fas fa-user"></i> Profile</a></li>
					<li><a href="settings.php"><i class="fas fa-cog"></i> Settings</a></li>
					<li><a href="help.php"><i class="fas fa-question-circle"></i> Help</a></li>
					<li><a href="../logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
				</ul>
			</div>
		</div>
	</div>

<div class="layout" id="layout">
	<aside class="sidebar">
		<ul class="nav-list">
			<li class="nav-item">
				<a class="nav-link active" href="index.php">
					<i class="fas fa-home nav-icon"></i>
					<span class="nav-text">Dashboard</span>
				</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="reg_staff.php">
					<i class="fas fa-user-plus nav-icon"></i>
					<span class="nav-text">Register Staff</span>
				</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="view_staff.php">
					<i class="fas fa-users nav-icon"></i>
					<span class="nav-text">View Staff</span>
				</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="payroll.php">
					<i class="fas fa-calculator nav-icon"></i>
					<span class="nav-text">Payroll</span>
				</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="print.php">
					<i class="fas fa-print nav-icon"></i>
					<span class="nav-text">Print Slip</span>
				</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="sentmessages.php">
					<i class="fas fa-paper-plane nav-icon"></i>
					<span class="nav-text">Messages</span>
				</a>
			</li>
		</ul>
	</aside>
	<main class="main">
		<div class="cards">
			<div class="card">
				<h3>
					<i class="fas fa-users card-icon"></i>
					Staff Overview
				</h3>
				<table>
					<?php while ($rows = mysqli_fetch_array($run2)) {?>
					<tr>
						<td><i class="fas fa-user-check"></i> Total Registered Staff</td>
						<td><strong><?php echo $rows['count(*)']; ?></strong></td>
					</tr>
					<?php }?>
					<?php  while($rowsb = mysqli_fetch_array($run3)) {?>
					<tr>
						<td><i class="fas fa-<?php echo ($rowsb['sex'] == 'Male') ? 'male' : 'female'; ?>"></i> <?php echo $rowsb['sex']; ?></td>
						<td><strong><?php echo $rowsb['count(*)']; ?></strong></td>
					</tr>
					<?php }?>
				</table>
			</div>
			<div class="card">
				<h3>
					<i class="fas fa-briefcase card-icon"></i>
					Staff by Position
				</h3>
				<table>
					<tr>
						<th>Position</th>
						<th>Count</th>
					</tr>
					<?php  while($rb = mysqli_fetch_array($run4)) {?>
					<tr>
						<td><a href="position.php?position=<?php echo $rb['position'];?>" style="color: #059669; text-decoration: none;"><?php echo $rb['position'];?></a></td>
						<td><strong><?php echo $rb['count(*)']; ?></strong></td>
					</tr>
					<?php }?>
				</table>
			</div>
			<div class="card">
				<h3>
					<i class="fas fa-building card-icon"></i>
					Staff by Department
				</h3>
				<table>
					<tr>
						<th>Department</th>
						<th>Count</th>
					</tr>
					<?php  while($r = mysqli_fetch_array($run5)) {?>
					<tr>
						<td><a href="department.php?department=<?php echo $r['department']; ?>" style="color: #059669; text-decoration: none;"><?php echo $r['department'];?></a></td>
						<td><strong><?php echo $r['count(*)']; ?></strong></td>
					</tr>
					<?php }?>
				</table>
			</div>
		</div>

		<div class="data-table" style="margin-top: 24px;">
			<div style="padding: 20px 24px 16px 24px; border-bottom: 1px solid rgba(0, 0, 0, 0.05);">
				<h3 style="margin: 0; font-size: 18px; font-weight: 600; color: #1f2937; display: flex; align-items: center; gap: 8px;">
					<i class="fas fa-chart-bar" style="width: 20px; height: 20px; color: #059669;"></i>
					Monthly Payroll Summary
				</h3>
			</div>
			<table style="width: 100%; border-collapse: collapse;">
				<tr>
					<th style="padding: 16px 20px; text-align: left; border-bottom: 1px solid rgba(0, 0, 0, 0.05); background: rgba(5, 150, 105, 0.1); font-weight: 600; color: #1f2937; font-size: 12px; text-transform: uppercase; letter-spacing: 0.5px;"><i class="fas fa-users"></i> Salaries Paid</th>
					<th style="padding: 16px 20px; text-align: left; border-bottom: 1px solid rgba(0, 0, 0, 0.05); background: rgba(5, 150, 105, 0.1); font-weight: 600; color: #1f2937; font-size: 12px; text-transform: uppercase; letter-spacing: 0.5px;"><i class="fas fa-money-bill-wave"></i> Basic Salary</th>
					<th style="padding: 16px 20px; text-align: left; border-bottom: 1px solid rgba(0, 0, 0, 0.05); background: rgba(5, 150, 105, 0.1); font-weight: 600; color: #1f2937; font-size: 12px; text-transform: uppercase; letter-spacing: 0.5px;"><i class="fas fa-utensils"></i> Meal</th>
					<th style="padding: 16px 20px; text-align: left; border-bottom: 1px solid rgba(0, 0, 0, 0.05); background: rgba(5, 150, 105, 0.1); font-weight: 600; color: #1f2937; font-size: 12px; text-transform: uppercase; letter-spacing: 0.5px;"><i class="fas fa-home"></i> Housing</th>
					<th style="padding: 16px 20px; text-align: left; border-bottom: 1px solid rgba(0, 0, 0, 0.05); background: rgba(5, 150, 105, 0.1); font-weight: 600; color: #1f2937; font-size: 12px; text-transform: uppercase; letter-spacing: 0.5px;"><i class="fas fa-car"></i> Transport</th>
					<th style="padding: 16px 20px; text-align: left; border-bottom: 1px solid rgba(0, 0, 0, 0.05); background: rgba(5, 150, 105, 0.1); font-weight: 600; color: #1f2937; font-size: 12px; text-transform: uppercase; letter-spacing: 0.5px;"><i class="fas fa-glass-cheers"></i> Entertainment</th>
					<th style="padding: 16px 20px; text-align: left; border-bottom: 1px solid rgba(0, 0, 0, 0.05); background: rgba(5, 150, 105, 0.1); font-weight: 600; color: #1f2937; font-size: 12px; text-transform: uppercase; letter-spacing: 0.5px;"><i class="fas fa-medal"></i> Long Service</th>
					<th style="padding: 16px 20px; text-align: left; border-bottom: 1px solid rgba(0, 0, 0, 0.05); background: rgba(5, 150, 105, 0.1); font-weight: 600; color: #1f2937; font-size: 12px; text-transform: uppercase; letter-spacing: 0.5px;"><i class="fas fa-receipt"></i> Tax</th>
					<th style="padding: 16px 20px; text-align: left; border-bottom: 1px solid rgba(0, 0, 0, 0.05); background: rgba(5, 150, 105, 0.1); font-weight: 600; color: #1f2937; font-size: 12px; text-transform: uppercase; letter-spacing: 0.5px;"><i class="fas fa-calculator"></i> Total</th>
					<th style="padding: 16px 20px; text-align: left; border-bottom: 1px solid rgba(0, 0, 0, 0.05); background: rgba(5, 150, 105, 0.1); font-weight: 600; color: #1f2937; font-size: 12px; text-transform: uppercase; letter-spacing: 0.5px;"><i class="fas fa-calendar"></i> Month</th>
				</tr>
				<?php while ($row = mysqli_fetch_array($run)) {?>
				<tr style="transition: all 0.3s ease;" onmouseover="this.style.background='rgba(5, 150, 105, 0.05)'" onmouseout="this.style.background='transparent'">
					<td style="padding: 16px 20px; text-align: left; border-bottom: 1px solid rgba(0, 0, 0, 0.05); color: #64748b; font-weight: 500;"><strong><?php echo $row['count(*)']; ?></strong></td>
					<td style="padding: 16px 20px; text-align: left; border-bottom: 1px solid rgba(0, 0, 0, 0.05); color: #64748b; font-weight: 500;">₦<?php echo number_format(round($row['sum(basic)'])); ?></td>
					<td style="padding: 16px 20px; text-align: left; border-bottom: 1px solid rgba(0, 0, 0, 0.05); color: #64748b; font-weight: 500;">₦<?php echo number_format(round($row['sum(meal)'])); ?></td>
					<td style="padding: 16px 20px; text-align: left; border-bottom: 1px solid rgba(0, 0, 0, 0.05); color: #64748b; font-weight: 500;">₦<?php echo number_format(round($row['sum(housing)'])); ?></td>
					<td style="padding: 16px 20px; text-align: left; border-bottom: 1px solid rgba(0, 0, 0, 0.05); color: #64748b; font-weight: 500;">₦<?php echo number_format(round($row['sum(transport)'])); ?></td>
					<td style="padding: 16px 20px; text-align: left; border-bottom: 1px solid rgba(0, 0, 0, 0.05); color: #64748b; font-weight: 500;">₦<?php echo number_format(round($row['sum(entertainment)'])); ?></td>
					<td style="padding: 16px 20px; text-align: left; border-bottom: 1px solid rgba(0, 0, 0, 0.05); color: #64748b; font-weight: 500;">₦<?php echo number_format(round($row['sum(long_service)'])); ?></td>
					<td style="padding: 16px 20px; text-align: left; border-bottom: 1px solid rgba(0, 0, 0, 0.05); color: #64748b; font-weight: 500;">₦<?php echo number_format(round($row['sum(tax)'])); ?></td>
					<td style="padding: 16px 20px; text-align: left; border-bottom: 1px solid rgba(0, 0, 0, 0.05); color: #64748b; font-weight: 500;"><strong>₦<?php echo number_format(round($row['sum(totall)'])); ?></strong></td>
					<td style="padding: 16px 20px; text-align: left; border-bottom: 1px solid rgba(0, 0, 0, 0.05); color: #64748b; font-weight: 500;"><a href="view_month.php?month=<?php echo $row['monthname(date_s)'];?>" style="color: #059669; text-decoration: none; font-weight: 600;"><?php echo $row['monthname(date_s)'];?></a></td>
				</tr>
				<?php }?>
			</table>
		</div>
	</main>
</div>

</div>
<script type="text/javascript">
// Modern sidebar toggle functionality
document.addEventListener('DOMContentLoaded', function() {
	const toggleBtn = document.getElementById('sidebarToggle');
	const layoutEl = document.getElementById('layout');
	const sidebar = document.querySelector('.sidebar');
	const profileAvatar = document.getElementById('profileAvatar');
	const profileDropdown = document.getElementById('profileDropdown');
	
	if (toggleBtn && layoutEl) {
		toggleBtn.addEventListener('click', function() {
			layoutEl.classList.toggle('sidebar-collapsed');
			
			// Add animation classes
			if (layoutEl.classList.contains('sidebar-collapsed')) {
				sidebar.style.transform = 'translateX(0)';
			} else {
				sidebar.style.transform = 'translateX(0)';
			}
		});
	}
	
	// Mobile responsive sidebar
	const mediaQuery = window.matchMedia('(max-width: 768px)');
	function handleMobileSidebar(e) {
		if (e.matches) {
			sidebar.style.transform = 'translateX(-100%)';
			sidebar.classList.add('mobile-sidebar');
		} else {
			sidebar.style.transform = 'translateX(0)';
			sidebar.classList.remove('mobile-sidebar');
		}
	}
	
	mediaQuery.addListener(handleMobileSidebar);
	handleMobileSidebar(mediaQuery);
	
	// Mobile sidebar toggle
	if (toggleBtn) {
		toggleBtn.addEventListener('click', function() {
			if (window.innerWidth <= 768) {
				sidebar.classList.toggle('open');
			}
		});
	}
	
	// Profile dropdown functionality
	if (profileAvatar && profileDropdown) {
		profileAvatar.addEventListener('click', function(e) {
			e.stopPropagation();
			profileDropdown.classList.toggle('show');
		});
		
		// Close dropdown when clicking outside
		document.addEventListener('click', function(e) {
			if (!profileAvatar.contains(e.target) && !profileDropdown.contains(e.target)) {
				profileDropdown.classList.remove('show');
			}
		});
		
		// Close dropdown when clicking on dropdown items
		const dropdownLinks = profileDropdown.querySelectorAll('a');
		dropdownLinks.forEach(link => {
			link.addEventListener('click', function() {
				profileDropdown.classList.remove('show');
			});
		});
	}
	
	// Close mobile sidebar when clicking outside
	document.addEventListener('click', function(e) {
		if (window.innerWidth <= 768 && 
			!sidebar.contains(e.target) && 
			!toggleBtn.contains(e.target) && 
			sidebar.classList.contains('open')) {
			sidebar.classList.remove('open');
		}
	});
	
	// Smooth scrolling for better UX
	document.querySelectorAll('a[href^="#"]').forEach(anchor => {
		anchor.addEventListener('click', function (e) {
			e.preventDefault();
			const target = document.querySelector(this.getAttribute('href'));
			if (target) {
				target.scrollIntoView({
					behavior: 'smooth',
					block: 'start'
				});
			}
		});
	});
	
	// Add loading animation
	const cards = document.querySelectorAll('.card');
	cards.forEach((card, index) => {
		card.style.opacity = '0';
		card.style.transform = 'translateY(20px)';
		setTimeout(() => {
			card.style.transition = 'all 0.6s ease';
			card.style.opacity = '1';
			card.style.transform = 'translateY(0)';
		}, index * 100);
	});
});
</script>
</body>
</html>
<?php
include('../admin/connection.php');
session_start();
if (!isset($_SESSION['staff_id'])) 
{
die(header('Location: ../index.php'));
}

$staff_id = $_SESSION['staff_id'];
$qry = mysqli_query($conn, "SELECT * FROM staff_outbox WHERE sender = '$staff_id'");

// Get staff name for avatar
$staff_qry = mysqli_query($conn, "SELECT fname FROM register_staff WHERE staff_id = '$staff_id'");
$staff_data = mysqli_fetch_array($staff_qry);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Staff Sent Messages</title>
<link rel="stylesheet" href="../css/style.css?v=20250107" type="text/css" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>

<body>

<div class="app-shell">

	<div class="headerbar">
		<div class="brand-wrap">
			<button class="hamburger" id="sidebarToggle">
				<span></span>
				<span></span>
				<span></span>
			</button>
			<div class="brand">Staff Portal</div>
		</div>
		
		<div class="user-profile">
			<div class="avatar" onclick="toggleProfile()">
				<?php echo strtoupper(substr($staff_data['fname'], 0, 1)); ?>
			</div>
			<div class="profile-dropdown" id="profileDropdown">
				<ul>
					<li><a href="profile.php"><i class="fas fa-user"></i> Profile</a></li>
					<li><a href="resetpassword.php"><i class="fas fa-key"></i> Change Password</a></li>
					<li><a href="../logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
				</ul>
			</div>
		</div>
	</div>

	<div class="layout" id="layout">
		<div class="sidebar">
			<ul class="nav-list">
				<li class="nav-item">
					<a href="index.php" class="nav-link">
						<i class="fas fa-home nav-icon"></i>
						<span class="nav-text">Dashboard</span>
					</a>
				</li>
				<li class="nav-item">
					<a href="inbox.php" class="nav-link">
						<i class="fas fa-inbox nav-icon"></i>
						<span class="nav-text">Messages</span>
					</a>
				</li>
				<li class="nav-item">
					<a href="compose2.php" class="nav-link">
						<i class="fas fa-edit nav-icon"></i>
						<span class="nav-text">Compose</span>
					</a>
				</li>
				<li class="nav-item">
					<a href="outbox.php" class="nav-link active">
						<i class="fas fa-paper-plane nav-icon"></i>
						<span class="nav-text">Sent Messages</span>
					</a>
				</li>
				<li class="nav-item">
					<a href="payments.php" class="nav-link">
						<i class="fas fa-money-bill-wave nav-icon"></i>
						<span class="nav-text">Payments</span>
					</a>
				</li>
			</ul>
		</div>

		<main class="main">
			<div class="data-table">
				<div style="padding: 20px 24px 16px 24px; border-bottom: 1px solid rgba(0, 0, 0, 0.05);">
					<h3 style="margin: 0; font-size: 18px; font-weight: 600; color: #2d3748; display: flex; align-items: center; gap: 8px;">
						<i class="fas fa-paper-plane" style="width: 20px; height: 20px; color: #667eea;"></i>
						Sent Messages
					</h3>
					<p style="margin: 8px 0 0 0; color: #718096; font-size: 14px;">View and manage your sent messages</p>
				</div>
				
				<div style="overflow-x: auto;">
					<table style="width: 100%; border-collapse: collapse; min-width: 1000px;">
						<thead>
							<tr>
								<th style="padding: 16px 20px; text-align: left; border-bottom: 1px solid rgba(0, 0, 0, 0.05); background: rgba(102, 126, 234, 0.1); font-weight: 600; color: #2d3748; font-size: 12px; text-transform: uppercase; letter-spacing: 0.5px;"><i class="fas fa-id-card"></i> Recipient ID</th>
								<th style="padding: 16px 20px; text-align: left; border-bottom: 1px solid rgba(0, 0, 0, 0.05); background: rgba(102, 126, 234, 0.1); font-weight: 600; color: #2d3748; font-size: 12px; text-transform: uppercase; letter-spacing: 0.5px;"><i class="fas fa-user-friends"></i> Sent to</th>
								<th style="padding: 16px 20px; text-align: left; border-bottom: 1px solid rgba(0, 0, 0, 0.05); background: rgba(102, 126, 234, 0.1); font-weight: 600; color: #2d3748; font-size: 12px; text-transform: uppercase; letter-spacing: 0.5px;"><i class="fas fa-tag"></i> Subject</th>
								<th style="padding: 16px 20px; text-align: left; border-bottom: 1px solid rgba(0, 0, 0, 0.05); background: rgba(102, 126, 234, 0.1); font-weight: 600; color: #2d3748; font-size: 12px; text-transform: uppercase; letter-spacing: 0.5px;"><i class="fas fa-comment"></i> Message</th>
								<th style="padding: 16px 20px; text-align: left; border-bottom: 1px solid rgba(0, 0, 0, 0.05); background: rgba(102, 126, 234, 0.1); font-weight: 600; color: #2d3748; font-size: 12px; text-transform: uppercase; letter-spacing: 0.5px;"><i class="fas fa-calendar"></i> Date Sent</th>
								<th style="padding: 16px 20px; text-align: center; border-bottom: 1px solid rgba(0, 0, 0, 0.05); background: rgba(102, 126, 234, 0.1); font-weight: 600; color: #2d3748; font-size: 12px; text-transform: uppercase; letter-spacing: 0.5px;"><i class="fas fa-cogs"></i> Actions</th>
							</tr>
						</thead>
						<tbody>
							<?php while ($tbl = mysqli_fetch_array($qry)) { ?>
							<tr style="transition: all 0.3s ease;" onmouseover="this.style.background='rgba(102, 126, 234, 0.05)'" onmouseout="this.style.background='transparent'">
								<td style="padding: 16px 20px; text-align: left; border-bottom: 1px solid rgba(0, 0, 0, 0.05); color: #4a5568; font-weight: 500;"><?php echo $tbl['staff_id']; ?></td>
								<td style="padding: 16px 20px; text-align: left; border-bottom: 1px solid rgba(0, 0, 0, 0.05); color: #4a5568; font-weight: 500;"><?php echo $tbl['receiver']; ?></td>
								<td style="padding: 16px 20px; text-align: left; border-bottom: 1px solid rgba(0, 0, 0, 0.05); color: #4a5568; font-weight: 500;"><?php echo $tbl['msg_subject']; ?></td>
								<td style="padding: 16px 20px; text-align: left; border-bottom: 1px solid rgba(0, 0, 0, 0.05); color: #4a5568; font-weight: 500; max-width: 200px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;"><?php echo substr($tbl['msg_msg'], 0, 50); ?>...</td>
								<td style="padding: 16px 20px; text-align: left; border-bottom: 1px solid rgba(0, 0, 0, 0.05); color: #4a5568; font-weight: 500;"><?php echo $tbl['date_sent']; ?></td>
								<td style="padding: 16px 20px; text-align: center; border-bottom: 1px solid rgba(0, 0, 0, 0.05); color: #4a5568; font-weight: 500;">
									<div style="display: flex; gap: 8px; justify-content: center; flex-wrap: wrap;">
										<a href="outboxmore.php?so_id=<?php echo $tbl['so_id']; ?>" style="background: #3182ce; color: white; padding: 6px 12px; border-radius: 6px; text-decoration: none; font-size: 12px; transition: all 0.3s ease;" onmouseover="this.style.background='#2c5282'" onmouseout="this.style.background='#3182ce'"><i class="fas fa-eye"></i> Read</a>
										<a href="delete.php?so_id=<?php echo $tbl['so_id']; ?>" style="background: #e53e3e; color: white; padding: 6px 12px; border-radius: 6px; text-decoration: none; font-size: 12px; transition: all 0.3s ease;" onmouseover="this.style.background='#c53030'" onmouseout="this.style.background='#e53e3e'" onclick="return confirm('Are you sure you want to delete this message?')"><i class="fas fa-trash"></i> Delete</a>
									</div>
								</td>
							</tr>
							<?php } ?>
						</tbody>
					</table>
				</div>
			</div>

			<div class="card" style="margin-top: 24px;">
				<h3>
					<i class="fas fa-link card-icon"></i>
					Quick Actions
				</h3>
				<div style="display: flex; gap: 16px; flex-wrap: wrap;">
					<a href="index.php" class="btn" style="display: flex; align-items: center; gap: 8px;">
						<i class="fas fa-home"></i>
						Dashboard
					</a>
					<a href="inbox.php" class="btn" style="display: flex; align-items: center; gap: 8px;">
						<i class="fas fa-inbox"></i>
						Inbox
					</a>
					<a href="compose2.php" class="btn" style="display: flex; align-items: center; gap: 8px;">
						<i class="fas fa-edit"></i>
						Compose Message
					</a>
					<a href="payments.php" class="btn" style="display: flex; align-items: center; gap: 8px;">
						<i class="fas fa-money-bill-wave"></i>
						View Payments
					</a>
				</div>
			</div>
		</main>
	</div>
</div>

<script type="text/javascript">
// Modern sidebar toggle functionality
document.addEventListener('DOMContentLoaded', function() {
	const toggleBtn = document.getElementById('sidebarToggle');
	const layoutEl = document.getElementById('layout');
	
	toggleBtn.addEventListener('click', function() {
		layoutEl.classList.toggle('sidebar-collapsed');
	});
});

// Profile dropdown functionality
function toggleProfile() {
	const dropdown = document.getElementById('profileDropdown');
	dropdown.classList.toggle('show');
}

// Close dropdown when clicking outside
document.addEventListener('click', function(event) {
	const dropdown = document.getElementById('profileDropdown');
	const avatar = document.querySelector('.avatar');
	
	if (!avatar.contains(event.target) && !dropdown.contains(event.target)) {
		dropdown.classList.remove('show');
	}
});
</script>

</body>
</html>
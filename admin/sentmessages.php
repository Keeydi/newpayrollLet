<?php
session_start();
if (!isset($_SESSION['username'])) 
{
die(header('Location: ../index.php'));
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Admin Sent Messages</title>
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
			<div class="brand">Payroll Management System</div>
		</div>
		
		<div class="user-profile">
			<div class="avatar" onclick="toggleProfile()">
				<?php echo strtoupper(substr($_SESSION['username'], 0, 1)); ?>
			</div>
			<div class="profile-dropdown" id="profileDropdown">
				<ul>
					<li><a href="profile.php"><i class="fas fa-user"></i> Profile</a></li>
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
					<a href="reg_staff.php" class="nav-link">
						<i class="fas fa-user-plus nav-icon"></i>
						<span class="nav-text">Register Staff</span>
					</a>
				</li>
				<li class="nav-item">
					<a href="view_staff.php" class="nav-link">
						<i class="fas fa-users nav-icon"></i>
						<span class="nav-text">View Staff</span>
					</a>
				</li>
				<li class="nav-item">
					<a href="payroll.php" class="nav-link">
						<i class="fas fa-money-bill-wave nav-icon"></i>
						<span class="nav-text">Payroll</span>
					</a>
				</li>
				<li class="nav-item">
					<a href="sentmessages.php" class="nav-link active">
						<i class="fas fa-paper-plane nav-icon"></i>
						<span class="nav-text">Sent Messages</span>
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
					<table style="width: 100%; border-collapse: collapse; min-width: 1200px;">
						<thead>
							<tr>
								<th style="padding: 16px 20px; text-align: left; border-bottom: 1px solid rgba(0, 0, 0, 0.05); background: rgba(102, 126, 234, 0.1); font-weight: 600; color: #2d3748; font-size: 12px; text-transform: uppercase; letter-spacing: 0.5px;"><i class="fas fa-hashtag"></i> Message ID</th>
								<th style="padding: 16px 20px; text-align: left; border-bottom: 1px solid rgba(0, 0, 0, 0.05); background: rgba(102, 126, 234, 0.1); font-weight: 600; color: #2d3748; font-size: 12px; text-transform: uppercase; letter-spacing: 0.5px;"><i class="fas fa-user"></i> Sender</th>
								<th style="padding: 16px 20px; text-align: left; border-bottom: 1px solid rgba(0, 0, 0, 0.05); background: rgba(102, 126, 234, 0.1); font-weight: 600; color: #2d3748; font-size: 12px; text-transform: uppercase; letter-spacing: 0.5px;"><i class="fas fa-id-card"></i> Recipient ID</th>
								<th style="padding: 16px 20px; text-align: left; border-bottom: 1px solid rgba(0, 0, 0, 0.05); background: rgba(102, 126, 234, 0.1); font-weight: 600; color: #2d3748; font-size: 12px; text-transform: uppercase; letter-spacing: 0.5px;"><i class="fas fa-user-friends"></i> Recipients</th>
								<th style="padding: 16px 20px; text-align: left; border-bottom: 1px solid rgba(0, 0, 0, 0.05); background: rgba(102, 126, 234, 0.1); font-weight: 600; color: #2d3748; font-size: 12px; text-transform: uppercase; letter-spacing: 0.5px;"><i class="fas fa-tag"></i> Subject</th>
								<th style="padding: 16px 20px; text-align: left; border-bottom: 1px solid rgba(0, 0, 0, 0.05); background: rgba(102, 126, 234, 0.1); font-weight: 600; color: #2d3748; font-size: 12px; text-transform: uppercase; letter-spacing: 0.5px;"><i class="fas fa-comment"></i> Message</th>
								<th style="padding: 16px 20px; text-align: left; border-bottom: 1px solid rgba(0, 0, 0, 0.05); background: rgba(102, 126, 234, 0.1); font-weight: 600; color: #2d3748; font-size: 12px; text-transform: uppercase; letter-spacing: 0.5px;"><i class="fas fa-calendar"></i> Date Sent</th>
								<th style="padding: 16px 20px; text-align: center; border-bottom: 1px solid rgba(0, 0, 0, 0.05); background: rgba(102, 126, 234, 0.1); font-weight: 600; color: #2d3748; font-size: 12px; text-transform: uppercase; letter-spacing: 0.5px;"><i class="fas fa-cogs"></i> Actions</th>
							</tr>
						</thead>
						<tbody>
							<?php
							//database connection
							include_once('connection.php');

							//view record
							$qry = mysqli_query($conn, "SELECT * FROM admin_outbox");
							
							while ($row = mysqli_fetch_array($qry))
							{
								echo "<tr style='transition: all 0.3s ease;' onmouseover=\"this.style.background='rgba(102, 126, 234, 0.05)'\" onmouseout=\"this.style.background='transparent'\">";
								echo "<td style='padding: 16px 20px; text-align: left; border-bottom: 1px solid rgba(0, 0, 0, 0.05); color: #4a5568; font-weight: 500;'>" . $row['ao_id'] . "</td>";
								echo "<td style='padding: 16px 20px; text-align: left; border-bottom: 1px solid rgba(0, 0, 0, 0.05); color: #4a5568; font-weight: 500;'>" . $row['sender'] . "</td>";
								echo "<td style='padding: 16px 20px; text-align: left; border-bottom: 1px solid rgba(0, 0, 0, 0.05); color: #4a5568; font-weight: 500;'>" . $row['staff_id'] . "</td>";
								echo "<td style='padding: 16px 20px; text-align: left; border-bottom: 1px solid rgba(0, 0, 0, 0.05); color: #4a5568; font-weight: 500;'>" . $row['receiver'] . "</td>";
								echo "<td style='padding: 16px 20px; text-align: left; border-bottom: 1px solid rgba(0, 0, 0, 0.05); color: #4a5568; font-weight: 500;'>" . $row['msg_subject'] . "</td>";
								echo "<td style='padding: 16px 20px; text-align: left; border-bottom: 1px solid rgba(0, 0, 0, 0.05); color: #4a5568; font-weight: 500; max-width: 200px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;'>" . substr($row['msg_msg'], 0, 50) . "...</td>";
								echo "<td style='padding: 16px 20px; text-align: left; border-bottom: 1px solid rgba(0, 0, 0, 0.05); color: #4a5568; font-weight: 500;'>" . $row['sent_date'] . "</td>";
								echo "<td style='padding: 16px 20px; text-align: center; border-bottom: 1px solid rgba(0, 0, 0, 0.05); color: #4a5568; font-weight: 500;'>";
								echo "<div style='display: flex; gap: 8px; justify-content: center; flex-wrap: wrap;'>";
								echo "<a href='readmessage.php?staff_id=" . $row['staff_id'] . "&ao_id=" . $row['ao_id'] . "' style='background: #3182ce; color: white; padding: 6px 12px; border-radius: 6px; text-decoration: none; font-size: 12px; transition: all 0.3s ease;' onmouseover=\"this.style.background='#2c5282'\" onmouseout=\"this.style.background='#3182ce'\"><i class='fas fa-eye'></i> Read</a>";
								echo "<a href='messagedelete.php?staff_id=" . $row['staff_id'] . "&ao_id=" . $row['ao_id'] . "' style='background: #e53e3e; color: white; padding: 6px 12px; border-radius: 6px; text-decoration: none; font-size: 12px; transition: all 0.3s ease;' onmouseover=\"this.style.background='#c53030'\" onmouseout=\"this.style.background='#e53e3e'\"><i class='fas fa-trash'></i> Delete</a>";
								echo "</div>";
								echo "</td>";
								echo "</tr>";
							}
							?>
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
						Go Home
					</a>
					<a href="payroll.php" class="btn" style="display: flex; align-items: center; gap: 8px;">
						<i class="fas fa-calculator"></i>
						Calculate Payroll
					</a>
					<a href="view_staff.php" class="btn" style="display: flex; align-items: center; gap: 8px;">
						<i class="fas fa-users"></i>
						View Staff
					</a>
					<a href="im.php" class="btn" style="display: flex; align-items: center; gap: 8px;">
						<i class="fas fa-envelope"></i>
						Compose Message
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
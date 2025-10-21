<?php
session_start();
if (!isset($_SESSION['username'])) 
{
die(header('Location: ../index.php'));
}

include('connection.php');
include('../sanitise.php');
$id = sanitise($_GET['ao_id']);
$staff_id = sanitise($_GET['staff_id']);
$qry =("SELECT * FROM admin_outbox WHERE ao_id = '$id' AND staff_id = '$staff_id'");
$update = mysqli_query($conn, $qry) or die(mysqli_error($conn));
$row_update = mysqli_fetch_assoc($update);
$totalRows_update = mysqli_num_rows($update);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Admin - Read Message</title>
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
			<div class="card">
				<h3>
					<i class="fas fa-envelope-open card-icon"></i>
					Message Details
				</h3>
				
				<div class="message-details">
					<div class="message-field">
						<label><i class="fas fa-hashtag"></i> Message ID</label>
						<div class="field-value"><?php echo $row_update['ao_id']; ?></div>
					</div>
					
					<div class="message-field">
						<label><i class="fas fa-calendar"></i> Date Sent</label>
						<div class="field-value"><?php echo $row_update['sent_date']; ?></div>
					</div>
					
					<div class="message-field">
						<label><i class="fas fa-user-friends"></i> Sent to</label>
						<div class="field-value"><?php echo $row_update['receiver']; ?></div>
					</div>
					
					<div class="message-field">
						<label><i class="fas fa-tag"></i> Subject</label>
						<div class="field-value"><?php echo $row_update['msg_subject']; ?></div>
					</div>
					
					<div class="message-field message-content">
						<label><i class="fas fa-comment"></i> Message</label>
						<div class="field-value message-text"><?php echo nl2br($row_update['msg_msg']); ?></div>
					</div>
				</div>
				
				<div class="message-actions">
					<a href="sentmessages.php" class="btn" style="display: flex; align-items: center; gap: 8px;">
						<i class="fas fa-arrow-left"></i>
						Back to Messages
					</a>
					<a href="messagedelete.php?staff_id=<?php echo $staff_id; ?>&ao_id=<?php echo $id; ?>" class="btn" style="background: #e53e3e; display: flex; align-items: center; gap: 8px;" onclick="return confirm('Are you sure you want to delete this message?')">
						<i class="fas fa-trash"></i>
						Delete Message
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
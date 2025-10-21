<?php
include('../admin/connection.php');
include('../sanitise.php');
session_start();
if (!isset($_SESSION['staff_id'])) 
{
die(header('Location: ../index.php'));
}

$staff_id = $_SESSION['staff_id'];
$mess = sanitise($_GET['id']);
$qry = mysqli_query($conn, "SELECT * FROM staff_inbox WHERE id = '$mess'");
$tbl = mysqli_fetch_array($qry);

// Get staff name for avatar
$staff_qry = mysqli_query($conn, "SELECT fname FROM register_staff WHERE staff_id = '$staff_id'");
$staff_data = mysqli_fetch_array($staff_qry);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Read Message</title>
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
					<a href="inbox.php" class="nav-link active">
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
					<a href="outbox.php" class="nav-link">
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
			<div class="card">
				<h3>
					<i class="fas fa-envelope-open card-icon"></i>
					Received Message Details
				</h3>
				
				<div class="message-details">
					<div class="message-field">
						<label><i class="fas fa-calendar"></i> Received Date</label>
						<div class="field-value"><?php echo $tbl['received_date']; ?></div>
					</div>
					
					<div class="message-field">
						<label><i class="fas fa-user"></i> Sender</label>
						<div class="field-value"><?php echo $tbl['sender']; ?></div>
					</div>
					
					<div class="message-field">
						<label><i class="fas fa-tag"></i> Subject</label>
						<div class="field-value"><?php echo $tbl['msg_subject']; ?></div>
					</div>
					
					<div class="message-field message-content">
						<label><i class="fas fa-comment"></i> Message</label>
						<div class="field-value message-text"><?php echo nl2br($tbl['msg_msg']); ?></div>
					</div>
				</div>
				
				<div class="message-actions">
					<a href="inbox.php" class="btn" style="display: flex; align-items: center; gap: 8px;">
						<i class="fas fa-arrow-left"></i>
						Back to Inbox
					</a>
					<a href="inboxdelete.php?id=<?php echo $mess; ?>" class="btn" style="background: #e53e3e; display: flex; align-items: center; gap: 8px;" onclick="return confirm('Are you sure you want to delete this message?')">
						<i class="fas fa-trash"></i>
						Delete Message
					</a>
					<a href="compose2.php" class="btn" style="background: #38a169; display: flex; align-items: center; gap: 8px;">
						<i class="fas fa-reply"></i>
						Reply
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
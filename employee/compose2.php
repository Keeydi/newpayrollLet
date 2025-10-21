<?php
include('../admin/connection.php');
include('../sanitise.php');
session_start();
if (!isset($_SESSION['staff_id'])) 
{
die(header('Location: ../index.php'));
}

$staff_id = $_SESSION['staff_id'];
$qry1 = mysqli_query($conn, "SELECT * FROM register_staff");
$qry2 = mysqli_query($conn, "SELECT * FROM register_staff WHERE staff_id = '$staff_id'");
while ($row = mysqli_fetch_array($qry2))
{
	$sender = $row['fname'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Compose Message</title>
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
				<?php echo strtoupper(substr($sender, 0, 1)); ?>
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
					<a href="compose2.php" class="nav-link active">
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
					<i class="fas fa-edit card-icon"></i>
					Compose New Message
				</h3>
				
				<form action="msgcomp.php" method="post" class="message-form">
					<input name="sender" type="hidden" value="<?php echo $staff_id; ?>" />
					
					<div class="form-grid">
						<div class="form-group">
							<label for="rid">
								<i class="fas fa-id-card"></i>
								Recipient ID
							</label>
							<input type="text" name="rid" id="rid" placeholder="Enter recipient staff ID" />
						</div>

						<div class="form-group">
							<label for="recipient">
								<i class="fas fa-user-friends"></i>
								To (Staff Name)
							</label>
							<select name="receipient" id="recipient" required>
								<option value="" selected>Select recipient</option>
								<?php
								if(mysqli_num_rows($qry1)){
									while($rs = mysqli_fetch_array($qry1)){
										echo '<option value="'.$rs['fname'].'">'.$rs['fname'].' (ID: '.$rs['staff_id'].')</option>';
									}
								}
								?>
							</select>
						</div>

						<div class="form-group full-width">
							<label for="subject">
								<i class="fas fa-tag"></i>
								Subject
							</label>
							<input type="text" name="subject" id="subject" placeholder="Enter message subject" required />
						</div>

						<div class="form-group full-width">
							<label for="message">
								<i class="fas fa-comment"></i>
								Message
							</label>
							<textarea name="message" id="message" rows="8" placeholder="Type your message here..." required></textarea>
						</div>
					</div>

					<div class="form-actions">
						<button type="submit" name="submit" id="submit" class="btn">
							<i class="fas fa-paper-plane"></i>
							Send Message
						</button>
						<a href="inbox.php" class="btn" style="background: #718096; display: flex; align-items: center; gap: 8px;">
							<i class="fas fa-arrow-left"></i>
							Back to Inbox
						</a>
					</div>
				</form>
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
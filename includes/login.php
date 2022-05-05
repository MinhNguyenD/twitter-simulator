<?php
	ob_start(); 
	session_start();

	require_once "includes/db.php";
	// Process login form submission
	if (isset($_REQUEST['submit-login'])) {
			// (1) Verify if token is valid
		if ($_REQUEST['token-input'] == $_SESSION['token']) {
			// (2) Verify user name and password
			$userEmail= sanitizeData($_REQUEST['email-login']);
			$userPassword = sanitizeData($_REQUEST['password-login']);
			$sql = "SELECT * FROM cb_login WHERE cb_login_email = '$userEmail' AND cb_login_password = '$userPassword' ";
			$result = $db->query($sql);
			$row = $result->fetch_assoc();
			
			
			
			$userID = $row['cb_login_id'];
			$count = mysqli_num_rows($result);
			
			$sql2= "SELECT * FROM cb_users WHERE cb_user_id = '$userID'";
			$result2 = $db->query($sql2);
			$row2 = $result2->fetch_assoc();

 		
			if($count == 1){
				// (3) If user name and password combination is correct and valid, regenerate session ID.
				session_regenerate_id();

				// (4) Update session variable
				$_SESSION['useremail'] = $row['cb_login_email']; 
				$_SESSION['username'] = $row2['cb_user_firstname']." ".$row2['cb_user_lastname'];
				$_SESSION['password'] = sanitizeData($_REQUEST['password-login']);
				$_SESSION['userid'] = $row2['cb_user_id'];
			}
			header("Location: index.php");

		}
	}
	ob_end_flush(); 
	
?>
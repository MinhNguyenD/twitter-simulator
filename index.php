<?php
    // Starter file for A3 in CSCI 2170 
    require_once "includes/functions.php";
	require_once "includes/db.php"; 
	require_once "includes/header.php";
    require_once "includes/login.php";

?> 

	<?php
		if (isset($_SESSION['username'])) {
	?>
	
			<nav> 
				<h2>Hello, <?php echo $_SESSION['username']; ?></h2>
				<p><a href="includes/logout.php">Logout</a></p>
				<p><a href="profile.php">Profile</a></p>
			</nav>		
		</header>
		<main class="pg-main-content">

	<?php
			for($postid = 3; $postid < 16; $postid++){
				$index = $postid-3;  					
				if(isset($_REQUEST["like$index"])){
						$sql4 = "UPDATE cb_posts SET cb_post_likes=cb_post_likes+1 where cb_post_id = $postid"; 
						$result4 = $db->query($sql4); 
				}

				if(isset($_REQUEST["report$index"])){
					$sql5 = "UPDATE cb_posts SET cb_post_report=1 where cb_post_id = $postid"; 
					$result5 = $db->query($sql5); 
					$userid = $_SESSION['userid'];
					$sql6 = "INSERT INTO cb_reported_posts (cb_reported_post_id, cb_reported_by_user_id, cb_reported_post_status) VALUES ($postid,$userid, 'reported')";
					$result6 = $db->query($sql6); 
				}
			}


			$sql3= "SELECT * FROM cb_posts";
			$result3 = $db->query($sql3);
			if($result3->num_rows>0){
				$i = 0; 
				while($row3 = $result3->fetch_assoc()){
					$numLike = $row3['cb_post_likes'];

					echo "  <div class = 'post'>
								<p>". $row3['cb_post_content']." </p>";
					
								
					
					echo "<a href='index.php?like$i=1'>$numLike Like</a>";
					
					
					if( $row3['cb_post_report'] == 0){
						echo" 
								<a href='index.php?report$i=1'>Report</a> 
							"; 
					}	
					else{
						echo "
							<p class ='message'>This post has been reported for community guideline violation. </p>
						";
					}

					echo "</div>"; 
					$i = $i + 1; 
				}
			}




		}
		
		else {
	?>
		<nav> 
			<h2>Hello! Please login to continue</a>!</h2>
		</nav>
	</header> 
	<main class="pg-main-content">
	<?php
			$_SESSION['token'] = hash("sha3-512", session_id());
	?>
		<form id = "form-login" name = "user-login" method = "post" action = "index.php"> 
				<label for="email">Email</label>
				<input name="email-login" type="email" id="email" placeholder="email@example.com">
				<label for="password">Password</label>
				<input name="password-login" type="password" id="password">
				<input type="submit" name="submit-login" value= "Log in">
				<input type="hidden" name="token-input" value="<?php echo $_SESSION['token'];?>">
		</form>


	<?php
		}
	?>
	</main>	

<?php 
	require_once "includes/footer.php"; 
?> 


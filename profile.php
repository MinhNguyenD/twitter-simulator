<?php
    require_once "includes/functions.php";
	require_once "includes/db.php"; 
	require_once "includes/header.php";
    require_once "includes/login.php";

?> 
		    <nav> 
				<h2>Hello, <?php echo $_SESSION['username']; ?></h2>
				<p><a href="includes/logout.php">Logout</a></p>
				<p><a href="profile.php">Profile</a></p>
			</nav>		
		</header>


		<main class="pg-main-content">
            <div> 
                <img src="img/profile.png" alt="Profile pic" width="200" height="200">

                <p> User's Name: <?php echo $_SESSION['username']; ?> </p>
                <p> User's Email: <?php echo $_SESSION['useremail']; ?> </p>
                <p> User's Role: 
                    <?php 
                    if($row2['cb_user_role'] == 1){
                        echo "User";
                    }
                    else{
                        echo "Adminstrator";
                    }
                    ?>

            </div>
    
    
        </main>
<?php 
	require_once "includes/footer.php"; 
?> 

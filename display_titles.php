<?php

function displayLoginMenu()
{
	echo "<div class='topnav'>";		 
	echo "<a href='index.html' class='title_links active' style='background-color: #4CAF50;'> Login </a>" ;
	echo "</div>";

}

function displayLoginScreen()
{
	echo "<center>" ;
        echo "<h3> Login </h3>";

        echo "<label for='name' class='required'> User Id: </label>";
        echo "<input type='text' id='name' name='name' placeholder='Enter user id' style='margin-left: 4px;' required><br/>";

        echo "<label for='password' class='required'> Password: </label>";
        echo "<input type='password' id='password' name='password' placeholder='Enter password' required><br/>";

        echo "<button type='reset' id='reset_1'> Cancel </button>";
        echo "<button type='submit' id='submit_1'> Submit </button><br/><br/>";
        echo "<a href='index.html' id='forgotpwd'> Forgot Password? </a>";
	echo "</center>";
}

function displayAdminMenu ($loginId)
{
	echo "<div class='topnav'>";		 
	//echo "<a href='index.html' class='title_links active' style='background-color: #4CAF50;'> Login </a>" ;
	echo "<div class='dropdown'>
				<button class='dropbtn'>User
					<i class='fa fa-caret-down'></i>
				</button>
				<div class='dropdown-content'>
					<a href='User-Create.php?name=$loginId' class='title_links' style='color:green;'> Create User </a>
					<a href='User-Delete.php?name=$loginId' class='title_links' style='color:green;'> Delete User </a> 
					<a href='Password-Modify.php?name=$loginId' class='title_links' style='color:green;'> Change My Password </a> 
					<a href='index.html' class='title_links' style='color:green;'> logout </a> 
				</div>
		</div>
		<div class='dropdown'>
				<button class='dropbtn'>Sector
					<i class='fa fa-caret-down'></i>
				</button>
				<div class='dropdown-content'>
					<a href='Sector-Create.php?name=$loginId' class='title_links' style='color:green;'> Create Sector </a>
					<a href='Sector-Delete.php?name=$loginId' class='title_links' style='color:green;'> Delete Sector </a> 
				</div>
		</div>

		<a href='Get_Reliable_Twitteratis.php?name=$loginId' style='color:white;'> Get-Reliable-Twitteratis </a>

		<div class='rname'> Welcome Admin </div>
</div>
";
}

function displayCustomerMenu ($loginId)
{
	echo "<div class='topnav'>";		 
	//echo "<a href='index.html' class='title_links active' style='background-color: #4CAF50;'> Login </a>" ;
	echo "<div class='dropdown'>
						<button class='dropbtn'>User
							<i class='fa fa-caret-down'></i>
						</button>
						<div class='dropdown-content'>
							<a href='Password-Modify.php?name=$loginId' class='title_links' style='color:green;'> Change My Password </a> 
							<a href='index.html' class='title_links' style='color:green;'> logout </a> 
						</div>
				</div>

		<a href='Get_Trade_Suggestions.php?name=$loginId' style='color:white;'> Get-Trade-Suggestions </a>
		<div class='rname'> Welcome Customer : $loginId </div>
</div>
";
	
}


?>
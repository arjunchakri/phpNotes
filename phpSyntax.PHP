
<?php
	__macros

define('SERVER', 'localhost');
define('USERNAME', 'root');
$_POST['submit'] //button
$username = ($_POST['username']); //username is name of textbox

	__embeddingphpfile
include 'connection.php';

	__SeSSIONS and FUNCTIONS
	session_start();
	session_close();
	session_destroy();
	isset( < varname >);

	__gensyntax

@mysql_connect("localhost", "root", "") or die("Connection problem");
mysql_select_db("attendance_db") or die("Attendance database not found");
$username = ($_POST['username']);
$password = ($_POST['password']);
a) querying: checking 
	$sql = "SELECT id,username, password FROM users WHERE username='$username' ";
	$query = mysql_query($sql) or die("You lose");
	if ($query)
		{
		$row = mysql_fetch_row($query);
		$userId = $row[0];
		$dbusername = $row[1];
		$dbpassword = $row[2];
		if ($username == $dbusername && $password == $dbpassword)
			{
			$_SESSION['username'] = $username;
			$_SESSION['id'] = $userId;
			echo "<script> window.location.href='home.php'; </script>";
			}
		  else
			{
			echo "<span style='color:red;'>User name or password is incorrect!</span>";
			}
		}
	  else
		{
		echo "<span style='color:red;'>User name doesnt exist</span>";
		} 
	
	
	__logout
	session_destroy();
	header("Location:login.php");
	exit();
	
	b) querying: updating / registering 
		$stid = $_POST['stid'];
		$subj = $_POST['subjid'];
		$atten = $_POST['present'];
		$date = date('Y-m-d H:i:s');
		$query = mysql_query("Insert into `table` (`StudentRollNumber`,`SubjectId`,`Attendence`,`date`)VALUES('$stid','$subj','$atten','$date')");
		if ($query)
			{
			echo "Success";
			}

		__objOrientedsyntax $mysqli = new mysqli(SERVER, USERNAME, PASSWORD, DATABASE);
		c) querying: scanningtable(withgroupby) 
			$query3 = $mysqli->query("Select * from tbl_attendence group by per asc");
			while ($row = mysqli_fetch_row($query3))
				{
				echo "<tr>";
				echo '<td>' . $row[1] . '</td>';
				echo '<td>' . $row[2] . '</td>';
				echo '<td>' . $row[3] . '</td>';
				echo '<td>' . $row[4] . '</td>';
				echo "</tr>";
				}

			d) Examplerandom
			
			if (isset($_SESSION["email_id"]))
				{
				echo "<script>window.history.back()</script>";
				}

			if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit']))
				{
				$email = mysqli_real_escape_string($mysqli, $_POST["userid"]);
				$pass = mysqli_real_escape_string($mysqli, $_POST["password"]);
				$query = "select * from faculty where email_id='$email' and password='$pass'";
				$res = $mysqli->query($query);
				if ($res)
					{
					$row = mysqli_fetch_row($res);
					$count = mysqli_num_rows($res);		////number of rows
					if ($count == 1)
						{
						$_SESSION["email_id"] = $email;
						$_SESSION["faculty_id"] = $row[0];
						$f = $_SESSION['faculty_id'];
						if ($email == ADMIN)
							{
							echo "<script>
                    window.location.href='admin.html'
                        </script>";
							}
						  else
							{
							echo "<script>
                    window.location.href='home.html'
                        </script>";
							}
						}
					}
				  else
					{
					echo "<script>alert('Invalid Login Credentials!!!');window.location.href='login.html'</script>";
					}
				}


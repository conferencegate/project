<?php
// Define variables and initialize with empty values
$username = $password = $confirm_password = $firstname = $lastname = $organization = $discipline = $email = "";
$username_err = $password_err = $confirm_password_err = $firstname_err = $lastname_err= $email_err = $discipline_err = $organization_err = "";

	// Create connection
	$servername = "localhost";
	$user = "root";
	$pass = "mysql";
	$database = "ConferenceGate";
	$link = new mysqli($servername, $user, $pass, $database);
	// Check connection
	if ($link->connect_error) {
	    die("Connection failed: " . $link->connect_error);
	} 
//	echo "<p><font color=\"red\">Connected successfully</font></p>";

 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validate username
    if(empty(trim($_POST["username"]))){
        $username_err = "Enter a username.";
    } else{
        // Prepare a select statement
        $sql = "SELECT userID FROM Attendee WHERE username = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Set parameters
            $param_username = trim($_POST["username"]);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $username_err = "This username is already taken.";
                } else{
                    $username = trim($_POST["username"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
         
        // Close statement
        mysqli_stmt_close($stmt);
    }

    // firstname check
    if(empty(trim($_POST["firstname"]))){
        $firstname_err = "Please enter a first name.";     
    } else{
        $firstname = trim($_POST["firstname"]);
    }

    // lastname check
    if(empty(trim($_POST["lastname"]))){
        $lastname_err = "Please enter a last name.";     
    } else{
        $lastname = trim($_POST["lastname"]);
    }

    // organization check
    if(empty(trim($_POST["organization"]))){
        $organization_err = "Please enter an organization or 'Self'.";     
    } else{
        $organization = trim($_POST["organization"]);
    }

    // discipline check
    if(empty(trim($_POST["discipline"]))){
        $discipline_err = "Please enter a discipline.";     
    } else{
        $discipline = trim($_POST["discipline"]);
    }

    // Email check
    if(empty(trim($_POST["email"]))){
        $email_err = "Please enter an e-mail address.";     
    } else{
        $email = trim($_POST["email"]);
    }
    
    // Validate password
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter a password.";     
    } elseif(strlen(trim($_POST["password"])) < 6){
        $password_err = "Password must have at least 6 characters.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Please confirm password.";     
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "Password did not match.";
        }
    }
    
    // Check input errors before inserting in database
    if(empty($username_err) && empty($password_err) && empty($confirm_password_err)){
        
        // Prepare an insert statement
        $sql = "INSERT INTO Attendee (firstname, lastname, discipline, organization, email, username, password) VALUES (?, ?, ?, ?, ?, ?, ?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sssssss", $param_firstname, $param_lastname, $param_discipline, $param_organization, $param_email, $param_username, $param_password);
            
            // Set parameters
            $param_firstname = $firstname;
            $param_lastname = $lastname;
            $param_discipline = $discipline;
            $param_organization = $organization;
            $param_email = $email;
            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash

            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Redirect to login page
                header("location: 3_login.php");
            } else{
                echo "Something went wrong. Please try again later.";
            }
        }
         
        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Close connection
    mysqli_close($link);
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign Up</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body{ font: 14px sans-serif; }
        .wrapper{ width: 350px; padding: 20px; }
    </style>
</head>
<body>
    <div class="wrapper">
        <h2>Sign Up</h2>
        <p>Please fill this form to create an account.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        	<div class="form-group <?php echo (!empty($firstname_err)) ? 'has-error' : ''; ?>">
                <label>First Name</label>
                <input type="text" name="firstname" class="form-control" value="<?php echo $firstname; ?>">
                <span class="help-block"><?php echo $firstname_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($lastname_err)) ? 'has-error' : ''; ?>">
                <label>Last Name</label>
                <input type="text" name="lastname" class="form-control" value="<?php echo $lastname; ?>">
                <span class="help-block"><?php echo $lastname_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($discipline_err)) ? 'has-error' : ''; ?>">
                <label>Discipline</label>
                <input type="text" name="discipline" class="form-control" value="<?php echo $discipline; ?>">
                <span class="help-block"><?php echo $discipline_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($organization_err)) ? 'has-error' : ''; ?>">
                <label>Organization</label>
                <input type="text" name="organization" class="form-control" value="<?php echo $organization; ?>">
                <span class="help-block"><?php echo $organization_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>">
                <label>E-Mail Address</label>
                <input type="text" name="email" class="form-control" value="<?php echo $email; ?>">
                <span class="help-block"><?php echo $email_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                <label>Username</label>
                <input type="text" name="username" class="form-control" value="<?php echo $username; ?>">
                <span class="help-block"><?php echo $username_err; ?></span>
            </div>    
            <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <label>Password</label>
                <input type="password" name="password" class="form-control" value="<?php echo $password; ?>">
                <span class="help-block"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
                <label>Confirm Password</label>
                <input type="password" name="confirm_password" class="form-control" value="<?php echo $confirm_password; ?>">
                <span class="help-block"><?php echo $confirm_password_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit">
                <input type="reset" class="btn btn-default" value="Reset">
            </div>
            <p>Already have an account? <a href="3_login.php">Login here</a>.</p>
        </form>
    </div>    
</body>
</html>
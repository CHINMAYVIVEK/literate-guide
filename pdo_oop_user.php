<?php
include_once 'Database.class.php';

class Users extends Database
{
//login by user
    public function login($email, $pwd)
    {
        $sql = "SELECT * FROM 
        airo_users 
        WHERE 
        user_email = :user_email";
        
        $stmt = $this->conn->prepare($sql);

        //Bind value.
        $stmt->bindValue(':user_email', $email);

        //Execute.
        $stmt->execute();

        //Fetch row.
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        //If $row is FALSE.
        if ($user === false) {
            //Could not find a user with that username!
            //PS: You might want to handle this error in a more user-friendly manner!
            //die('Incorrect username / password combination!');
            echo '<script type="text/javascript">';
            echo 'alert(" Incorrect Username or Password");';
            echo 'window.location.href = "index.php";';
            echo '</script>';
        } else {
            //User account found. Check to see if the given password matches the
            //password hash that we stored in our users table.

            //Compare the passwords.
            $validPassword = password_verify($pwd, $user['user_password']);

            //If $validPassword is TRUE, the login has been successful.
            if ($validPassword) {
                session_start();
                //Provide the user with a login session.
                $_SESSION['user_id'] = $user['user_id'];
                $_SESSION['user_name'] = $user['user_name'];
                $_SESSION['user_email'] = $user['user_email'];
                $_SESSION['logged_in'] = time();

                //Redirect to our protected page, which we called home.php
                //header('Location: dashboard.php');
                echo '<script type="text/javascript">';
                echo 'alert("Login Successfull");';
                echo 'window.location.href = "dashboard.php";';
                echo '</script>';
                exit;

            } else {
                //$validPassword was FALSE. Passwords do not match.
               // die('Incorrect username / password combination!');
                echo '<script type="text/javascript">';
                echo 'alert(" Login Unsuccessfull please check username or password");';
                echo 'window.location.href = "index.php";';
                echo '</script>';
            }
        }

    } // login ends

    public function registration($name,$email, $pwd1, $pwd2){
        //Construct the SQL statement and prepare it.
        $sql = "SELECT COUNT(user_email) AS num FROM airo_users WHERE user_email =:user_email";
        $stmt = $this->conn->prepare($sql);

        //Bind the provided username to our prepared statement.
        $stmt->bindValue(':user_email', $email);

        //Execute.
        $stmt->execute();

        //Fetch the row.
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        //If the provided username already exists - display error.
        //TO ADD - Your own method of handling this error. For example purposes,
        //I'm just going to kill the script completely, as error handling is outside
        //the scope of this tutorial.
        if($row['num'] > 0){
           // die('That username already exists!');
            echo '<script type="text/javascript">';
            echo 'alert("That username already exists");';
            echo 'window.location.href = "dashboard.php";';
            echo '</script>';
        }
        else{
            if(strcmp($pwd1,$pwd2)==0){

                //Hash the password as we do NOT want to store our passwords in plain text.
                $passwordHash = password_hash($pwd1, PASSWORD_BCRYPT, array("cost" => 12));
                $level = 0; // default user
                $status = 0; // default inactive
                $code = bin2hex(mt_rand(0,10000000)); // verification code
                $code = password_hash($code,PASSWORD_DEFAULT); // code hased

                //Prepare our INSERT statement.
                //Remember: We are inserting a new row into our users table.
                $sql = "INSERT INTO airo_users (user_name, user_email, user_password, user_level, user_status, user_code, user_img, user_mobile_number, user_antername_mobile_numbaer)
                    VALUES (:user_name, :user_email, :user_password, :user_level, :user_status, :user_code, :user_img, :user_mobile_numbaer, :user_antername_mobile_number)";
                $stmt = $this->conn->prepare($sql);


                //Bind our variables.
                $stmt->bindValue(':u_name', $name);
                $stmt->bindValue(':u_email', $email);
                $stmt->bindValue(':u_pwd', $passwordHash);

                $stmt->bindValue(':u_level', $level);
                $stmt->bindValue(':u_status', $status);
                $stmt->bindValue(':u_code', $code);

                //Execute the statement and insert the new account.
                $result = $stmt->execute();
                return $result;

            }

            else{
                // die('Password not matched !!!');
                echo '<script type="text/javascript">';
                echo 'alert("Password Not Matched");';
                echo 'window.location.href = "dashboard.php";';
                echo '</script>';
            }
        } // no row found

    } // registration ends
    
    public function logOut(){
        session_destroy();
        unset($_SESSION['user_id']);
        unset($_SESSION['user_name']);
        unset($_SESSION['user_email']);
        unset($_SESSION['logged_in']);
        header("Location: index.php");
    
        return true;
    }

    public function userRole(){
         $stmt = $conn->prepare("SELECT 
            u.up_id, u.up_title, u.up_content, u.up_img, u.u_id, u.cat_id,u.up_date,u.up_upload,
            c.cat_name ,usr.u_name 
            FROM 
            upload AS u 
            LEFT JOIN 
            category AS c 
            ON 
            u.cat_id = c.cat_id 
            LEFT JOIN 
            user AS usr 
            ON 
            u.u_id = usr.u_id 
            WHERE 
            u.up_id = $upl_id
            ");
                $stmt->execute();
                foreach ($stmt as $key => $value) {

    }
    
}

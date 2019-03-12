<?php
include_once 'class/User.php';
include_once 'class/DB.php';
$user = new User();
$DB = new DB();

if(isset($_POST['sign_up'])){
    $name = !empty($_POST['namesurname']) ? trim($_POST['namesurname']) : null;
    $email = !empty($_POST['email']) ? trim($_POST['email']) : null;
    $pwd1 = !empty($_POST['password']) ? trim($_POST['password']) : null;
    $pwd2 = !empty($_POST['confirm']) ? trim($_POST['confirm']) : null;

$name = $user->cleanData($name);
$email = $user->cleanData($email);
$pwd1 = $user->cleanData($pwd1);
$pwd2 = $user->cleanData($pwd2);
$result = $user->registration($name,$email,$pwd1,$pwd2); // user Registration
if($result){
echo '<script type="text/javascript">';
     echo 'alert("User Registration Successfull");';
     echo 'window.location.href = "dashboard.php";';
     echo '</script>';
}
else{
    echo '<script type="text/javascript">';
    echo 'alert(" Registration Unsuccessfull");';
    echo 'window.location.href = "dashboard.php";';
    echo '</script>';
}
}

if ((isset($_REQUEST['who_we_are']))){
    $content = $_POST['editor1'];
    $fil_name = "who_we_are.txt";
    $send = $DB->write_to_file($content,$fil_name);
    if($send){
        echo '<script type="text/javascript">';
        echo 'alert("Content Posted Successfully");';
        echo 'window.location.href = "dashboard.php";';
        echo '</script>';
    }
    else{
        echo '<script type="text/javascript">';
        echo 'alert("content not updated");';
        echo 'window.location.href = "dashboard.php";';
        echo '</script>';
    }
}

if ((isset($_REQUEST['what_we_do']))){
    $content = $_POST['editor2'];
    $fil_name = "what_we_do.txt";
    $send = $DB->write_to_file($content,$fil_name);
    if($send){
        echo '<script type="text/javascript">';
        echo 'alert("Content Posted Successfully");';
        echo 'window.location.href = "dashboard.php";';
        echo '</script>';
    }
    else{
        echo '<script type="text/javascript">';
        echo 'alert("content not updated");';
        echo 'window.location.href = "dashboard.php";';
        echo '</script>';
    }
}

?>

<form  method="post" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>">
                                <textarea name="editor2" id="editor2" rows="10" cols="80">
                                    <?php echo file_get_contents("what_we_do.txt"); ?>
                                </textarea>
                                <button class="btn btn-block btn-lg bg-blue waves-effect" type="submit" name="what_we_do">POST</button>
                            </form>

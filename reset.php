<?php
session_start();
include 'head.php';
include 'data.php';

//session_start();
if($_SERVER['REQUEST_METHOD']=="POST"){
    if(isset($_POST['reset'])){
        if(empty($_POST['resetmatric'])||empty($_POST['resetpass'])||empty($_POST['resetconfirm'])){
            $error[]="fields cannot be empty";
        }else{
            $resetmatric= mysqli_real_escape_string($db,$_POST['resetmatric']);
            $resetpass=md5($_POST['resetpass']);
            $resetconfirm=md5($_POST['resetconfirm']);
            $user_check="SELECT * FROM register WHERE matric = '$resetmatric'";
            $check=$db->query($user_check);
            $usr=$check->fetch_array(MYSQLI_ASSOC);
            if($usr){
                if($usr['matric']===$resetmatric){
                    if($resetpass!=$resetconfirm){
                        $error[]="password does not match";
                    }else{
                        $update="UPDATE register SET pass ='$resetpass' WHERE matric ='$resetmatric'";
                        $db->query($update);
                        $error[]="wow";
                        header("location:signin.php");
                    }
                }
            }
        }

    
    }
}


?>


<div class="container bg-warning bg-opacity-10 border rounded justify-content-center">
    <p class="h1 text-center text-dark">Reset password</p>
    <?php
    if(isset($error)){
        foreach($error as $error){
            echo"<span class=text-danger>.$error.</span>";
        }
    }
    ?>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
    <label class="form-label">Enter Matric NO:</label>
    <input type="text" class="form-control bg-secondary form-control-lg bg-opacity-10" name="resetmatric" placeholder="Enter Matric NO">
    <label class="form-label">New password:</label>
    <input type="password" class="form-control bg-secondary form-control-lg bg-opacity-10" name="resetpass" placeholder="Enter new password">
    <label class="form-label">Confirm New password:</label>
    <input type="password" class="form-control bg-secondary form-control-lg bg-opacity-10" name="resetconfirm" placeholder="Confirm new password">
    <br/>
    <input type="submit" class="btn btn-info" name="reset" value="reset">
    </form>
</div>

























<?php include 'footer.php'?>
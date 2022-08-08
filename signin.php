<?php 
session_start();
include 'head.php';
include 'data.php';


if($_SERVER["REQUEST_METHOD"]=="POST"){
    if(empty($_POST['lpassword'])||empty($_POST['lmatric'])){
       $error[]='fill the fields';
    }else{
        $mymatric = mysqli_real_escape_string($db,$_POST['lmatric']);
        $mypassword=md5($_POST['lpassword']);
        $que ="SELECT id FROM register WHERE matric='$mymatric' AND pass='$mypassword'";
        $raw=$db->query($que);
        $row= $raw->fetch_array(MYSQLI_ASSOC);
        //$active=$row['active'];
        $cont=mysqli_num_rows($raw);
        if($cont==1){
           // session_register("mymatric");
            $_SESSION['login_user']=$mymatric;
            //$error[]="wow";
            header("location:library cms.html");
        }else{
            $error[]="incorrect password or matric NO";
        }

    }
}
?>


<div class ="container bg-warning bg-opacity-10 border rounded justify-content-center">
    <p class="h1 display text-dark text-center">E-library Login</p>
    <?php
    if(isset($error)){
        foreach($error as $error){
            echo"<span class=text-danger>.$error.</span>";
        }
    }
    ?>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" class="mb-3">
        <label for="matric1"class="form-label">Enter Matric NO:</label>
        <input type="text" name="lmatric" id="matric1" class="form-control bg-secondary form-control-lg bg-opacity-10" placeholder="Matric NO">
        <label for="password1" class="form-label">Enter Password</label>
        <input type="password"  name="lpassword"class="form-control bg-secondary form-control-lg bg-opacity-10" placeholder="Enter Password">
</br>
        <div class="btn-group">
            <button class="btn btn-success" name ="login">Login</button>
            <a href="registration.php" class="btn btn-warning">Register</a>
            <a href="reset.php" class="btn btn-danger">forgot password?</a>
        </div>
    </form>
</div>

<?php include 'footer.php'?>
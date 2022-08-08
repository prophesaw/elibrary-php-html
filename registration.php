<?php 
include 'head.php';
include 'data.php';



if($_SERVER["REQUEST_METHOD"]=="POST"){
    if(empty($_POST['matric'])||empty($_POST['password'])||empty($_POST['confirm'])){
        $error[]='all field must be field';
    }else{
        $matric=mysqli_real_escape_string($db,$_POST['matric']);
        $password=md5($_POST['password']);
        $confirm=md5($_POST['confirm']);
        $check_user ="SELECT * FROM register WHERE matric = '$matric'";
        $res = $db->query($check_user);
        $user = $res->fetch_array(MYSQLI_ASSOC);
        if($user['matric']===$matric){
            $error[]="matric has been registered";
        }else{
             $put ="INSERT INTO register (matric,pass) VALUES('$matric','$password')";
             $db->query($put);
             //$error[]="wow";
             header ("location:signin.php");
        }
        
    }

}


?>

<div class ="container bg-warning bg-opacity-10 border rounded justify-content-center">
    <p class="h1 display text-dark text-center">E-LIBRARY Registration Page</p>
    <?php
    if(isset($error)){
        foreach($error as $error){
            echo"<span class=text-danger>.$error.</span>";
        }
    }
    ?>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" class="mb-3">
        <label for="matric" class="form-label">Matric NO:</label>
        <input type="text" name="matric" id="matric" class="form-control bg-secondary form-control-lg bg-opacity-10" placeholder="Enter Matric NO">
        <label for="password" class="form-label">Password:</label>
        <input type="password" name="password" class="form-control bg-secondary form-control-lg bg-opacity-10" placeholder="Enter password">
        <label for="password1" class="form-label">Confirm password:</label>
        <input type="password" id="password1" class="form-control form-control-lg bg-secondary bg-opacity-10" name ="confirm" placeholder="Confirm password">
</br>
        <div class="btn-group">
            <input type="submit" class="btn btn-warning" value="Register" name="register">
            <a href="signin.php" class="btn btn-success">I have account</a>
        </div>
    </form>
</div>




<?php include 'footer.php';?>
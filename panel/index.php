<?php 
    include("config/init.php");
    if(checkLogin() == true){
        header("Location: home.php");
    } 
?>
<?php 
    include("config/header.php");
    if(checkLogin() == false){
        if(checkRegister() == false){
            include("state/sign_in.php");
        }else{
            include("state/sign_up.php");
        }
    }else{
        include("state/home.php");
    }
    include("config/footer.php");
?>

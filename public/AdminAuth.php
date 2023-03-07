<?php
    $root = ($_SERVER["DOCUMENT_ROOT"]);
    require $root."/../vendor/autoload.php"; 
    use App\Handlers\RequestHandler\RequestHandler;
    use App\Util\Injectors\StyleInjector\StyleInjector;

    $rh = new RequestHandler();
    $styleInjector = new StyleInjector();

    if(isset($_POST['admin-login-username']) && !empty($_POST['admin-login-username']) &&
       isset($_POST['admin-login-password']) && !empty($_POST['admin-login-password'])){
           $username = $_POST['admin-login-username'];
           $password = $_POST['admin-login-password'];
           $args = array('admin-username' => $username, 'admin-password' => $password);
           $adminLogin = $rh->request('admin-auth', $args);
           session_start();
           $_SESSION['isAdminLoggedIn'] = $adminLogin;
           session_write_close();
           if($adminLogin){
                echo '<meta http-equiv="refresh" content="0; URL=http://www.mioguzellik.com/AdminDashboard.php">';
           }
           else{
               echo "Admin girişi başarısız, yanlış kullanıcı adı veya şifre.";
           }
       }
    
?>

<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <?php echo $styleInjector->inject('AdminAuthStyle');?>
</head>

<body>

</body>

</html>



<form action="AdminAuth.php" method="post" class="admin-login-form">
    <div class="admin-login-username-container">
        <input type="text" name="admin-login-username" placeholder="Username">
    </div>
    <div class="admin-login-password-container">
        <input type="password" name="admin-login-password" placeholder="Password">
    </div>
    <div class="admin-login-submit-container">
        <input type="submit" value="LOGIN" name="admin-login-submit">
    </div>
</form>
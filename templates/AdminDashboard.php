<?php
    session_start();
    if(isset($_SESSION['isAdminLoggedIn']) && !empty($_SESSION['isAdminLoggedIn']) && $_SESSION['isAdminLoggedIn']){

    }
    else{
        echo "You are not an authenticated admin. Returning to homepage...";
        $startTime = hrtime(false);
        while(true){
            $currentTime = hrtime(false);
            
            // redirect to homepage if 3 seconds has passed 
            if( ($currentTime[0] - $startTime[0]) >= 3){
                echo '<meta http-equiv="refresh" content="0; URL=http://www.mioguzellik.com/Index.php">';
                break;
            }
        }
    }
?>
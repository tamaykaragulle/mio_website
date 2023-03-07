<?php
    $root = ($_SERVER["DOCUMENT_ROOT"]);
    require $root."/../vendor/autoload.php"; 
    use App\Handlers\RequestHandler\RequestHandler;
    use App\Util\Injectors\StyleInjector\StyleInjector;
    use App\Util\Injectors\ScriptInjector\ScriptInjector;
    use App\Util\Helpers\URLHelpers\ImageURLHelper\ImageURLHelper;
    $rh = new RequestHandler();
    $styleInjector = new StyleInjector();
    $scriptInjector = new ScriptInjector();
    $helper = new ImageURLHelper();

    $activeContainerType = "none";
    $activeItemType = "none";

    if ( isset($_POST['service-filter-add-button']) && $_POST['service-filter-add-button']=="add" ){
        $activeContainerType = 'add';
        $activeItemType = 'service';
    }
    elseif( isset($_POST['contact-filter-add-button']) && $_POST['contact-filter-add-button'] == 'add'){
        $activeContainerType = 'add';
        $activeItemType = 'contact';
    }
    elseif( isset($_POST['swiper-filter-add-button']) && $_POST['swiper-filter-add-button'] == 'add'){
        $activeContainerType = 'add';
        $activeItemType = 'swiper';
    }

    if( isset($_POST['service-image-file']) && !empty($_POST['service-image-file']) ){
        $_FILES['service-image-file'] = $_POST['service-image-file'];
    }


    session_start();
    if(!isset($_SESSION['isAdminLoggedIn']) || empty($_SESSION['isAdminLoggedIn']) || !$_SESSION['isAdminLoggedIn']){
        //echo "Admin oturumu bulunamadı, anasayfaya dönülüyor...";
        session_write_close();
        //echo '<meta http-equiv="refresh" content="0; URL=http://www.mioguzellik.com/Index.php">'; 
        //exit();
    }
    session_write_close();
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <?php 
        echo $styleInjector->inject("Fonts");
        echo $styleInjector->inject("AdminDashboardStyle"); 
    ?>
</head>
<body>

    <?php echo $scriptInjector->inject("AdminDashboard"); ?>
    <div class="menu">
        <button onclick="switchBoard('contacts')">
            <span>İletişim Kartları</span>
        </button>
        <button onclick="switchBoard('services')">
            <span>Hizmetler</span>
        </button>
        <button onclick="switchBoard('swiper')">
            <span>Swiper Resimleri</span>
        </button>
    </div>

    <div class="admin-board" id="admin-contacts-board">
        <nav class="admin-nav">
            <h1>
                İletişim Kartları
            </h1>
        </nav>
        <content>

        </content>
    </div>

    <div class="admin-board show" id="admin-services-board">
        <nav class="admin-nav">
            <h1>
                Hizmetler
            </h1>
            
            <form method="post" action="AdminDashboard.php" class="service-filter-form">
                <div class="col">
                    <input name="filter-min-price" type="number" step="0.01" min="0" max="999999" placeholder="Min Fiyat">
                    <span>---</span>
                    <input name="filter-max-price" type="number" step="0.01" min="0" max="999999" placeholder="Max Fiyat">
                </div>
                
                <div class="col">
                    <input name="filter-min-date" type="date">
                    <span>---</span>
                    <input name="filter-max-date" type="date">
                </div>
                <div class="col">
                    <input placeholder="İsim / Başlık" name="filter-title" type="text">
                </div>
                <div class="col">
                    <button type="submit" name="service-filter-add-button" value="add" formmethod="post" class="service-add-button">
                        <span>EKLE</span>
                    </button>
                    <button type="submit" name="service-filter-search-button" value="filter" formmethod="post" class="service-filter-button">
                        <span>ARA</span>
                    </button>
                </div>
        </nav>

        <content>   
            <?php 
                $helper->setMode('Services');
                $services = $rh->request("get-service-list");
                for($i = 0; $i < count($services); $i++){
                    $service = $services[$i];
                    echo "<div class='service-container' id='service-$i'>";
                        echo "<img src='".$helper->get($service['image'])."' alt='".$service['title']." image'>";
                        
                        echo "<div class='service-row-1'>";
                            echo "<h3 class='service-title'>";
                                echo $service['title'];
                            echo "</h3>";
                            echo "<h5 class='service-price'> ";
                                echo $service['price']." TL";
                            echo "</h5>";
                        echo "</div>";
                        echo "<div class='service-row-2'>";
                            echo "<span>".$service['description']."</span>";
                        echo "</div>";
                    
                    echo "</div>";
                }  
            ?>



        </content>
    </div>
    

    <div class="admin-board" id="admin-swiper-board">
        <nav class="admin-nav">
            <h1>
                Swiper Resimleri
            </h1>
        </nav>
        <content>
        
        </content>
    </div>

    <?php if($activeItemType == 'service' || $activeItemType == 'contact' || $activeItemType == 'swiper'): ?>
    <div class="admin-active-item-container">
        <?php if($activeItemType === 'contact'): ?>
            
        <?php elseif($activeItemType === 'service'): ?>
            <div class="service-form-container">
                <form method="post" action="AdminDashboard.php" enctype="multipart/form-data" class="service-form">
                    <div class="col1">
                        <div class="service-form-title-container">
                            <label for="service-title">Başlık</label>
                            <input name="service-title" type="text" maxlength="100" minlength="3">
                        </div>
                        <div class="service-form-description-container">
                            <label for="service-description">Açıklama</label>
                            <textarea name="service-description" id="service-description-input" cols="30" rows="10">

                            </textarea>
                        </div>
                    </div>
                    <div class="col2">
                        <div class="service-image-container">
                            <img src="" alt="Service image">
                        </div>
                        <div class="service-image-upload-container">
                            <label for="selected-file">Upload an image</label>
                            <input type="file" name="service-image-file" class="service-image-file" id="selected-file" style="display: none;" />
                            <input type="button" value="Browse..." onclick="document.getElementById('selected-file').click();" />
                        </div>
                        <div class="service-price-container">
                            <label for="service-price">Fiyat</label>
                            <input name="service-price" type="number" min="0" max="999999" step="0.01">
                        </div>
                        <div class="service-form-submit">
                            <button type="submit" name="service-form-submit-button">
                                TAMAM
                            </button>
                        </div>
                        <?php if($activeContainerType=='edit'): ?>
                        <div class="service-form-delete">
                            <button type="submit" name="service-form-delete-button" value="delete">
                                SİL
                            </button>
                        </div>
                        <?php endif; ?>
                    </div>
                </form>
            </div>
        <?php elseif($activeItemType === 'swiper'): ?>

        

        <?php endif; 
        endif;?>
        
    </div>

</body>
</html>


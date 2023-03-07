<?php $helper->setMode("Services");?>


        <div class="services">
            <?php 
            for($i = 0; $i < count(array_keys($services)); $i++){
                $service = $services[$i];
                ?>
                <div class='service-popup' id='<?php echo "service-".$i;?>'>
                    <div class="service-popup-image">
                        <img src=<?php echo "'".$helper->get($service['image'])."'"; ?> alt=<?php echo "'".$service['title']."'"; ?>>
                    </div>
                    <div class="service-popup-info">
                        <div class="service-popup-title">
                            <?php echo $service['title']; ?>
                        </div>
                        <div class="service-popup-description">
                            <?php echo $service['description']; ?>
                        </div>
                    </div>
                
                    <div class="service-popup-price">
                        <?php echo $service['price']." $"; ?>
                    </div>
                    <div class="service-popup-close-button">
                        <img onclick="closePopups()" src=<?php echo "'".$helper->get("close_button_icon")."'"; ?> alt="CLOSE">
                    </div>  
                </div>
                <button onclick=<?php echo "'togglePopup(".'"service-'.$i.'"'.")'";?>>
                
                <?php
                echo "<div class='service-container'>".
                        "<div class='service-image-container'>".
                            "<img src='".$helper->get($service['image'])."' alt='".$service['title']." image'>".
                        "</div>".
                    "<div class='service-info-container'>".
                    "<div class ='service-title-container'>".
                    $service['title'].
                    "</div>".
                    "<div class='service-description-container'>".
                    $service['description'].
                    "</div>".
                    "</div>".
                    "<div class='service-price-container'>".
                    $service['price']." $".
                    "</div>".
                    "</div>".
                    "</button>";
            }
        ?>
        </div>

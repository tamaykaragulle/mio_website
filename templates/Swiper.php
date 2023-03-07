<?php $helper->setMode("Swiper"); ?>
        <div class="container">
            <div class="swiper">
                <div class="swiper-wrapper">
                    <div class="swiper-slide" data-title="hello"><img
                            src=<?php echo "'".$helper->get("swiper_img_1")."'"; ?> alt=""></div>
                    <div class="swiper-slide"><img src=<?php echo "'".$helper->get("swiper_img_2")."'"; ?> alt=""></div>
                    <div class="swiper-slide"><img src=<?php echo "'".$helper->get("swiper_img_3")."'"; ?> alt=""></div>
                </div>
                <div class="swiper-info">
                    <span class="swiper-title">MIO</span>
                    <br><br>
                    <span class="swiper-subtitle">Beauty Products</span>
                    <br><br>
                    <a href="Index.php#contact">CONTACT US</a>
                </div>
                <div class="swiper-pagination"></div>
                <div class="swiper-button-prev"></div>
                <div class="swiper-button-next"></div>
            </div>
        </div>
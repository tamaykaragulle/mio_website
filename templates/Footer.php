<?php $helper->setMode("Footer"); ?>
    <footer>
        <div class="contact-info">
            <h3 class="contact-info-title"><span>Contact Info</span></h3>
            <div class="info-box">
                <div class="info-container">
                    <button onclick="toggleMap()" class="map-button"><a href="Index.php#map"><img
                                src=<?php echo "'".$helper->get("hyperlink_icon")."'"; ?> alt="Link:"></button>
                    <p class="contact-info-address">Istanbul<br>TURKIYE</p></a>
                </div>
                <div class="info-container">
                    <img src=<?php echo "'".$helper->get("mail_icon")."'"; ?> alt="Mail:">
                    <a class="contact-info-email" href="mailto:asdasd@gmail.com">example@gmail.com</a>
                </div>
                <div class="info-container">
                    <img src=<?php echo "'".$helper->get("phone_icon")."'"; ?> alt="Phone:">
                    <a class="contact-info-phone" href="tel:05055555555">0505 555 55 55</a>
                </div>
            </div>
        </div>
        <div id="map" class="map">
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d192698.5521409693!2d28.871753927084946!3d41.005236293264716!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x14caa7040068086b%3A0xe1ccfe98bc01b0d0!2zxLBzdGFuYnVs!5e0!3m2!1str!2str!4v1660298391646!5m2!1str!2str"
                style="border:0;" allowfullscreen="" loading="lazy"
                referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
        </div>
    </footer>
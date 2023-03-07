<?php $helper->setMode("Contact"); ?>
        <div id="contact" class="contact-box">
            <div class="contact-img">
                <img src=<?php echo "'".$helper->get("contact_img")."'"; ?> alt="Güzellik salonu temalı resim">
            </div>
            <div class="contact-form">
                <h3>CONTACT</h3>
                <h2>Get In Touch</h2>
                <form method="post" action="Index.php">
                    <div class="form-box">
                        <div class="row50">
                            <div class="input-box">
                                <input name="contact-first-name" type="text" placeholder="Name">
                            </div>
                            <div class="input-box">
                                <input name="contact-last-name" type="text" placeholder="Surname">
                            </div>
                        </div>
                        <div class="row50">
                            <div class="input-box">
                                <input name="contact-email" type="text" placeholder="Email">
                            </div>
                            <div class="input-box">
                                <input name="contact-mobile" type="text" placeholder="Phone number">
                            </div>
                        </div>

                        <div class="row100">
                            <div class="input-box">
                                <textarea placeholder="Message (optional)" name="contact-message" id="" cols="30"
                                    rows="10"></textarea>
                            </div>
                        </div>

                        <div class="row100">
                            <div class="input-box">
                                <input type="submit" value="SEND NOW">
                            </div>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    <footer class="footer">
        <div class="wrapper">
            <div class="flex">
                <h2 class="title mb-47"><?php echo $tplData['contact_title']; ?></h2>
            </div>
            <div class="flex full">
                <div class="two-of-three">
                    <ul class="socials mb-34">
                        <li>
                            <a href="https://www.instagram.com/ucompany.site" target="_blank" rel="noreferrer">Instagram</a>
                        </li>
                        <li>
                            <a href="https://t.me/voopsc" target="_blank" rel="noreferrer">Telegram</a>
                        </li>
                        <li>
                            <a href="https://github.com/vladpsel" target="_blank" rel="noreferrer">
                                Github
                            </a>
                        </li>
                        <li>
                            <a href="https://www.linkedin.com/in/vlad-panov-726669152/" target="_blank" rel="noreferrer">
                                Linkedin
                            </a>
                        </li>
                    </ul>
                    <ul class="footer-list">
                        <li>
                            <span>Email:</span> <a href="mailto:vpanovwr@gmail.com">vpanovwr@gmail.com</a>
                        </li>
                        <li>
                            <span>Телефон:</span> <a href="tel:380683317644">+380 68 331 76 44</a>
                        </li>
                        <li>
                            <span>Skype:</span> <a href="#">panovlad13</a>
                        </li>
                    </ul>
                </div>
                <div class="one-of-three">
                    <div class="img-wrp">
                        <img src="<?php echo $this->getAsset('img/contacts.jpg'); ?>" alt="">
                    </div>
                </div>
            </div>
            <div class="copyrights flex">
                <div class="copyrights__me flex f-center v-center">
                    <span>With</span>
                    <img src="<?php echo $this->getAsset('img/h.svg'); ?>" alt="">
                    <span>by</span>
                    <img src="<?php echo $this->getAsset('img/logo.svg'); ?>" alt="">
                </div>
                <div class="full text-center">
                    <p>© 1996 - 2022</p>
                </div>
            </div>

        </div>
    </footer>
    <!-- Scripts -->
    <script src="<?php echo $this->getAsset('/js/main.js'); ?>"></script>
    <script src="<?php echo $this->getAsset('/js/script.js'); ?>"></script>
    </body>
</html>
<header class="header">
    <div class="wrapper">
        <div class="flex v-center f-between">
            <a href="<?php echo $tplData::normalize(APP_LANG); ?>" class="logo np">
                <img src="<?php echo $this->getAsset('img/logo.svg'); ?>" alt="Vlad Panov Logo">
            </a>

            <?php $tplData->renderLangList(['lang-list', 'list', 'np-i']); ?>
        </div>
    </div>
</header>
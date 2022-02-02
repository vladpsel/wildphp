<?php
use Voopsc\Wild\Component\LangComponent;
$lang = new LangComponent();
$dict = $lang->getDictionary('footer.php');
?>

<?php $this->components->getHead(); ?>
<?php $this->getTemplatePart('user/layout/header', $lang); ?>
<main>
    <section class="not-found-content">
        <div class="wrapper">
            <div class="flex f-center v-center magic-body">
                <div class="not-found-card">
                    <div class="title-shape">
                        <p class="headline">4&#x1F631;4</p>
                    </div>
                    <div class="text-box">
                        <h1 class="subtitle text-center mb-18"><?php echo $dict['content_not_found']; ?></h1>
                        <p class="text">
                            <?php echo $dict['not_found_text_one']; ?>
                        </p>
                        <p class="text m-hidden">
                            <?php echo $dict['not_found_text_two']; ?>
                        </p>
                    </div>
                    <a href="<?php echo $lang::normalize(APP_LANG); ?>" class="btn btn-arr">
                        <span><?php echo $dict['home']; ?></span>
                        <svg width="7" height="8" viewBox="0 0 7 8" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M6 3.4641C6.66667 3.849 6.66667 4.81125 6 5.19615L1.5 7.79423C0.833334 8.17913 -3.3649e-08 7.69801 0 6.92821L2.27131e-07 1.73205C2.6078e-07 0.962253 0.833334 0.481126 1.5 0.866027L6 3.4641Z"/>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </section>
</main>
<?php $this->getTemplatePart('user/layout/footer-alt', $dict); ?>


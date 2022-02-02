<?php
use Voopsc\Wild\Component\LangComponent;

$lang = new LangComponent();

$this->components->getHead();
?>

<?php $this->getTemplatePart('user/layout/header', $lang); ?>
<main>
    <section class="first-screen">
        <div class="home-first-screen wrapper">
            <div class="flex">
                <div class="two-of-three">
                    <div class="content mb-18">
                        <div class="title-box mb-34">
                            <h1 class="title-main animateIt" data-animation="animFadeInDown">
                                <span><?php echo $content['title_one']; ?></span>
                                <span class="text-right bold"><?php echo $content['title_two']; ?></span>
                            </h1>
                            <p class="animateIt" data-animation="animFadeInLeft"><?php echo $content['title_and']; ?></p>
                            <p class="subtitle-sm colored ml-28 animateIt" data-animation="animFadeInLeft">Strong Junior PHP Developer</p>
                        </div>
                        <div class="text-btn-box">
                            <p class="text mb-18 animateIt" data-animation="animFadeInLeft">
                                <?php echo $content['description_one']; ?>
                            </p>
                            <p class="text mb-18 animateIt" data-animation="animFadeInLeft">
                                <?php echo $content['description_two']; ?>
                            </p>
                            <p class="text mb-18 animateIt" data-animation="animFadeInLeft">
                                <?php echo $content['description_three']; ?>
                            </p>
                        </div>
                        <div class="btn-group flex f-right animateIt" data-animation="animFadeInLeft">
                            <a href="<?php echo $lang::normalize(APP_LANG) . 'about'; ?>" class="btn btn-arr">
                                <span><?php echo $content['about_btn']; ?></span>
                                <svg width="7" height="8" viewBox="0 0 7 8" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M6 3.4641C6.66667 3.849 6.66667 4.81125 6 5.19615L1.5 7.79423C0.833334 8.17913 -3.3649e-08 7.69801 0 6.92821L2.27131e-07 1.73205C2.6078e-07 0.962253 0.833334 0.481126 1.5 0.866027L6 3.4641Z"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="first-screen__picture one-of-three animateIt" data-animation="animFadeInDown">
                    <div class="img-wrp">
                        <img src="<?php echo $this->getAsset('img/i.jpg'); ?>" alt="Vlad Panov portrait">
                    </div>
                    <?php $this->getTemplatePart('user/components/socials'); ?>
                </div>

            </div>
        </div>
    </section>
    <section>
        <div class="wrapper">
            <div class="about flex limited-box">
                <div class="title-box one-of-four">
                    <h2 class="title mb-18 animateIt" data-animation="animFadeInDown">
                        <span><?php echo $content['about_title']; ?></span>
                        <span class="colored text-right"><?php echo $content['about_title_two']; ?></span>
                    </h2>
                </div>
                <div class="text-box two-of-three animateIt" data-animation="animFadeInRight">
                    <p>
                        <?php echo $content['about_text_one']; ?>
                    </p>
                    <p>
                        <?php echo $content['about_text_two']; ?>
                    </p>

                    <p>
                        <?php echo $content['about_text_three']; ?>
                    </p>

<!--                    <div class="btn-group flex f-right">-->
<!--                        <a href="404.html" class="btn btn-arr">-->
<!--                            <span>Чуть-чуть по подробнее</span>-->
<!--                            <svg width="7" height="8" viewBox="0 0 7 8" fill="none" xmlns="http://www.w3.org/2000/svg">-->
<!--                                <path d="M6 3.4641C6.66667 3.849 6.66667 4.81125 6 5.19615L1.5 7.79423C0.833334 8.17913 -3.3649e-08 7.69801 0 6.92821L2.27131e-07 1.73205C2.6078e-07 0.962253 0.833334 0.481126 1.5 0.866027L6 3.4641Z"/>-->
<!--                            </svg>-->
<!--                        </a>-->
<!--                    </div>-->
                </div>
            </div>
        </div>
    </section>
    <section>
        <div class="wrapper">
            <div class="flex aligned">
                <h2 class="title-main two-of-four mx-w np mb-47 animateIt" data-animation="animFadeInLeft">
                    <span> <?php echo $content['tech_title_one']; ?> </span>
                    <span class="colored"><?php echo $content['tech_title_two']; ?></span>
                    <span class="w-auto"><?php echo $content['tech_title_three']; ?></span>
                </h2>
            </div>
            <div class="flex aligned">
                <div class="text-box one-of-three np animateIt" data-animation="animFadeInLeft">
                    <p class="text">
                        <?php echo $content['tech_text_one']; ?>
                    </p>
                    <p class="text">
                        <?php echo $content['tech_text_two']; ?>
                    </p>
                </div>
                <?php
                    $tech = include ROOT . '/public/upload/tech.php';
                ?>
                <ul class="list two-of-three v-top animateIt" data-animation="animFadeInDown">
                    <?php foreach($tech as $techItem): ?>
                        <li>
                            <div class="icon">
                                <img src="<?php echo $this->getAsset($techItem); ?>" alt="icon">
                            </div>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    </section>
    <section>
        <div class="wrapper">
            <div class="cases limited-box">

                <div class="flex">
                    <div class="title-box one-of-three mx-w mb-47">
                        <h2 class="title animateIt" data-animation="animFadeInUp">
                            <span><?php echo $content['cases_title']; ?></span>
                            <span class="colored text-right"><?php echo $content['cases_title_one']; ?></span>
                        </h2>
                    </div>
                </div>


                <?php
                    $cases = include ROOT . '/public/upload/cases.php';
                ?>

                <div class="flex">
                    <ul class="portfolio-list list list-three-items mb-47">
                        <?php foreach($cases as $case): ?>
                            <li class="animateIt" data-animation="animFadeInDown">
                                <div class="full">
                                    <div class="img-wrp">
                                        <a href="<?php echo $case['link']; ?>" target="_blank" rel="noreferrer">
                                            <img src="<?php echo $this->getAsset($case['picture']); ?>" alt="#">
                                        </a>
                                    </div>
                                    <div class="info">
                                        <span class="headline"><?php echo $case['title']; ?></span>
                                        <span class="description"><?php echo $case['year']; ?></span>
                                        <a href="https://goodluck.ucompany.site/" target="_blank" class="btn btn-arr" rel="noreferrer">
                                            <span><?php echo $content['detail_btn']; ?></span>
                                            <svg width="7" height="8" viewBox="0 0 7 8" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M6 3.4641C6.66667 3.849 6.66667 4.81125 6 5.19615L1.5 7.79423C0.833334 8.17913 -3.3649e-08 7.69801 0 6.92821L2.27131e-07 1.73205C2.6078e-07 0.962253 0.833334 0.481126 1.5 0.866027L6 3.4641Z"/>
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>

                <div class="tab-btn-panel flex f-between">
                    <button type="button" name="button" class="tab-btn">Дизайнил</button>
                    <button type="button" name="button" class="tab-btn">Верстал</button>
                    <button type="button" name="button" class="tab-btn active">“Под ключ”</button>
                    <button type="button" name="button" class="tab-btn">Бекэнд</button>
                    <button type="button" name="button" class="tab-btn">На платформах собирал</button>
                    <button type="button" name="button" class="tab-btn">Прочее</button>
                </div>
            </div>
        </div>
    </section>
</main>
<?php $this->getTemplatePart('user/layout/footer', $content); ?>

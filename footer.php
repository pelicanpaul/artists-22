<div class="push"></div>
</div>
<footer class="footer">
    <div class="footer-page-inner">
        <div class="container">
            <div class="row">
                <div class="col-lg-2">

                    <nav role="navigation">
                        <?php
                        wp_nav_menu(array(
                            'menu' => 'footer-1',
                            'theme_location' => 'footer-1',
                            'depth' => 2,
                            'container' => 'div',
                            'container_class' => 'menu-footer',
                            'menu_class' => 'nav-footer',
                            'fallback_cb' => false
                        ));


                        ?>
                    </nav>

                </div>
                <div class="col-lg-2">

                    <nav role="navigation">
                        <?php
                        wp_nav_menu(array(
                            'menu' => 'footer-2',
                            'theme_location' => 'footer-2',
                            'depth' => 2,
                            'container' => 'div',
                            'container_class' => 'menu-footer',
                            'menu_class' => 'nav-footer',
                            'fallback_cb' => false
                        ));
                        ?>
                    </nav>

                </div>
                <div class=" col-lg-2">

                    <nav role="navigation">
                        <?php
                        wp_nav_menu(array(
                            'menu' => 'footer-3',
                            'theme_location' => 'footer-3',
                            'depth' => 2,
                            'container' => 'div',
                            'container_class' => 'menu-footer',
                            'menu_class' => 'nav-footer',
                            'fallback_cb' => false
                        ));
                        ?>
                    </nav>

                </div>
                <div class="col-md-6">

                    <?php if (is_active_sidebar('social_widget')) : ?>
                        <div id="social-widget" role="complementary">
                            <?php dynamic_sidebar('social_widget'); ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row">
                <div class="col-md-12">

                    <div class="container-bottom-scroll-to-top">
                        <div class="scroll-to-top"></div>
                    </div>

                    <?php if (is_active_sidebar('copyright_widget')) : ?>
                        <div id="copyright-widget" role="complementary">
                            <?php dynamic_sidebar('copyright_widget'); ?>
                        </div>
                    <?php endif; ?>

                </div>
            </div>
        </div>
    </div>
</footer>


<?php wp_footer(); ?>


</body>
</html>
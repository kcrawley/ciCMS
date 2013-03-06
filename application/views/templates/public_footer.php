
    <!-- FOOTER -->

<!-- start: Footer -->
<div id="footer">

    <!-- start: Container -->
    <div class="container">

        <!-- start: Row -->
        <div class="row">

            <!-- start: About -->
            <div class="span3">

                <h3>About Us</h3>
                <p>
                    Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.
                </p>

            </div>
            <!-- end: About -->

            <!-- start: Photo Stream -->
            <div class="span3">

                <h3>Photo Stream</h3>
                <div class="flickr-widget">
                    <script type="text/javascript" src="http://www.flickr.com/badge_code_v2.gne?count=9&display=latest&size=s&layout=x&source=user&user=29609591@N08"></script>
                    <div class="clear"></div>
                </div>

            </div>
            <!-- end: Photo Stream -->

            <div class="span6">

                <!-- start: Follow Us -->
                <h3>Follow Us!</h3>
                <ul class="social-grid">
                    <li>
                        <div class="social-item">
                            <div class="social-info-wrap">
                                <div class="social-info">
                                    <div class="social-info-front social-twitter">
                                        <a href="http://twitter.com"></a>
                                    </div>
                                    <div class="social-info-back social-twitter-hover">
                                        <a href="http://twitter.com"></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="social-item">
                            <div class="social-info-wrap">
                                <div class="social-info">
                                    <div class="social-info-front social-facebook">
                                        <a href="http://facebook.com"></a>
                                    </div>
                                    <div class="social-info-back social-facebook-hover">
                                        <a href="http://facebook.com"></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="social-item">
                            <div class="social-info-wrap">
                                <div class="social-info">
                                    <div class="social-info-front social-dribbble">
                                        <a href="http://dribbble.com"></a>
                                    </div>
                                    <div class="social-info-back social-dribbble-hover">
                                        <a href="http://dribbble.com"></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="social-item">
                            <div class="social-info-wrap">
                                <div class="social-info">
                                    <div class="social-info-front social-flickr">
                                        <a href="http://flickr.com"></a>
                                    </div>
                                    <div class="social-info-back social-flickr-hover">
                                        <a href="http://flickr.com"></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
                <!-- end: Follow Us -->

                <!-- start: Newsletter -->
                <form id="newsletter">
                    <h3>Newsletter</h3>
                    <p>Please leave us your email</p>
                    <label for="newsletter_input">@:</label>
                    <input type="text" id="newsletter_input"/>
                    <input type="submit" id="newsletter_submit" value="submit">
                </form>
                <!-- end: Newsletter -->

            </div>

        </div>
        <!-- end: Row -->

    </div>
    <!-- end: Container  -->

</div>
<!-- end: Footer -->

<!-- start: Copyright -->
<div id="copyright">

    <!-- start: Container -->
    <div class="container">

        <div class="span12">
            <p>
                &copy; 2013, <a href="http://cumberlandcreativegroup.com">Cumberland Photography</a>. Designed by <a href="http://cumberlandcreativegroup.com">Cumberland Creative Group</a> in Crossville, TN <a href="<?= SITE_PATH ?>index.php/action/dologin">*</a>
            </p>
        </div>

    </div>
    <!-- end: Container  -->

</div>
<!-- end: Copyright -->

    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    
    <script src="<?php echo SITE_RESOURCES; ?>javascript/bootstrap.js"></script>
    <script src="<?php echo SITE_RESOURCES; ?>javascript/isotope.js"></script>
    <script src="<?php echo SITE_RESOURCES; ?>javascript/jquery.imagesloaded.js"></script>
    <script src="<?php echo SITE_RESOURCES; ?>javascript/flexslider.js"></script>
    <script src="<?php echo SITE_RESOURCES; ?>javascript/carousel.js"></script>
    <script src="<?php echo SITE_RESOURCES; ?>javascript/jquery.cslider.js"></script>
    <script src="<?php echo SITE_RESOURCES; ?>javascript/slider.js"></script>
    <script src="<?php echo SITE_RESOURCES; ?>javascript/fancybox.js"></script>
    <script defer="defer" src="<?php echo SITE_RESOURCES; ?>javascript/custom.js"></script>
    <script type="text/javascript" src="<?php echo SITE_RESOURCES; ?>javascript/jquery.prettyPhoto.js"></script>
    <script type="text/javascript" src="<?php echo APP_RESOURCES; ?>javascript/colorbox/colorbox.js"></script>
    <script type="text/javascript" src="<?php echo APP_RESOURCES ?>javascript/jquery-ui-1.9.2.custom.min.js"></script>

      <script type="text/javascript">
          jQuery(document).ready(function($) {

              $("a[rel^='prettyPhoto']").prettyPhoto({
                  deeplinking: false
              });


              $('a#blog_nav').click(function(e) {
                  e.preventDefault();
              });

              $('.color_link').click(function(e) {
                  $(this).colorbox({
                      transition: 'fade',
                      initialWidth: '50px',
                      initialHeight: '50px',
                      scrolling: false,
                      overlayClose: true,
                      escKey: true,
                      opacity: .6
                  });
              });

              $('#tek_cancel').live('click', function(e){
                  e.preventDefault();
                  $.colorbox.close();
              });
          });
      </script>
  </body>
</html>
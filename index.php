<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
            <title>Wooden - Creative Landing Page</title>
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <meta name="description" content="Wooden - Creative Landing Page">
                    <?php echo '<meta name="author" content="Shy Design">'; ?>
                        
                        <!-- Le styles -->
                        <link href="css/bootstrap.min.css" rel="stylesheet">
                            <link href="css/bootstrap-responsive.min.css" rel="stylesheet">
                                <link href="css/custom.css" rel="stylesheet">
                                    <link href="css/font-awesome.min.css" rel="stylesheet">
                                        
                                        
                                        </head>
    <body>
        
        <header id="header" class="header">
            
            <div class="container">
                <div class="row-fluid">
                    <div class="span6">
                        <div class="header-title">
                            <h1>PhotoMix <small>photo sharing made easy.</small></h1>
                        </div><!-- /header-title -->
                        
                        <div class="header-description">
                            <p>Dolor sit amet, consectetur adipiscing elit. Quisque augue orci, consequat eget semper vel, cursus eu nunc. In venenatis ipsum ut massa bibendum quis cursus arcu varius. Duis mattis viverra elementum. In ullamcorper velit in libero Curabitur sit amet felis non libero lobortis varius. Vestibulum orci enim, lacinia vel gravida quis, adipiscing vel velit. Quisque pulvinar nulla vulputate augue pretium at pulvinar ante viverra. Vestibulum eget lorem nibh, eu aliquam sem.</p>
                            <p>Praesent cursus sodales dolor, raesent tempus velit purus, nec consequat risus. Donec feugiat semper hendrerit. In vestibulum nunc id nisl condimentum nunc. Vestibulum mollis venenatis elit non porttitor. Maecenas metus risus, rutrum quis semper at, sodales ac massa.</p>
                            <p>Aliquam tempor mauris vel sapien aliquam eget interdum sem malesuada. Curabitur mollis erat arcu. Pellentesque non lacus quam, ac gravida mauris. Nunc facilisis tempus nunc vitae rutrum. Curabitur sit amet mauris lacus, non dapibus nisi. Quisque rhoncus imperdiet volutpat. Maecenas hendrerit quam non nunc interdum porta. Pellentesque id dolor nec dui sodales laoreet vitae nec tellus. Donec consequat sem ut neque molestie dignissim tincidunt leo vulputate. Aliquam nec mi et justo feugiat hendrerit at non enim. </p>
                        </div>
                        
                        <div class="app-buttons">
                            <a class="border-btn pull-left" href="#">IPhone App</a>
                            <a class="border-btn pull-right" href="#">Android App</a>
                        </div>
                    </div><!-- /span6 -->
                    
                    <div class="span3">
                        <div class="iphone">
                            <div class="iphone-slider">
                                <div id="iphone-carousel" class="carousel slide">
                                    <div class="carousel-inner">
                                        <div class="item active">
                                            <img src="img/iphone-1.jpg" alt="">
                                                </div>
                                        <div class="item">
                                            <img src="img/iphone-2.jpg" alt="">
                                                </div>
                                        <div class="item">
                                            <img src="img/iphone-3.jpg" alt="">
                                                </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- /span3 -->
                    
                    <div class="span3">
                        <div class="galaxy">
                            <div class="galaxy-slider">
                                <div id="galaxy-carousel" class="carousel slide">
                                    <div class="carousel-inner">
                                        <div class="item active">
                                            <img src="img/galaxy-1.jpg" alt="">
                                                </div>
                                        <div class="item">
                                            <img src="img/galaxy-2.jpg" alt="">
                                                </div>
                                        <div class="item">
                                            <img src="img/galaxy-3.jpg" alt="">
                                                </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- /span3 -->
                    
                </div><!-- /row-fluid -->
            </div><!-- /container -->
        </header>
        
        <footer id="footer" class="footer">
            <ul class="unstyled inline text-center social">
                <li><a class="border-btn" href="#"><span class="icon-facebook"></span></a></li>
                <li><a class="border-btn" href="#"><span class="icon-twitter"></span></a></li>
                <li><a class="border-btn" href="#"><span class="icon-google-plus"></span></a></li>
            </ul>
            
            <div class="copyright">
                <div class="container">
                    <div class="row-fluid">
                        <div class="span12">
                            <p class="pull-left"><a href="index.html">PhotoMix.</a> &copy; 2013 All Right Reserved.</p>
                            <p class="pull-right">Any feedback is welcomed.
                            <a href="#contactModal" role="button" data-toggle="modal">Contact Us</a> |
                            <a href="#subscribeModal" role="button" data-toggle="modal">Subscribe</a> |
                            <a href="#aboutModal" role="button" data-toggle="modal">About</a> |
                            <a href="#testimonialsModal" role="button" data-toggle="modal">Testimonials</a>
                            </p>
                        </div><!-- /span12 -->
                    </div><!-- /row-fluid -->
                </div><!-- /container -->
            </div>
            
            <!-- Contact Modal -->
            <div id="contactModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="contactLabel" aria-hidden="true">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="icon-remove-sign"></i></button>
                    <h3 id="contactLabel" >Contact Us</h3>
                </div>
                <div class="modal-body">
                    <p>Feel free to share your thoughts with us.</p>
                    <form class="contact-form">
                        <fieldset>
                            <input class="input-block-level" type="text" name="name" placeholder="your name">
                                <input class="input-block-level" type="email" name="email" placeholder="your email">
                                    <textarea class="input-block-level" rows="3" name="message" placeholder="your message"></textarea>
                                    <button class="btn btn-success" type="submit">Submit</button>
                                    </fieldset>
                    </form>
                </div>
            </div>
            
            <!-- Subscribe Modal -->
            <div id="subscribeModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="subacribeLabel" aria-hidden="true">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="icon-remove-sign"></i></button>
                    <h3 id="subacribeLabel" >Subscribe</h3>
                </div>
                <div class="modal-body">
                    <p>Recieve our official newsletters about updates and news.</p>
                    <form class="subsc-form form-inline text-center">
                        <input type="email" class="input-xlarge" name="subscriber" placeholder="Email">
                            <button type="submit" class="btn btn-info">Subscribe</button>
                            </form>
                </div>
            </div>
            
            <!-- About Model -->
            <div id="aboutModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="aboutLabel" aria-hidden="true">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="icon-remove-sign"></i></button>
                    <h3 id="aboutLabel">About Us</h3>
                </div>
                <div class="modal-body">
                    <p>One morning, when Gregor Samsa woke from troubled dreams, he found himself transformed in his bed into a horrible vermin. He lay on his armour-like back, and if he lifted his head a little he could see his brown belly, slightly domed and divided by arches into stiff sections. The bedding was hardly able to cover it and seemed ready to slide off any moment. His many legs, pitifully thin compared with the size of the rest of him, waved about helplessly as he looked. "What's happened to me?" he thought. It wasn't a dream. His room, a proper human room although a little too small, lay peacefully between its four familiar walls. A collection of textile samples lay spread out on the table - Samsa was a travelling salesman - and above it there hung a picture that he had recently cut out of an illustrated magazine and housed in a nice, gilded frame. It showed a lady fitted out with a fur hat and fur boa who sat upright, raising a heavy fur muff that covered the whole of her lower arm towards the viewer.</p>
                    <br>
                    
                    <p class="text-center"><strong>Jim Johe</strong> is head designer, you can find him on
                    <a class="about-social" href="#"><i class="icon-twitter"></i></a>
                    <a class="about-social" href="#"><i class="icon-facebook"></i></a> 
                    <a class="about-social" href="#"><i class="icon-google-plus"></i></a>
                    </p>
                    <p class="text-center"><strong>John Doe</strong> is head developer, you can find him on 
                    <a class="about-social" href="#"><i class="icon-twitter"></i></a>
                    <a class="about-social" href="#"><i class="icon-facebook"></i></a> 
                    <a class="about-social" href="#"><i class="icon-google-plus"></i></a>
                    </p>
                </div>
            </div>
            
            <!-- Testimonials Model -->
            <div id="testimonialsModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="testimonialsLabel" aria-hidden="true">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="icon-remove-sign"></i></button>
                    <h3 id="testimonialsLabel" >Testimonials</h3>
                </div>
                <div class="modal-body">
                    <blockquote>
                        <i class="icon-quote-left"></i>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.</p>
                        <small>Jack Johni</small>
                    </blockquote>
                    <blockquote>
                        <i class="icon-quote-left"></i>
                        <p>Amazing service dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.</p>
                        <small>Jack Johni</small>
                    </blockquote>
                    <blockquote>
                        <i class="icon-quote-left"></i>
                        <p>Consectetur adipiscing elit. Integer posuere erat a ante.</p>
                        <small>Jack Johni</small>
                    </blockquote>
                </div>
            </div>
        </footer>
        
        <!-- Le javascript
         ================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->
        <script src="js/jquery.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/script.js"></script>
        
    </body>
</html>
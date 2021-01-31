
<?php
$page_title = "home";
include('includes/head.php');
include('config/db.php');

?>

<style>
    .carousel-item {
        height: 90vh;
        min-height: 350px;
        background: no-repeat center center scroll;
        -webkit-background-size: cover;
        -moz-background-size: cover;
        -o-background-size: cover;
        background-size: cover;
    }

    .txt-shadow-dark{
        text-shadow:0px 4px 20px #5d5d5d;
    }
</style>
<header>
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner" role="listbox">
            <!-- Slide One - Set the background image for this slide in the line below -->
            <div class="carousel-item active " style="background-image: url('assets/img/slides/1.jpg')">
                <div class="carousel-caption d-none d-md-block">
                    <h2 class="display-4">Brand New Dragon Laptop</h2>
                    <p class="lead">Discover the world</p>
                </div>
            </div>
            <!-- Slide Two - Set the background image for this slide in the line below -->
            <div class="carousel-item" style="background-image: url('assets/img/slides/2.jpg')">
                <div class="carousel-caption d-none d-md-block">
                    <h2 class="display-4 text-dark txt-shadow-dark">Awesome Spring Package</h2>
                    <p class="lead text-dark txt-shadow-dark">Iphone X pro + Macbook Air</p>
                </div>
            </div>
            <!-- Slide Three - Set the background image for this slide in the line below -->
            <div class="carousel-item" style="background-image: url('assets/img/slides/3.jpg')">
                <div class="carousel-caption d-none d-md-block">
                    <h2 class="display-4">Brand New Phone</h2>
                    <p class="lead">Our awesome new phone series now in midnight black color</p>
                </div>
            </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
</header>

<!-- ======= About Section ======= -->
<section id="about" class="about">
    <div class="container">

        <div class="row">
            <div style="background-image: url(assets/img/floating-phone.jpg)" data-aos="fade-right"
                 class="image col-xl-5 d-flex align-items-stretch justify-content-center justify-content-lg-start"></div>
            <div class="col-xl-7 pt-4 pt-lg-0 d-flex align-items-stretch">
                <div class="content d-flex flex-column justify-content-center" data-aos="fade-left">
                    <h3>Newest Technology</h3>
                    <p>
                       Our company provide the most new techniques and technologies based on newest researches.
                    </p>
                    <div class="row">
                        <div class="col-md-6 icon-box" data-aos="zoom-in" data-aos-delay="100">
                            <i class="fa fa-user"></i>
                            <h4>User Friendly</h4>
                            <p>Our products are very easy to use for everybody in any age</p>
                        </div>
                        <div class="col-md-6 icon-box" data-aos="zoom-in" data-aos-delay="200">
                            <i class="bx bx-cube-alt"></i>
                            <h4>Environment Friendly</h4>
                            <p>Our products are recyclable and not harm ecosystem and environments</p>
                        </div>
                        <div class="col-md-6 icon-box" data-aos="zoom-in" data-aos-delay="300">
                            <i class="bx bx-images"></i>
                            <h4>Labore consequatur</h4>
                            <p>Aut suscipit aut cum nemo deleniti aut omnis. Doloribus ut maiores omnis
                                facere</p>
                        </div>
                        <div class="col-md-6 icon-box" data-aos="zoom-in" data-aos-delay="400">
                            <i class="bx bx-shield"></i>
                            <h4>Beatae veritatis</h4>
                            <p>Expedita veritatis consequuntur nihil tempore laudantium vitae denat
                                pacta</p>
                        </div>
                    </div>
                </div><!-- End .content-->
            </div>
        </div>

    </div>
</section><!-- End About Section -->
<!-- ======= Features Section ======= -->
<section id="features" class="features">
    <div class="container">

        <div class="row">
            <div class="col-lg-4 col-md-6 d-flex align-items-stretch">
                <div class="card" data-aos="fade-up">
                    <img src="assets/img/features/laptop-1.jpg" class="card-img-top" alt="...">
                    <div class="card-body">
                        <i class="bx bx-tachometer"></i>
                        <h5 class="card-title"><a href="">Our Mission</a></h5>
                        <p class="card-text">Lorem ipsum dolor sit amet, consectetur elit, sed do eiusmod
                            tempor ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud
                            exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 mt-5 mt-md-0 d-flex align-items-stretch">
                <div class="card" data-aos="fade-up" data-aos-delay="150">
                    <img src="assets/img/features/phone-1.jpg" class="card-img-top" alt="...">
                    <div class="card-body">
                        <i class="bx bx-file"></i>
                        <h5 class="card-title"><a href="">Our Plan</a></h5>
                        <p class="card-text">Sed ut perspiciatis unde omnis iste natus error sit voluptatem
                            doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore
                            veritatis et quasi architecto beatae vitae dicta sunt explicabo. </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 mt-5 mt-lg-0 d-flex align-items-stretch">
                <div class="card" data-aos="fade-up" data-aos-delay="300">
                    <img src="assets/img/features/tablet-1.jpg" class="card-img-top" alt="...">
                    <div class="card-body">
                        <i class="bx bx-show"></i>
                        <h5 class="card-title"><a href="">Our Vision</a></h5>
                        <p class="card-text">Nemo enim ipsam voluptatem quia voluptas sit aut odit aut
                            fugit, sed quia magni dolores eos qui ratione voluptatem sequi nesciunt Neque
                            porro quisquam est, qui dolorem ipsum quia dolor sit amet. </p>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section><!-- End Features Section -->
<!-- ======= Cta Section ======= -->
<section id="cta" class="cta" style="background: linear-gradient(rgba(2, 2, 2, 0.6), rgba(0, 0, 0, 0.8)), url(assets/img/cta.jpg) fixed center center">
    <div class="container">
        <div class="text-center" data-aos="zoom-in">
            <h3>Smart Watch</h3>
            <p> New generation of smart watches and sport watches</p>
            <a class="btn cta-btn" href="#">Go to Watches <i class="fa fa-arrow-right"></i></a>
        </div>
    </div>
</section><!-- End Cta Section -->




<?php
include('includes/footer.php');
include('includes/tail.php');
?>
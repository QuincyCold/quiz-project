<?php
include "inc/head.php";

$quizObj = new Quiz($conn);
$quizzes = $quizObj->getBasicQuizzesInfo();

?>

<div class="main-banner">
    <div class="container d-flex">
        <div class="row py-3 pt-5">
            <div class="small-jumbotron col-lg-7 d-flex align-items-center mb-3">
                <div class="">
                    <h1 class="text-blue font-40">Create Your Own Quiz Now<i class="fas fa-exclamation ms-2"></i>
                    </h1>
                    <p class="text-purple font-20">Play engaging quiz-based games at school, at home and at work,
                        create
                        your own Itec's Quizzes and learn something new about us .</p>
                    <a href="create_quiz.php"><button type="button" class="btn btn-outline-danger">Create<i class="fas fa-plus ms-2"></i></button></a>
                </div>

            </div>

            <div class="reviews col-lg-5 d-flex align-items-center text-center">
                <div class="flex-fill">
                    <div id="carouselExampleDark" class="carousel carousel-dark slide" data-bs-ride="carousel">
                        <div class="carousel-indicators">
                            <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="0"
                                class="active" aria-current="true" aria-label="Slide 1"></button>
                            <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="1"
                                aria-label="Slide 2"></button>
                            <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="2"
                                aria-label="Slide 3"></button>
                        </div>
                        <div class="carousel-inner">
                            <div class="carousel-item active" data-bs-interval="10000">
                                <div class="card">
                                    <img src="images/web_designs/CEO1.jpg" class="card-img-top" height="350vh"
                                        alt="...">
                                    <div class="card-body pb-5">
                                        <h5 class="card-title">CEO Datin Paduka</h5>
                                        <p class="card-text">This is the greatest site ever.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="carousel-item" data-bs-interval="2000">
                                <div class="card">
                                    <img src="images/web_designs/CEO2.jpg" class="card-img-top" height="350vh"
                                        alt="...">
                                    <div class="card-body pb-5">
                                        <h5 class="card-title">CEO Remi Turcotte</h5>
                                        <p class="card-text">I feel my life happier after using this website.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <div class="card">
                                    <img src="images/web_designs/CEO3.jpg" class="card-img-top" height="350vh"
                                        alt="...">
                                    <div class="card-body pb-5">
                                        <h5 class="card-title">CEO Martin Spencer</h5>
                                        <p class="card-text">This is my best student website i ever have seen.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleDark"
                            data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleDark"
                            data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> <!-- End of main-banner -->

<div class="latestQuiz mt-5 mb-5">
    <div class="container">
        <h1 class="text-center fw-bolder">Latest Quizzes</h1>
        <div class="d-flex justify-content-center">
            <hr>
        </div>

        <div class="row">
            <?php foreach($quizzes as $quiz): ?>
            <div class="col-lg-4 col-md-6 my-3 d-flex px-4">
                <div class="card " style="width:100%; border-radius: 30px;">
                    <img src="<?= $quiz['img_upload']; ?>" class="card-img-top " style="border-radius: 30px 30px 0px 0px; alt="" height="200px">
                    <div class="card-body">
                        <a href="quizGame.php?id=<?php echo $quiz['id'] ?>">
                            <h5 class="card-title"><?= $quiz['title']; ?></h5>
                        </a>
                        <p class="card-text"><?= substr($quiz['description'], 0, 100) ?></p>
                    </div>
                    <div class="card-footer d-flex justify-content-between" style="background-color: transparent;">
                        <div>
                            <?php echo $quiz['username'] . " | " . date("d M Y", strtotime($quiz['date_created'])); ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</div> <!-- End of latest quizzes -->

<?php
include "inc/footer.php";
?>

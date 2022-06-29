<?php
include "inc/head.php";
include "func/quizHandler.php";

if(isset($_POST['title'])) {
    $title = htmlspecialchars($_POST['title']);
    $description = htmlspecialchars($_POST['description']);
    $file = $_FILES['image'];
    $question = arrayHtmlSpecialChar($_POST['question']);
    $responseTrue = arrayHtmlSpecialChar($_POST['response-true']);
    $responseFalse1 = arrayHtmlSpecialChar($_POST['response-false-1']);
    $responseFalse2 = arrayHtmlSpecialChar($_POST['response-false-2']);
    $responseFalse3 = arrayHtmlSpecialChar($_POST['response-false-3']);
    validateQuiz($title, $description, $file, $question, $responseTrue, $responseFalse1, $responseFalse2, $responseFalse3);
}
?>

<div class="create-quiz-area">
    <?php if($_SESSION['logged_in']): ?>
    <div class="container mb-5 mt-2 py-4">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <h3><i class="fas fa-pencil me-2"></i> Create a Quiz</h3>
                <p><span class="text-orange fs-3 fw-bold">*</span> Note: some field is compulsory</p>
                <div class="card mt-3 text-dark">
                    <div class="card-body">
                        <form action="create_quiz.php" method="post" enctype="multipart/form-data">
                            <h3 class="text-center">Basic Info</h3>
                            <div class="form-group mb-3">
                                <label for="title">Quiz Title <span class="text-orange fs-3 fw-bold">*</label>
                                <input type="text" name="title" class="form-control" placeholder="Add post title...">
                            </div>
                            <div class="form-group mb-3">
                                <label for="description">Quiz Description <span class="text-orange fs-3 fw-bold">*</label>
                                <textarea name="description" class="form-control" rows="5"></textarea>
                            </div>
                            <div class="form-group mb-3">
                                <label for="image">Quiz Image</label>
                                <input type="file" name="image" class="form-control">
                            </div>

                            <hr style="height: 3px;">

                            <h3 class="text-center">Quiz Content</h3>
                            <div class="form-group mb-3">
                                <label for="question[]" style="color: red;">Question 1 <span class="text-orange fs-3 fw-bold">*</label>
                                <input type="text" name="question[]" class="form-control" placeholder="Add question...">
                            </div>

                            <div class="row">
                                <div class="form-group mb-3 col-md-6">
                                    <label for="response-true[]">Answer 1 (Answer True) <span class="text-orange fs-3 fw-bold">*</label>
                                    <input type="text" name="response-true[]" class="form-control"
                                        placeholder="Add response...">
                                </div>
                                <div class="form-group mb-3 col-md-6">
                                    <label for="response-false-1[]">Answer 2 <span class="text-orange fs-3 fw-bold">*</label>
                                    <input type="text" name="response-false-1[]" class="form-control"
                                        placeholder="Add response...">
                                </div>
                                <div class="form-group mb-3 col-md-6">
                                    <label for="response-false-2[]">Answer 3</label>
                                    <input type="text" name="response-false-2[]" class="form-control"
                                        placeholder="Add response...">
                                </div>
                                <div class="form-group mb-3 col-md-6">
                                    <label for="response-false-3[]">Answer 4</label>
                                    <input type="text" name="response-false-3[]" class="form-control"
                                        placeholder="Add response...">
                                </div>
                            </div>
                            
                            <div class="row button-quiz-create-area">
                                <div class="col-md-6 px-3 mb-sm-3">
                                    <button type="button" class="btn btn-success add-question w-100"><i class="fas fa-plus"
                                            aria-hidden="true"></i> Add Question</button>
                                </div>
                                
                                <div class="col-md-6 px-3">
                                    <button type="submit" class="btn btn-primary create-quiz w-100"><i class="fa fa-plus-circle"
                                            aria-hidden="true"></i> Create Quiz</button>
                                </div>                                
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php else: ?>
    <div class="container my-5">
        <h2 class="pt-5">Login to create a quiz!</h2>
        <a href="login.php" class="btn btn-primary btn-lg">Go to Login</a>
    </div>
    <?php endif; ?>
</div>
<?php
 include "inc/footer.php";
//  var_dump($_POST);
//  var_dump($_FILES);
?>
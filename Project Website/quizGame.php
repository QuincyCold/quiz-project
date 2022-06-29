<?php
    include "inc/head.php";
    include "func/quizHandler.php";

    $quiz = [];
    $isPlayed = false;
    $quizObj = new Quiz($conn);
    $currentQuestion = -1;

    if(isset($_GET['id']) && !$isPlayed && !isset($_POST['view-quiz-result']) && !isset($_POST['answer_submit'])) {
        $quiz = $quizObj->getQuizInfo($_GET['id']);
    }

    if(isset($_GET['currentQ'])){
        $currentQuestion = $_GET['currentQ'];
    }
    
    if(isset($_POST['play']) || isset($_POST['answer_submit']) || isset($_POST['next-question']) || isset($_POST['view-quiz-result'])) {
        $totalCorrectAnswer = (int)$_POST['totalCorrectAnswer'];
        if(!isset($_POST['view-quiz-result']))
            $quiz['questions'] =  $quizObj->getQuizQuestion($_GET['id']);

        if(isset($_POST['answer_submit']))
            $quiz['resultQuestion'] = $quizObj->getQuizQuestionResult($_GET['id'], $quiz['questions'][$currentQuestion]['id']);
        else if(!isset($_POST['view-quiz-result']))
            $quiz['responses'] = $quizObj->getQuizResponse($_GET['id'], $quiz['questions'][$currentQuestion]['id']);
        
        $isPlayed = true;
    }
?>

<?php if(!isset($_POST['view-quiz-result'])): ?>
    <div class="container mt-3">
        <a href="index.php" class="btn btn-warning"><i class="fas fa-arrow-left me-2" aria-hidden="true"></i> Back to home</a>
    </div>
<?php endif; ?>

<div class="quiz-handle-area">
    <?php if(!$isPlayed): ?>
    <div class="container py-3">
        <?php if(!empty($quiz)): ?>
        <img src="<?= $quiz['img_upload'];?>" height="400px" width="100%" alt="" class="quiz-img my-3"
            style="object-fit: cover;">
        <div class="d-flex justify-content-between">
            <div class="d-flex align-items-center">
                <div>
                    <h2 class="quiz-title"> <?php echo $quiz['title']; ?></h2>
                    <h6 class="font-italic font-weight-light text-muted">
                        <?php echo $quiz['username'] . " | " . date("d-M-Y", strtotime($quiz['date_created'])); ?></h6>
                </div>
                <div>
                    <?php if($_SESSION["logged_in"] === true || $_SESSION["username"] == "admin"): ?>
                    <form action="quiz.php" method="post" class="ms-4">
                        <input type="hidden" name="delete" value="<?php echo $quiz['id']; ?>">
                        <button type="submit" class="btn btn-danger"> <i class="fa fa-trash me-2"
                                aria-hidden="true"></i>
                            Delete</button>
                    </form>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <hr class="my-4">
        <p class="quiz-description"><?php echo $quiz['description']; ?></p>
        <form action="quizGame.php?id=<?= $_GET['id'] ?>&currentQ=0" method="post" class="text-center">
            <input type="hidden" name="play" value="<?= $quiz['id']; ?>">
            <input type="hidden" name="totalCorrectAnswer" value="0">
            <button type="submit" class="btn btn-play w-50 text-white"> <i class="fas fa-gamepad me-2"></i>
                Attempt</button>
        </form>

        <?php else: ?>
        <h1>quiz not found!</h1>
        <?php endif; ?>
    </div>
    <?php else: ?>
        <?php include "inc/quizModel.php" ?>
    <?php endif; ?>
</div>

<?php
 include "inc/footer.php";
 var_dump($quiz);
//  var_dump($isPlayed);
//  var_dump($currentQuestion);
 var_dump($_POST);
//  var_dump($_GET);
?>
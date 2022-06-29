<?php
 $colorBtn = ['btn-danger', 'btn-primary', 'btn-warning', 'btn-success'];
 $currentColor = 0;
?>

<div class="main-banner py-5">
    <div class="container text-center py-3" style="background: linear-gradient(180deg, rgba(253,149,140,1) 0%, rgba(230,175,130,1) 100%); border-radius: 1rem;">
        <?php if(!isset($_POST['view-quiz-result'])): ?>
            <h1 class="text-center" style="font-size: 70px;">Question</h1>
            <p class="text-center" style="font-size: 25px;"><?= $quiz['questions'][$currentQuestion]['ask_content'] ?></p>
            <?php if(!isset($_POST['answer_submit'])): ?>
                <div class="responses">
                    <div class="row p-2">
                        <?php                            
                            $tempAllRes = $quiz['responses'];
                            for ($i = count($quiz['responses']); $i > 0; $i--): ?>
                                <?php $randNumber = rand(0, $i - 1);
                                $tempOneRes = $tempAllRes[$randNumber];
                                array_splice($tempAllRes, $randNumber, 1); ?>                         
                                <form action="quizGame.php?id=<?= $_GET['id'] ?>&currentQ=<?= $currentQuestion ?>" method="post" class="p-md-3 d-flex col-md-6" style="min-height: 26vh;">
                                    <input type="hidden" name="answer_submit" value="<?= $tempOneRes['id'] ?>">
                                    <input type="hidden" name="totalCorrectAnswer" value="<?= $totalCorrectAnswer ?>">
                                    <button type="submit" class="btn <?= $colorBtn[$currentColor] ?> flex-fill" style="font-weight: bold; font-size: 22px;"><?= $tempOneRes['res_content'] ?></button>
                                </form>
                                <?php $currentColor++; ?>
                            <?php endfor ?>
                    </div>
                </div>
            <?php else: ?>
                <div class="result-question-chosed">
                    <?php if($_POST['answer_submit'] == $quiz['resultQuestion']['true_answer_id']): ?>
                        <h3 class="text-center">Your chosed answer is correct !</h3>
                    <?php else: ?>
                        <h3 class="text-center">Your chosed answer is wrong !</h3>
                    <?php endif; ?>

                    <?php if($currentQuestion+2 <= count($quiz['questions'])): ?>
                        <form action="quizGame.php?id=<?= $_GET['id'] ?>&currentQ=<?= $currentQuestion+1 ?>" method="post" class="p-md-3 text-center" style="">
                            <input type="hidden" name="next-question" value="">
                            <input type="hidden" name="totalCorrectAnswer" value="<?php if($_POST['answer_submit'] == $quiz['resultQuestion']['true_answer_id']) echo $totalCorrectAnswer+1; else echo $totalCorrectAnswer; ?>">
                            <button type="submit" class="btn btn-primary btn-next-question" style="font-weight: bold; font-size: 22px; max-width: 40%;"><i class="fa-solid fa-forward me-3"></i>Next Question</button>
                        </form>
                    <?php else: ?>
                        <form action="quizGame.php?id=<?= $_GET['id'] ?>" method="post" class="p-md-3 text-center" style="">
                            <input type="hidden" name="view-quiz-result" value="">
                            <input type="hidden" name="totalCorrectAnswer" value="<?php if($_POST['answer_submit'] == $quiz['resultQuestion']['true_answer_id']) echo $totalCorrectAnswer+1; else echo $totalCorrectAnswer; ?>">
                            <button type="submit" class="btn btn-primary" style="font-weight: bold; font-size: 22px;">View Final Result</button>
                        </form>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
        <?php else: ?>
            <h1 class="text-center">Final result</h1>
            <p class="text-center" style="font-weight: bold; font-size: 18px;">Total score: <?= $totalCorrectAnswer ?></p>
            <a href="index.php" class="btn btn-success text-center mb-3 mt-1" style="font-weight: bold; font-size: 20px;"><i class="fas fa-arrow-left me-2" aria-hidden="true"></i> Back to home</a>
        <?php endif; ?>
    </div>
</div>

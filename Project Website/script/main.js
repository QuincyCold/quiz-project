console.log("script loaded ^o^");

let languagesBtn = document.querySelector(".network-languages .laguages-btn button.btn");
let quizCreateArea = document.querySelector(".create-quiz-area");
let createQuizForm = document.querySelector(".create-quiz-area form");
let addMoreQuestionBtn = document.querySelector(".add-question");
let btnQuizCreateArea = document.querySelector(".button-quiz-create-area");

if (addMoreQuestionBtn != null)
    addMoreQuestionBtn.addEventListener("click", addInputQuestion);

let isBtnLangClicked = false;
languagesBtn.addEventListener("click", rotateArrow);

function rotateArrow() {
    if (!isBtnLangClicked) {
        languagesBtn.children[1].children[1].style.transform = "rotateX(180deg)";
        isBtnLangClicked = true;
    } else {
        languagesBtn.children[1].children[1].style.transform = "rotateX(0deg)";
        isBtnLangClicked = false;
    }
}

let currentQuestion = 1;

function addInputQuestion() {
    currentQuestion++;
    let htmlQuestion = `
    <div class="text-center"><i class="fas fa-star me-1"></i><i class="fas fa-star me-1"></i><i
        class="fas fa-star"></i></div>
    <div class="form-group mb-3">
    <label for="question[]" style="color: red;">Question ${currentQuestion} <span class="text-orange fs-3 fw-bold">*</label>
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
</div>`;

    btnQuizCreateArea.remove();
    createQuizForm.insertAdjacentHTML("beforeend", htmlQuestion);

    btnQuizCreateArea = document.querySelector(".button-quiz-create-area");
    addMoreQuestionBtn = document.querySelector(".add-question");
    addMoreQuestionBtn.addEventListener("click", addInputQuestion);
}
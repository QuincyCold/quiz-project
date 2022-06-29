<?php

function validateQuiz($title, $description, $file, $question, $responseTrue, $responseFalse1, $responseFalse2, $responseFalse3) {
    $errors = [];

    if(empty($title) || strlen($title) < 2) {
        $errors['title'] = "Title cannot be empty or too short!";
    }

    if(empty($description) || strlen($description) < 10) {
        $errors['description'] = "Description cannot be empty or too short!";
    }

    foreach($question as $singleQuestion){
        if(empty($singleQuestion || strlen($singleQuestion) < 2)){
            $errors['question'] = "Question cannot be empty or too short!";
            break;
        }
    }

    foreach($responseTrue as $singleTrue){
        if(empty($singleTrue)){
            $errors['response_true'] = "True answer cannot be empty!";
            break;
        }
    }

    foreach($responseFalse1 as $singleFalse1){
        if(empty($singleFalse1)){
            $errors['response_false'] = "Question need to have at least one wrong answer!";
            break;
        }
    }

    // before moving the file, ensure there are no errors with the form (so you don't orphaned files)
    if(empty($errors)) {
        $file_dest = validateFile($file);
        if(!$file_dest) {
            // if there is a problem with the file this will return false
            $errors['file'] = "There was a problem with your file!";
            var_dump($errors);
        } else {
            // if there are no errors, create the new post
            createQuiz($title, $description, $file_dest, $question, $responseTrue, $responseFalse1, $responseFalse2, $responseFalse3);
        }
    } else {
        var_dump($errors);
    }
}

function validateFile($file) {
    // validate file
    $errors = [];
    if($file['error'] === 0) {
        // check size is less than 5mb
        if($file['size'] > 5000000) {
            $errors['size'] = "File is too large!";
        }
        // check file ext is allowed
        $allowed_ext = ["png", "jpg", "jpeg", "gif"];
        $file_ext = explode("/", $file['type']);
        $file_ext = end($file_ext);
        if(!in_array(strtolower($file_ext), $allowed_ext)) {
            $errors['type'] = "Only images may be uploaded!";
        }
        // if there are no errors, rename file and move it
        if(empty($errors)) {
            // rename file
            $new_name = uniqid("itec_") . "." . $file_ext;
            $dest = "images/uploads/" . $new_name;
            // move to images/
            if(move_uploaded_file($file['tmp_name'], $dest)) {
                return $dest;
            } else {
                return false;
            }
        } else {
            return false;
        }
    } else if($file['error'] === 4) {
        return "images/web_designs/quiz_default_img.png";
    } else {
        return false;
    }
}

function createQuiz($title, $description, $file_dest, $question, $responseTrue, $responseFalse1, $responseFalse2, $responseFalse3) {
    global $conn;
    // var_dump($file_dest);

    $sql="INSERT INTO quizzes (title, description, author_id ,img_upload) VALUES (?,?,?,?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssis", $title, $description, $_SESSION['user_id'], $file_dest);
    $stmt->execute();
    if($stmt->affected_rows === 1) {
        $quizId = $stmt->insert_id;
        insertQuestion($quizId, $question, $responseTrue, $responseFalse1, $responseFalse2, $responseFalse3);
        header("Location: quizGame.php?id=" . $quizId);
    }  else {
        // output some error msg
    }
}

function insertQuestion($quizId, $question, $responseTrue, $responseFalse1, $responseFalse2, $responseFalse3){
    global $conn;
    $questionID = [];

    $sql = "INSERT INTO questions (quiz_id, ask_content) VALUES (?,?)";
    $stmt = $conn->prepare($sql);
    foreach($question as $singleQuestion){
        $stmt->bind_param("is", $quizId, $singleQuestion);
        $stmt->execute();
        if($stmt->affected_rows === 1) {
            array_push($questionID, $stmt->insert_id);
        }
    }

    $answer_true_id = insertResponse($quizId, $questionID, $responseTrue, $responseFalse1, $responseFalse2, $responseFalse3);

    $sql = "UPDATE questions SET true_answer_id=? WHERE id=? AND quiz_id=?";
    $stmt = $conn->prepare($sql);
    $i = 0;
    foreach($questionID as $singleQuestionID){
            $stmt->bind_param("iii", $answer_true_id[$i], $singleQuestionID, $quizId);
            $stmt->execute();
            $i++;
    }
}

function insertResponse($quizId, $questionID, $responseTrue, $responseFalse1, $responseFalse2, $responseFalse3){
    global $conn;
    $answer_true_id = [];

    $sql = "INSERT INTO responses (quiz_id, question_id, res_content) VALUES (?,?,?)";
    $stmt = $conn->prepare($sql);
    $i = 0;

    foreach($questionID as $singleQuestionID){
            $stmt->bind_param("iis", $quizId, $singleQuestionID,$responseTrue[$i]);
            $stmt->execute();
            if($stmt->affected_rows === 1) {
                array_push($answer_true_id, $stmt->insert_id);
            }

            $stmt->bind_param("iis", $quizId, $singleQuestionID, $responseFalse1[$i]);
            $stmt->execute();

            $stmt->bind_param("iis", $quizId, $singleQuestionID, $responseFalse2[$i]);
            $stmt->execute();

            $stmt->bind_param("iis", $quizId, $singleQuestionID, $responseFalse3[$i]);
            $stmt->execute();
            
            $i++;
    }

    return $answer_true_id;
}

?>
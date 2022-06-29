<?php

class Quiz {
    // attributes
    public $conn;

    // methods
    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function getBasicQuizzesInfo($limit = 12, $offset = 0){
        $sql = "SELECT qui.*, u.username  
                FROM quizzes qui join users u ON qui.author_id=u.id
                LIMIT ?,?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ii", $offset, $limit);
        $stmt->execute();
        $results = $stmt->get_result();

        return $results->fetch_all(MYSQLI_ASSOC);
    }

    public function getQuizInfo($quizID){
        $sql = "SELECT qui.*, u.username
                FROM quizzes qui join users u ON qui.author_id=u.id
                WHERE qui.id = ?";
            
        $quizID = (int)$quizID;
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $quizID);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_assoc();
    }

    public function getQuizQuestion($quizID){
        //get table question
       $sql = "SELECT que.id, que.quiz_id, que.ask_content
               FROM questions que
               WHERE que.quiz_id=?";
        
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $quizID);
        $stmt->execute();
        $resultQuestions = $stmt->get_result();  
        return $resultQuestions->fetch_all(MYSQLI_ASSOC);
    }

    public function getQuizQuestionResult($quizID, $questionID) {
        //get question result base on $quizID, $questionID
        $sql = "SELECT que.true_answer_id 
                FROM questions que
                WHERE que.quiz_id=? AND que.id=?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ii", $quizID, $questionID);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function getQuizResponse($quizID, $questionID){
        //get table response
        $sql = "SELECT *
               FROM responses res
               WHERE res.quiz_id=? and res.question_id=?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ii", $quizID, $questionID);
        $stmt->execute();
        $resultResponses = $stmt->get_result();
        return $resultResponses->fetch_all(MYSQLI_ASSOC);
    }
} 

?>
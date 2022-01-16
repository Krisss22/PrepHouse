<?php

namespace App\Services\Quiz;

class QuizDataQuestion
{
    public $id;
    public $answers = [];
    public $flagged = false;
    public $question = '';
    public $tagId = null;
    public $usersAnswer = null;

    public function __construct($questionId, $data = null)
    {
        $this->id = $questionId;

        if (isset($data)) {
            if (isset($data['flagged'])) {
                $this->flagged = $data['flagged'];
            }
            if (isset($data['question'])) {
                $this->question = $data['question'];
            }
            if (isset($data['tagId'])) {
                $this->tagId = $data['tagId'];
            }
            if (isset($data['usersAnswer'])) {
                $this->usersAnswer = $data['usersAnswer'];
            }
            if (isset($data['answers'])) {
                foreach ($data['answers'] as $answerId => $answer) {
                    $this->answers[] = new QuizDataQuestionAnswer($answerId, $answer);
                }
            }
        }
    }

    public function getHumanId(): int
    {
        return $this->id + 1;
    }

    public function isAnswerSelected($answerId): bool
    {
        return in_array($answerId, $this->usersAnswer);
    }
}

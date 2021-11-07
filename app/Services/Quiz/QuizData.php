<?php

namespace App\Services\Quiz;

class QuizData
{
    public $name = '';
    public $questions = [];

    public function __construct($data = null)
    {
        if (isset($data)) {
            if (isset($data['name'])) {
                $this->name = $data['name'];
            }
            if (isset($data['questions'])) {
                foreach ($data['questions'] as $questionId => $question) {
                    $this->questions[] = new QuizDataQuestion($questionId, $question);
                }
            }
        }
    }

    public function getPercent(): int
    {
        $questionsCount = count($this->questions);
        $answersCount = 0;
        foreach ($this->questions as $question) {
            if (!empty($question->usersAnswer)) {
                $answersCount++;
            }
        }

        return $answersCount > 0 ? floor(100 / ($questionsCount / $answersCount)) : 0;
    }

    public function getAnsweredQuestionsCount(): int
    {
        $answeredQuestionsCount = 0;
        foreach ($this->questions as $question) {
            if (!empty($question->usersAnswer)) {
                $answeredQuestionsCount++;
            }
        }

        return $answeredQuestionsCount;
    }
}

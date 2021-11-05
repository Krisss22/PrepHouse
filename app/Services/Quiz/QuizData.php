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
}

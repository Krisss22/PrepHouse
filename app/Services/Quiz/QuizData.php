<?php

namespace App\Services\Quiz;

class QuizData
{
    public const MIN_SUCCESSFUL_PERCENT = 70;

    public string $name = '';
    public array $questions = [];

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

    public function isSuccessful(): bool
    {
        if (count($this->questions) < $this->getAnsweredQuestionsCount()) {
            return false;
        }

        $successfulAnswers = 0;
        foreach ($this->questions as $question) {
            if (!empty($question->usersAnswer)) {
                $correctAnswersCount = 0;
                $userCorrectAnswersCount = 0;
                foreach ($question->answers as $answer) {
                    if ($answer->correct) {
                        $correctAnswersCount++;
                    }

                    foreach ($question->usersAnswer as $userAnswer) {
                        if ($answer->id === $userAnswer) {
                            $userCorrectAnswersCount++;
                        }
                    }
                }

                if ($userCorrectAnswersCount === 0) {
                    continue;
                }

                if ($correctAnswersCount === $userCorrectAnswersCount) {
                    $successfulAnswers++;
                } else {
                    $successfulAnswers += 0.5;
                }
            }
        }

        return ($successfulAnswers / count($this->questions) * 100) >= self::MIN_SUCCESSFUL_PERCENT;
    }
}

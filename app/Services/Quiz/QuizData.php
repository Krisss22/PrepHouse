<?php

namespace App\Services\Quiz;

class QuizData
{
    private const MIN_SUCCESSFUL_PERCENT = 70;
    private const MIN_ALMOST_SUCCESSFUL_PERCENT = 40;

    public string $name = '';
    public array $tags = [];
    public array $questions = [];

    public function __construct($data = null)
    {
        if (isset($data)) {
            if (isset($data['name'])) {
                $this->name = $data['name'];
            }
            if (isset($data['tags'])) {
                $this->tags = $data['tags'];
            }
            if (isset($data['questions'])) {
                foreach ($data['questions'] as $questionId => $question) {
                    $this->questions[] = new QuizDataQuestion($questionId, $question);
                }
            }
        }
    }

    public static function getMinimumSuccessfulPercent(): int
    {
        return self::MIN_SUCCESSFUL_PERCENT;
    }

    public static function getMinimumAlmostSuccessfulPercent(): int
    {
        return self::MIN_ALMOST_SUCCESSFUL_PERCENT;
    }

    public function getCorrectAnsweredPercent($tagId = 0): int
    {
        $questionsCount = 0;
        foreach ($this->questions as $question) {
            if ($tagId > 0 && $tagId !== $question->tagId) {
                continue;
            }
            $questionsCount++;
        }
        return $this->getSuccessfulAnswersCount($tagId) / count($this->questions) * 100;
    }

    public function getIncorrectAnsweredPercent(): int
    {
        return 100 - $this->getCorrectAnsweredPercent();
    }

    public function getProgressPercent(): int
    {
        $questionsCount = count($this->questions);
        $answersCount = $this->getAnsweredQuestionsCount();

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

    public function getUnsuccessfulAnswersCount(): int
    {
        return count($this->questions) - $this->getSuccessfulAnswersCount();
    }

    public function getSuccessfulAnswersCount($tagId = 0): int
    {
        $successfulAnswers = 0;
        foreach ($this->questions as $question) {
//            dd($question);
            if ($tagId > 0 && $question->tagId !== $tagId) {
                continue;
            }
            if (!empty($question->usersAnswer)) {
                $correctAnswersCount = 0;
                $userCorrectAnswersCount = 0;
                foreach ($question->answers as $answer) {
                    if ($answer->correct) {
                        $correctAnswersCount++;
                    }

                    foreach ($question->usersAnswer as $userAnswer) {
                        if ($answer->id === $userAnswer && $answer->correct) {
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

        return $successfulAnswers;
    }

    public function isSuccessful(): bool
    {
        if (count($this->questions) < $this->getAnsweredQuestionsCount()) {
            return false;
        }

        $successfulAnswers = $this->getSuccessfulAnswersCount();

        return ($successfulAnswers / count($this->questions) * 100) >= self::MIN_SUCCESSFUL_PERCENT;
    }
}

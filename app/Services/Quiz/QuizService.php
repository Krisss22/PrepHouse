<?php

namespace App\Services\Quiz;

use App\Models\QuizAction;
use Exception;
use Illuminate\Support\Facades\Log;

class QuizService
{
    /**
     * @return array
     */
    public static function getUnloggedQuizActionIds(): array
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (isset($_SESSION['unlogged_quiz_actions_id']) && is_array($_SESSION['unlogged_quiz_actions_id'])) {
            return $_SESSION['unlogged_quiz_actions_id'];
        }

        return [];
    }

    /**
     * @return int|null
     */
    public static function getLastUnloggedQuizActionId(): ?int
    {
        $quizActionIds = self::getUnloggedQuizActionIds();
        return count($quizActionIds) > 0 ? $quizActionIds[count($quizActionIds) - 1] : null;
    }

    /**
     * @param $userId
     * @return void
     * @throws Exception
     */
    public static function attachUserForQuizActions($userId): void
    {
        try {
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }

            $unloggedQuizActionIds = self::getUnloggedQuizActionIds();
            if (count($unloggedQuizActionIds) > 0) {
                foreach ($unloggedQuizActionIds as $quizActionId) {
                    QuizAction::findOrFail($quizActionId)->update([
                        'user_id' => $userId
                    ]);

                }
                unset($_SESSION['unlogged_quiz_actions_id']);
            }
        } catch (Exception $exception) {
            Log::error($exception->getMessage());
            throw $exception;
        }
    }

    public static function addUnloggedQuizActionId($quizActionId): void
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        if (isset($_SESSION['unlogged_quiz_actions_id']) && is_array($_SESSION['unlogged_quiz_actions_id'])) {
            $_SESSION['unlogged_quiz_actions_id'][] = $quizActionId;
        } else {
            $_SESSION['unlogged_quiz_actions_id'] = [$quizActionId];
        }
    }
}

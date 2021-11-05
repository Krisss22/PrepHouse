<?php

namespace App\Services\Quiz;

class QuizDataQuestionAnswer
{
    public $id;
    public $text = null;
    public $image = null;
    public $correct = false;

    public function __construct($answerId, $data = null)
    {
        $this->id = $answerId;

        if (isset($data)) {
            if (isset($data['text'])) {
                $this->text = $data['text'];
            }
            if (isset($data['image'])) {
                $this->image = $data['image'];
            }
            if (isset($data['correct'])) {
                $this->correct = $data['correct'];
            }
        }
    }

    public function getHumanId(): string
    {
        $alphabet = ['a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z'];
        if ($this->id >= count($alphabet)) {
            return (string) $this->id + 1;
        }
        return strtoupper($alphabet[$this->id]);
    }

    /**
     * @throws \Exception
     */
    public function getOption(): string
    {
        if (isset($this->text)) {
            return $this->text;
        }

        if (isset($this->image)) {
            return $this->image;
        }

        throw new \Exception('Text and image are null in answer ' . $this->id);
    }
}

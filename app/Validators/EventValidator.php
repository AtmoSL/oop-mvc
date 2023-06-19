<?php

namespace app\Validators;

class EventValidator extends Validator
{
    /**
     * Правила валидации
     * @return string[]
     */
    public function rules():array
    {
        return [
            "title"      => "required|min:1|max:65|onlyText",
            "genre_id"      => "required|int",
            "theater_id"      => "required|int",
            "is_published"      => "int",
            "date"      => "required|date",
        ];

    }
}
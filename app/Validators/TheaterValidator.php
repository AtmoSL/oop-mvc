<?php

namespace app\Validators;


/**
 * 
 * Валидатор для модели пользователя
 * 
 */
class TheaterValidator extends Validator
{
    /**
     * Правила валидации
     * @return string[]
     */
    public function rules():array
    {
        return [
            "title"      => "required|min:2|max:64|onlyText",
        ];

    }
}
<?php

namespace app\Validators;


/**
 * 
 * Валидатор для модели пользователя
 * 
 */
class UserValidator extends Validator
{
    /**
     * Правила валидации
     * @return string[]
     */
    public function rules()
    {
        return [
            "name"      => "required|min:2|max:32|onlyText",
            "email"     => "required|email|min:3|max:32",
            "password"  => "required|min:8:max:64|noSpace",
        ];

    }
}
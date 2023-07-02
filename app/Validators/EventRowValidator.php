<?php

namespace app\Validators;

class EventRowValidator extends Validator
{

    /**
     * @inheritDoc
     */
    public function rules(): array
    {
        return [
            "price"  => "required|int",
        ];
    }
}
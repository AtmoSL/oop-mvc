<?php

namespace app\Validators;

abstract class Validator
{
    abstract public function rules();

    public function validateAll($fields): array
    {
        $validateResult = [
            "isFullValidated" => true
        ];

        $allRules = $this->decodeRules($this->rules());

        foreach ($fields as $field => $fieldValue) {
            $fieldRules = $allRules[$field];
            $validateResult[$field] = $this->validateField($fieldValue, $fieldRules);
            if (isset($validateResult[$field]["isValidated"]) && !$validateResult[$field]["isValidated"])
                $validateResult["isFullValidated"] = false;
        }

        return $validateResult;
    }

    private function decodeRules($allRules): array
    {
        $rules = [];

        foreach ($allRules as $field => $fieldsRules) {
            $rules[$field] = explode('|', $fieldsRules);
            foreach ($rules[$field] as &$allFieldRules) {
                if (str_contains($allFieldRules, ":")) {
                    $newParams = explode(":", $allFieldRules);
                    $allFieldRules = [$newParams[0] => $newParams[1]];
                }
            }
        }

        return $rules;
    }

    private function validateField($fieldValue, $fieldRules): array
    {
        $validateResult = [];

        foreach ($fieldRules as $fieldRule) {
            switch ($fieldRule) {
                case "required":
                    if (empty($fieldValue)) {
                        $validateResult["isValidated"] = false;
                        $validateResult["errorMessages"][] = "Поле обязательно должно быть заполнено";
                    }
                    break;
                case "email":
                    if (!filter_var($fieldValue, FILTER_VALIDATE_EMAIL)) {
                        $validateResult["isValidated"] = false;
                        $validateResult["errorMessages"][] = "Поле должно быть формата email";
                    }
                    break;
                case "onlyText":
                    if (preg_match('/[^а-яА-Я\s]+/msiu', $fieldValue)) {
                        $validateResult["isValidated"] = false;
                        $validateResult["errorMessages"][] = "Поле может содержать только буквы и пробелы";
                    }
                    break;
                case "noSpace":
                    if (preg_match("|\s|", $fieldValue)) {
                        $validateResult["isValidated"] = false;
                        $validateResult["errorMessages"][] = "Поле не может содержать пробелы";
                    }
                    break;
                case (is_array($fieldRule) && array_key_first($fieldRule) == "max"):
                    if (strlen($fieldValue) > $fieldRule["max"]) {
                        {
                            $validateResult["isValidated"] = false;
                            $validateResult["errorMessages"][] = "Поле должно быть не длиннее " . $fieldRule["max"] . " символов";
                        }
                    }
                    break;
                case (is_array($fieldRule) && array_key_first($fieldRule) == "min"):
                    if (strlen($fieldValue) < $fieldRule["min"]) {
                        $validateResult["isValidated"] = false;
                        $validateResult["errorMessages"][] = "Поле должно быть длиннее " . $fieldRule["min"] . " символов";
                    }
                    break;
            }
        }

        return $validateResult;
    }
}
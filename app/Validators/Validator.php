<?php

namespace app\Validators;

abstract class Validator
{
    /**
     * Правила валидации
     * @return string[]
     */
    abstract public function rules(): array;

    /**
     * Валидация всех полей
     * @param $fields
     * @return true[]
     */
    public function validateAll($fields): array
    {
        $validateResult = [
            "isFullValidated" => true
        ];

        $allRules = $this->decodeRules($this->rules());

        //Проверка обязательных полей
        $validationRequired = $this->checkRequiredFields($fields, $allRules);
        if(!$validationRequired["isValidated"]){
            $validateResult["fields"] = $validationRequired["fields"];
            $validateResult["isFullValidated"] = false;
        }

        foreach ($fields as $field => $fieldValue) {
            $fieldRules = $allRules[$field];
            $validateResult["fields"][$field] = $this->validateField($fieldValue, $fieldRules);
            if (isset($validateResult["fields"][$field]["isValidated"]) && !$validateResult["fields"][$field]["isValidated"])
                $validateResult["isFullValidated"] = false;
        }

        return $validateResult;
    }

    /**
     * Расшифровка правил в массив
     * @param $allRules
     * @return array
     */
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

    /**
     * Валидация отдельного поля
     * @param $fieldValue
     * @param $fieldRules
     * @return array
     */
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
                    if (!preg_match("/^[\p{L&} -]+$/u", $fieldValue)) {
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
                case (is_array($fieldRule) && array_key_first($fieldRule) == "int"):
                    if (!is_int($fieldValue)) {
                        $validateResult["isValidated"] = false;
                        $validateResult["errorMessages"][] = "Поле должно быть числом";
                    }
                    break;
                case (is_array($fieldRule) && array_key_first($fieldRule) == "date"):
                    $date = explode("-", $fieldValue);
                    if (!checkdate($date[1], $date[2], $date[0])) {
                        $validateResult["isValidated"] = false;
                        $validateResult["errorMessages"][] = "Поле должно быть корректной датой";
                    }
                    break;
            }
        }

        return $validateResult;
    }

    /**
     * Валидация обязательных полей
     * @param $fields
     * @param $allRules
     * @return array|true[]
     */
    private function checkRequiredFields($fields, $allRules): array
    {
        $validateResult = [
            "isValidated" => true
        ];

        foreach ($allRules as $field => $fieldsRules) {
            if(in_array("required", $fieldsRules)
                && empty($fields[$field])){
                $validateResult["isValidated"] = false;
                $validateResult["fields"][$field]["isValidated"] = false;
                $validateResult["fields"][$field]["errorMessages"] = "Поле обязательно должно быть заполнено";
            }
        }

        return $validateResult;
    }
}
<?php

namespace MyApp\src;

abstract class Model
{
    const RULE_REQUIRED = 'required';

    public function loadData($data)
    {

        foreach ($data as $key => $value) {

             $this->{$key} = $value;

        }
    }

    abstract public function rules(): array;

    public array $errors=[];
    public function validate()
    {

        foreach ($this->rules() as $attribute => $rule) {
           $value = $this->{$attribute};

            $ruleName=$rule[0];
            if ($ruleName === self::RULE_REQUIRED && !$value){
                $this->addError($attribute,self::RULE_REQUIRED);
            }

        }

        return empty($this->errors);
    }

    public function addError(string $attribute, string $ruleName)
    {
        $message= $this->errorMessages()[$ruleName] ?? '';
        $this->errors[$attribute]=$message;
    }
    public function errorMessages()
    {
        return [
            self::RULE_REQUIRED=>'To pole musi zostać uzupełnione'
        ];
    }
    public function hasError($attribute)
    {


        return $this->errors[$attribute] ?? false;
    }

    public function getError($attribute)
    {

        return $this->errors[$attribute] ?? false;
    }

}
<?php

namespace app\models;

use app\components\operations\CustomerOperation;
use Yii;
use yii\base\Model;

/**
 * LoginForm is the model behind the login form.
 *
 * @property-read User|null $user
 *
 */
class RegistrationForm extends Model
{
    public $username;
    public $password;
    public $passwordConfirm;
    public $email;
    public $phone;

    private CustomerOperation $customerOperation;

    public function init()
    {
        parent::init();
        $this->customerOperation = new CustomerOperation();
    }


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['username', 'password', 'passwordConfirm', 'email'], 'required'],
            ['password', 'validatePassword'],
            ['email', 'email'],
            ['username', 'validateUsername'],
            ['email', 'validateEmail'],
            ['phone', 'validatePhone'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'username' => 'Логин',
            'password' => 'Пароль',
            'passwordConfirm' => 'Пароль повторно',
            'email' => 'email',
            'phone' => 'Номер телефона',
        ];
    }

    public function validatePassword($attribute)
    {
        if (!$this->hasErrors()) {
            if ($this->password !== $this->passwordConfirm) {
                $this->addError($attribute, 'Пароли не равны');
            }
        }
    }

    public function validateUsername($attribute)
    {
        $exist = $this->customerOperation->checkExistByUsername($this->username);
        if ($exist) {
            $this->addError($attribute, 'Логин уже используется');
        }
    }

    public function validateEmail($attribute)
    {
        $exist = $this->customerOperation->checkExistByEmail($this->email);
        if ($exist) {
            $this->addError($attribute, 'email уже используется');
        }
    }


    public function validatePhone($attribute)
    {
        $exist = $this->customerOperation->checkExistByPhone($this->phone);
        if ($exist) {
            $this->addError($attribute, 'Номер уже используется');
        }
    }
}

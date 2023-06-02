<?php

use app\models\User;
use yii\helpers\Html;
use yii\helpers\Url;

/** @var User $customer */

?>
Для подтверждение почты нажмите на ссылку
<?php echo Html::a('Подтвердить', Url::home('http').'confirmRegistration?token='.$customer->auth_key);
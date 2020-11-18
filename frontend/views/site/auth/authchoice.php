<?php

echo frontend\widgets\AuthChoice\AuthChoice::widget([
    'options' => ['class' => 'd-flex justify-content-center'],
    'baseAuthUrl' => ['auth/network/auth'],
    'popupMode' => true
]);


<?php

use yii\helpers\Url;

/** @var yii\web\View $this */

$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="jumbotron text-center bg-transparent">
        <h1 class="display-4">Hiring Challenge!</h1>

        <p class="lead">Desafio técnico para posições de software engineering ou tech lead de software engineers.</p>

        <p><a class="btn btn-lg btn-success" href="<?=Url::to(['invoices/index']);?>">Check Invoices</a></p>
    </div>


</div>

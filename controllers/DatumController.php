<?php
namespace app\controllers;
use yii\web\Controller;
use Yii;

class DatumController extends Controller
{
	public function actionIndex()
    {
        return $this->render('index');
    }
}  
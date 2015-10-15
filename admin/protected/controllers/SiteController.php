<?php
use Engine\Game;
use Engine\Player;
use Engine\Resource;
use Engine\Dice;
use Engine\EventManager;

class SiteController extends Controller
{
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		$this->render('index');
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}

	/**
	 * Displays the contact page
	 */
	public function actionRun()
	{
		require __DIR__.'/../../../vendor/autoload.php';

		$evm = new EventManager();

		$data = [];
		
		$collect = function($info) use (&$data){
			$data[] = $info;
		};
		
		$evm->on('game.run', $collect);
		$evm->on('game.addplayer', $collect);
		$evm->on('game.start', $collect);
		$evm->on('game.turn', $collect);
		$evm->on('game.end', $collect);
		$evm->on('player.start', $collect);
		$evm->on('player.attack', $collect);
		$evm->on('player.defense', $collect);
		$evm->on('player.damage', $collect);

		$game = new Game($evm);

		$game->addPlayers(array(
			new Player('Humam', 12, 1,2, new Resource('Espada longa', 1,2, new Dice(6)), $game),
			new Player('Orc', 20, 2,0, new Resource('Clava de madeira', 1, 0, new Dice(8)), $game),
#    new Player('Time Lord', 20, 1,2, new Resource('TARDIS', 1, 1, new Dice(10)), $game),
#    new Player('SuperMan', 20, 2,3, new Resource('punhos', 2, 3, new Dice(10)), $game),
		));

		$game->run(new Dice(20));

		$this->render('run', array('data'=>$data));
	}

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		$model=new LoginForm;

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login())
				$this->redirect(Yii::app()->user->returnUrl);
		}
		// display the login form
		$this->render('login',array('model'=>$model));
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}
}
<?php

Route::group(['prefix' => '/auth', 'namespace' => 'Auth', 'middleware' => ['web']], function (){

	Route::get('/signin', [
		'as'   => 'auth.signin',
		'uses' => 'SigninController@getSignin',
	]);

	Route::post('/signin', [
		'uses' => 'SigninController@postSignin',
	]);

	Route::get('/signup', [
		'as'   => 'auth.signup',
		'uses' => 'SignupController@getSignup',
	]);

	Route::post('/signup', [
		'uses' => 'SignupController@postSignup',
	]);

	Route::get('/signout', [
		'as'   => 'auth.signout',
		'uses' => 'SignoutController@getSignout',
	]);

	Route::get('/password/forgot', [
		'as'   => 'auth.password.forgot',
		'uses' => 'PasswordForgotController@getPasswordForgot',
	]);

	Route::post('/password/forgot', [
		'uses' => 'PasswordForgotController@postPasswordForgot',
	]);

	Route::get('/account/activate/{user_id}/{token}', [
		'as' => 'auth.account.activate',
		'uses' => 'AccountActivateController@getAccountActivate',
	])->where(['user_id' => '[0-9]+', 'token' => '[a-zA-Z0-9]+']);

	Route::get('/password/reset/{user_id}/{token}', [
		'as' => 'auth.password.reset',
		'uses' => 'PasswordResetController@getPasswordReset',
	])->where(['user_id' => '[0-9]+', 'token' => '[a-zA-Z0-9]+']);

});

Route::group(['middleware' => ['web']], function () {

	Route::get('/', [
		'as'   => 'dashboard',
		'uses' => 'IndexController@getDashboard',
	]);

	Route::get('/programs/list', [
		'as'   => 'program.list',
		'uses' => 'ProgramController@getProgramList',
	]);

	Route::get('/programs/configuration', [
		'as'   => 'program.configuration',
		'uses' => 'ProgramController@getProgramConfiguration',
	]);

	Route::get('/programs/{id}/new', [
		'as'   => 'program.new',
		'uses' => 'ProgramController@getProgramNew',
	]);

	Route::post('/programs/{id}/new', [
		'uses' => 'ProgramController@postProgramNew',
	]);

	Route::get('/programs/{id}/configuration', [
		'as'   => 'program.list.configuration',
		'uses' => 'ProgramController@getProgramListConfiguration',
	]);

	Route::get('/programs/{id}/statistics', [
		'as'   => 'program.statistics',
		'uses' => 'ProgramController@getProgramStatistics',
	]);

	Route::get('/widgets/player/list', [
		'as'   => 'widget.player',
		'uses' => 'WidgetController@getPlayerList',
	]);

	Route::get('/widgets/player/new', [
		'as' => 'widget.player.new',
		'uses' => 'WidgetController@getPlayerNew',
	]);

	Route::post('/widgets/player/new', [
		'uses' => 'WidgetController@postPlayerNew',
	]);

	Route::get('/widgets/player/{id}/edit', [
		'as' => 'widget.player.edit',
		'uses' => 'WidgetController@getPlayerEdit',
	])->where(['id' => '[0-9]+']);

	Route::post('/widgets/player/{id}/edit', [
		'uses' => 'WidgetController@postPlayerEdit',
	])->where(['id' => '[0-9]+']);

	Route::get('/widgets/player/{id}/delete', [
		'as' => 'widget.player.delete',
		'uses' => 'WidgetController@getPlayerDelete',
	])->where(['id' => '[0-9]+']);

	Route::get('/widgets/locker/list', [
		'as'   => 'widget.locker',
		'uses' => 'WidgetController@getLockerList',
	]);

	Route::get('/widgets/locker/new', [
		'as' => 'widget.locker.new',
		'uses' => 'WidgetController@getLockerNew',
	]);

	Route::post('/widgets/locker/new', [
		'uses' => 'WidgetController@postLockerNew',
	]);

	Route::get('/widgets/locker/{id}/edit', [
		'as' => 'widget.locker.edit',
		'uses' => 'WidgetController@getLockerEdit',
	])->where(['id' => '[0-9]+']);

	Route::post('/widgets/locker/{id}/edit', [
		'uses' => 'WidgetController@postLockerEdit',
	])->where(['id' => '[0-9]+']);

	Route::get('/widgets/locker/{id}/delete', [
		'as' => 'widget.locker.delete',
		'uses' => 'WidgetController@getLockerDelete',
	])->where(['id' => '[0-9]+']);


	//Referral
	Route::get('/r/{referral_id}', [
		'as' => 'referral.redirect',
		'uses' => 'ReferralController@getReferralRedirect',
	])->where(['referral_id' => '[a-zA-Z0-9]+']);

	Route::get('/referrals/list', [
		'as'   => 'referral.list',
		'uses' => 'ReferralController@getReferralList',
	]);


	//Setting
	Route::get('/settings/personal', [
		'as'   => 'setting.personal',
		'uses' => 'SettingController@getPersonal',
	]);

	Route::post('/settings/personal', [
		'uses' => 'SettingController@postPersonal',
	]);

	Route::get('/settings/payout', [
		'as'   => 'setting.payout',
		'uses' => 'SettingController@getPayout',
	]);

	Route::post('/settings/payout', [
		'uses' => 'SettingController@postPayout',
	]);

	Route::get('/settings/account', [
		'as'   => 'setting.account',
		'uses' => 'SettingController@getAccount',
	]);

	Route::post('/settings/account', [
		'uses' => 'SettingController@postAccount',
	]);

	Route::get('/settings/password', [
		'as'   => 'setting.password',
		'uses' => 'SettingController@getPassword',
	]);

	Route::post('/settings/password', [
		'uses' => 'SettingController@postPassword',
	]);

	Route::get('/settings/password/change/{token}', [
		'as'   => 'setting.password.change',
		'uses' => 'SettingController@getPasswordChange',
	])->where(['token' => '[a-zA-Z0-9]+']);

	Route::get('/settings/history', [
		'as'   => 'setting.history',
		'uses' => 'SettingController@getHistory',
	]);


	//Withdraw
	Route::get('/payouts/history', [
		'as'   => 'payout.history',
		'uses' => 'PayoutController@getHistory',
	]);

	Route::get('/payouts/withdraw', [
		'as'   => 'payout.withdraw',
		'uses' => 'PayoutController@getWithdraw',
	]);

	Route::post('/payouts/withdraw', [
		'uses' => 'PayoutController@postWithdraw',
	]);

	Route::get('/payouts/withdraw/confirm/{token}', [
		'as'   => 'payout.withdraw.confirm',
		'uses' => 'PayoutController@getWithdrawConfirm',
	])->where(['token' => '[a-zA-Z0-9]+']);


	//Rank Users
	Route::get('/top/today', [
		'as'   => 'rank.today',
		'uses' => 'RankController@getTodayRank',
	]);

	Route::get('/top/yesterday', [
		'as'   => 'rank.yesterday',
		'uses' => 'RankController@getYesterdayRank',
	]);

	Route::get('/top/week', [
		'as'   => 'rank.week',
		'uses' => 'RankController@getWeekRank',
	]);

	Route::get('/top/month', [
		'as'   => 'rank.month',
		'uses' => 'RankController@getMonthRank',
	]);

	Route::get('/top/all', [
		'as'   => 'rank.all',
		'uses' => 'RankController@getAllRank',
	]);

	//Support
	Route::get('/support/faq', [
		'as'   => 'support.faq',
		'uses' => 'SupportController@getFaq',
	]);

	Route::get('/support/contact', [
		'as'   => 'support.contact',
		'uses' => 'SupportController@getContact',
	]);

	Route::post('/support/contact', [
		'uses' => 'SupportController@postContact',
	]);


	//API
	Route::get('/api/notification', [
		'as'   => 'api.notification',
		'uses' => 'ApiController@getNotification',
	]);

	Route::get('/api/chat/authorize', [
		'as'   => 'api.chat.authorize',
		'uses' => 'ApiController@getChatAuthorize',
	]);

		Route::get('/api/chat/information', [
		'as'   => 'api.chat.information',
		'uses' => 'ApiController@getChatInformation',
	]);
});

Route::group(['prefix' => '/admin', 'namespace' => 'Admin', 'middleware' => ['web', 'admin']], function (){
	Route::get('/dashboard', [
		'as'   => 'admin.dashboard',
		'uses' => 'DashboardController@getDashboard',
	]);

	//Users
	Route::get('/users/list', [
		'as'   => 'admin.user.list',
		'uses' => 'UserController@getUser',
	]);

	Route::get('/users/{id}/details', [
		'as' => 'admin.user.detail',
		'uses' => 'UserController@getUserDetail',
	])->where(['id' => '[0-9]+']);

	Route::get('/users/{id}/details/withdraws', [
		'as' => 'admin.user.detail.withdraw',
		'uses' => 'UserController@getUserDetailWithdraw',
	])->where(['id' => '[0-9]+']);

	//Withdraws
	Route::get('/withdraws/list', [
		'as'   => 'admin.withdraw.list',
		'uses' => 'WithdrawController@getWithdraw',
	]);

	Route::get('/withdraws/{id}/details', [
		'as' => 'admin.withdraw.detail',
		'uses' => 'WithdrawController@getWithdrawDetail',
	])->where(['id' => '[0-9]+']);

	Route::post('/withdraws/{id}/confirm', [
		'as' => 'admin.withdraw.confirm',
		'uses' => 'WithdrawController@postWithdrawConfirm',
	])->where(['id' => '[0-9]+']);

	Route::post('/withdraws/{id}/cancel', [
		'as' => 'admin.withdraw.cancel',
		'uses' => 'WithdrawController@postWithdrawCancel',
	])->where(['id' => '[0-9]+']);

	Route::post('/withdraws/{id}/resend', [
		'as' => 'admin.withdraw.resend',
		'uses' => 'WithdrawController@postWithdrawResend',
	])->where(['id' => '[0-9]+']);
});

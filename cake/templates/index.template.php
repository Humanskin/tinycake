<?php
	error_reporting(E_ALL & ~E_NOTICE);

	// FIXME: using set_include_path to include path
	include_once('../framework/kernel/core.php');
	include_once('../framework/kernel/controller.php');

	$core = Core::getInstance();
	 
	$core->loadConfig(&$_SERVER['HTTP_HOST']);
	
	list($controller, $action) = $core->rebuildUrl($_SERVER['REQUEST_URI']);

	$c = $core->loadController($controller);

	// TODO: 可以根据配置文件，确认是否需要session
	// TODO： 还是让具体的action自己来决定呢？ 根据配置文件，决定是否需要全局session开启
	// 		对于不需要全局session开启的状态，让action自己去决定就好了，谁用谁知道
	$core->loadSession();
	
	// 构造自定义日志
	// TODO: 点入日志的记录路径应该在配置文件中写明
	// TODO: 还需要考虑 控制器效率日志和模型的效率日志
	if($core->getConfig['clicklog'])
		$core->clickLog($core->getConfig['clicklog'].'/clicklog.'.date('Y-m-d'));
	// 结束写入自定义日志
	
	if(method_exists($c, $action))
		$c->$action();
	else
		$c->main();
	


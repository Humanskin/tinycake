<?php
include_once('commoncontroller.php');
include_once('cls.resizeimage.php');

class test extends CommonController
{
	public function __construct()
	{
	}
	
	function index()
	{
		// NOTE:如果此 action 不需要用到数据库或者模板引擎，请注释掉相应的代码，以提高速度
		parent::initDb(Core::getInstance()->getConfig('database'));
		parent::initTemplateEngine('./v/default/','./v/_run/');
		
        // Do something for test    
        print_r($this->getModel('mproject')->_config);
	}
	
	public function test()
	{
		$a = new ImageResizer('/Data/tinycake/install/data/1.jpeg');
		$a->scaleToHeight(300);
		$a->cutImageWidth(300,'right');

		$a->showImage();
	}

	public function phpinfo()
        {
		phpinfo();
        }
}


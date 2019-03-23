<?php  

namespace app\mobile\controller;

use think\Controller;
use think\Db;
use think\Exception;
use org\Verify;
use think\Request;
use QL\QueryList;

class About extends Controller
{
	public function about(){

		 //底部信息
        $info = Db::table('snake_about')->find();
        $this->assign('info',$info);

        //友情链接
        $link = Db::table('snake_link')->order('id')->select();
        $this->assign('link',$link);

        
		$about =Db::table('snake_aboutus')->find();
		$this->assign('about',$about);
		return view(); 
	}
}
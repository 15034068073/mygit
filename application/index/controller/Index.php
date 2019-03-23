<?php
namespace app\index\controller;

use think\Controller;
use think\Db;
use think\Exception;
use org\Verify;
use think\Request;
use QL\QueryList;

class Index extends Controller
{
    public function index()
    {
        //学院联盟
        $school = Db::table('snake_school')->order('id')->limit(3)->select();
        $this->assign('school',$school);

        $school1 = Db::table('snake_school')->order('id')->limit(3,3)->select();
        $this->assign('school1',$school1);
        

        $intro = Db::table('snake_aboutus')->find();
        $this->assign('intro',$intro);
        //底部信息
        $info = Db::table('snake_about')->find();
        $this->assign('info',$info);

        //友情链接
        $link = Db::table('snake_link')->order('id')->select();
        $this->assign('link',$link);

        $banner = Db::table('snake_banner')->order('sort')->select();
        $this->assign('banner',$banner);
        
        //新闻动态
        $news1 = Db::table('snake_news')->order('add_time desc')->limit(3)->select();
        $this->assign('news1',$news1);   
        
        $news2 = Db::table('snake_news')->order('add_time desc')->limit(3,3)->select();
        $this->assign('news2',$news2);  

        //技术领域
        $jishu = Db::table('snake_jtype')->order('id')->select();
        $this->assign('jishu',$jishu); 
        return view();
    }


}



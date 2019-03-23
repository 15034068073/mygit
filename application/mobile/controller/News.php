<?php
namespace app\mobile\controller;

use think\Controller;
use think\Db;
use think\Exception;
use org\Verify;
use think\Request;
use QL\QueryList;

class News extends Controller
{
    public function news()
    {
         //底部信息
        $info = Db::table('snake_about')->find();
        $this->assign('info',$info);

        //友情链接
        $link = Db::table('snake_link')->order('id')->select();
        $this->assign('link',$link);


    	$type = Db::table('snake_ntype')->select();
        $this->assign('type',$type);

    	$id = input('param.id');
    	if($id){
    		$news = Db::name('news')->where('type='.$id)->order('add_time desc')->paginate(6);
    	}else{
    		$news = Db::name('news')->order('add_time desc')->paginate(6);
    	}
    	$this->assign('news',$news);
    	$this->assign('cat_id',$id);


        return view();
    }

    public function detail(){
        $id = input('param.id');
        if($id){
            $new = Db::table("snake_news")->where('id='.$id)->find();
            $this->assign('new',$new);

            $page_view=$new['page_view']+1;

            db('news')->where(['id'=>$id])->update(['page_view'=>$page_view]);



            $prev = Db::name('news')->where('id','<',$id)->order('id desc')->limit(1)->find();
            $next = Db::name('news')->where('id','>',$id)->order('id asc')->limit(1)->find();
            $this -> assign('prev',$prev);
            $this -> assign('next',$next);
        }


         //底部信息
        $info = Db::table('snake_about')->find();
        $this->assign('info',$info);

        //友情链接
        $link = Db::table('snake_link')->order('id')->select();
        $this->assign('link',$link);


        return view();
    }


}



<?php

namespace app\index\controller;

use think\Controller;
use think\Db;
use think\Exception;
use org\Verify;
use think\Request;
use QL\QueryList;

class Jishu extends Controller
{
	public function jishu()
    {
         //底部信息
        $info = Db::table('snake_about')->find();
        $this->assign('info',$info);

        //友情链接
        $link = Db::table('snake_link')->order('id')->select();
        $this->assign('link',$link);


    	$type = Db::table('snake_jtype')->select();
        $this->assign('type',$type);

    	$id = input('param.id');
    	if($id){
    		$articles = Db::name('jishu')->where('type='.$id)->order('add_time desc')->paginate(6);
    	}else{
    		$articles = Db::name('jishu')->order('add_time desc')->paginate(6);
    	}
    	$this->assign('articles',$articles);
    	$this->assign('cat_id',$id);


        return view();
    }

    public function detail(){
        $id = input('param.id');
        if($id){
            $jishu = Db::table("snake_jishu")->where('id='.$id)->find();
            $this->assign('jishu',$jishu);

            $page_view=$jishu['page_view']+1;

            db('jishu')->where(['id'=>$id])->update(['page_view'=>$page_view]);



            $prev = Db::name('jishu')->where('id','<',$id)->order('id desc')->limit(1)->find();
            $next = Db::name('jishu')->where('id','>',$id)->order('id asc')->limit(1)->find();
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
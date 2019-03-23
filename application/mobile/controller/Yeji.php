<?php

namespace app\mobile\controller;

use think\Controller;
use think\Db;
use think\Exception;
use org\Verify;
use think\Request;
use QL\QueryList;

class Yeji extends Controller
{
	public function yeji()
    {
		 //底部信息
        $info = Db::table('snake_about')->find();
        $this->assign('info',$info);

        //友情链接
        $link = Db::table('snake_link')->order('id')->select();
        $this->assign('link',$link);

		$type = Db::table('snake_ptype')->select();
        $this->assign('type',$type);

    	$id = input('param.id');
    	if($id){
    		$articles = Db::name('product')->where('type='.$id)->order('add_time desc')->paginate(6);
    	}else{
    		$articles = Db::name('product')->order('add_time desc')->paginate(6);
    	}
    	$this->assign('articles',$articles);
    	$this->assign('cat_id',$id);


        return view();
	}

    public function detail(){
        $id = input('param.id');
        if($id){
            $yeji = Db::table("snake_product")->where('id='.$id)->find();
            $this->assign('yeji',$yeji);

            $page_view=$yeji['page_view']+1;

            db('product')->where(['id'=>$id])->update(['page_view'=>$page_view]);

            $prev = Db::name('product')->where('id','<',$id)->order('id desc')->limit(1)->find();
            $next = Db::name('product')->where('id','>',$id)->order('id asc')->limit(1)->find();
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
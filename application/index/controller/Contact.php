<?php
namespace app\index\controller;

use think\Controller;
use think\Db;
use think\Exception;
use think\Request;
use QL\QueryList;

class Contact extends Controller
{
    public function contact()
    {
         //底部信息
        $info = Db::table('snake_about')->find();
        $this->assign('info',$info);

        //友情链接
        $link = Db::table('snake_link')->order('id')->select();
        $this->assign('link',$link);

        
        $info = Db::table('snake_about')->find();
        $this->assign('info',$info);
        return view();
    }


    public function liuyan(){
        if(request()->isPost()){
            $data = input('post.');
            unset($data['file']);
            $data['add_time'] = date('Y-m-d H:i:s');
            $article=Db::table('snake_message')->insert($data);
            return alert("留言成功，等待回复",'contact/contact');
        }
        return $this->fetch();
    }
}



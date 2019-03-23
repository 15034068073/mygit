<?php
namespace app\index\controller;

use think\Controller;
use think\Db;
use think\Exception;
use think\Request;
use QL\QueryList;

class Job extends Controller
{
    //校园招聘
    public function job()
    {
         //底部信息
         $info = Db::table('snake_about')->find();
         $this->assign('info',$info);

        //友情链接
         $link = Db::table('snake_link')->order('id')->select();
         $this->assign('link',$link);

         $res = db('zptype')->order('id desc')->select();
         $res = collection($res)->toArray();
         $this->assign('res', $res);
          return view();
    }

    public function jobd($id)
    {
        //底部信息
         $info = Db::table('snake_about')->find();
         $this->assign('info',$info);

        //友情链接
         $link = Db::table('snake_link')->order('id')->select();
         $this->assign('link',$link);
         //类型
         $type = db('zptype')->order('id desc')->select();
         $type = collection($type)->toArray();
         $this->assign('type', $type);

         //确定类型
         $single_type = db('zptype')->find($id);
         $this->assign('single_type', $single_type);

        $res = db('recruit')->where(['type'=>$id])->order('id desc')->select();
        $this->assign('res', $res);

        $this->assign('zhaoping', f_get('zhaoping'));

        return view();
    }

    //社会招聘
    public function sh()
    {
        //底部信息
         $info = Db::table('snake_about')->find();
         $this->assign('info',$info);

        //友情链接
         $link = Db::table('snake_link')->order('id')->select();
         $this->assign('link',$link);

        $res = db('recruit')->where(['type'=>2])->order('id desc')->select();
        $res = collection($res)->toArray();
        $this->assign('res', $res);
        return view();
    }

    public function shd($id)
    {
        //底部信息
         $info = Db::table('snake_about')->find();
         $this->assign('info',$info);

        //友情链接
         $link = Db::table('snake_link')->order('id')->select();
         $this->assign('link',$link);

        $res = db('recruit')->find($id);
        $this->assign('res', $res);

        return view();
    }

    //人才战略
    public function zl()
    {
        //底部信息
         $info = Db::table('snake_about')->find();
         $this->assign('info',$info);

        //友情链接
         $link = Db::table('snake_link')->order('id')->select();
         $this->assign('link',$link);

         $this->assign('res', f_get("zhaoping"));
        return view();
    }


}



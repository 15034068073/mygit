<?php
namespace app\mobile\controller;

use think\Controller;
use think\Db;
use think\Exception;
use think\Request;
use QL\QueryList;

class Job extends Controller
{
    public function job()
    {
         //底部信息
         $info = Db::table('snake_about')->find();
         $this->assign('info',$info);

        //友情链接
         $link = Db::table('snake_link')->order('id')->select();
         $this->assign('link',$link);

         $job = Db::table('snake_job')->order('id')->select();
         $this->assign('job',$job);

         $id = input('param.id');
         if($id){
              $content = Db::table('snake_job')->where('id='.$id)->value('content');

         }else{
              $content = Db::table('snake_job')->order('id')->limit(1)->value('content');
         }
         $this->assign('content',$content);
         $this->assign('id',$id);
          return view();
    }


}



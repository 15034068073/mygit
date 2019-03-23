<?php
/**
 * 新闻分类
 * @Author: wgq
 * @Date:   2018-06-02 11:56:17
 */
namespace app\admin\controller;

use app\admin\controller\Base;

class Zptype extends Base
{

    public function index()
    {
        $res = db('zptype')->order('id asc')->select();
        $res = collection($res)->toArray();
        $this->assign('res',$res);
        return view();
    }

    public function add()
    {
        if (request()->isPost()) {
            $data = request()->post();
            $file = request()->file('img');
            $res = model('ZptypeModel')->add($data, $file);
            if ($res[0] == 200) {
                Jump($res[1], url('index'));
            } else {
                Jump($res[1]);
            }
        }
        return view();
    }

    public function edit($id)
    {
        if (request()->isPost()) {
            $data = request()->post();
            $file = request()->file('img');
            $res = model('ZptypeModel')->edit($data, $id, $file);
            if ($res[0] == 200) {
                Jump($res[1], url('index'));
            } else {
                Jump($res[1]);
            }
        }
        $res = db('zptype')->find($id);
        $this->assign('res',$res);
        return view();
    }

        //招聘简介
    public function summary()
    {
        if (request()->isPost()) {
            $data = request()->post();

            f_set("zhaoping", $data);
            Jump("修改成功",url('index'));
        }
        $this->assign('zhaoping', f_get('zhaoping'));
        return view();
    }
}
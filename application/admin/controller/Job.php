<?php
/**
 * 发布招聘
 * @Author: wgq
 * @Date:   2018-06-02 11:56:17
 */
namespace app\admin\controller;

use app\admin\controller\Base;

class Job extends Base
{
    public function index()
    {
        $where = [];
        $search = request()->get('search');
        if ($search) {
            $where['title'] = ['like', '%'.$search.'%'];
        }
        $res = fenye_model("RecruitModel", $where, ['gettype']);
        $this->assign('res', $res[0]);
        $this->assign('page',$res[1]);
        return view();
    }

    public function add()
    {
        if (request()->isPost()) {
            $data = request()->post();
            $file = request()->file('img');
            $res = model('RecruitModel')->add($data, $file);
            if ($res[0] == 200) {
                Jump($res[1], url('index'));
            } else {
                Jump($res[1]);
            }
        }
        $type = db('zptype')->select();
        $type = collection($type)->toArray();
        $this->assign('type', $type);
        return view();
    }

    public function edit($id)
    {
        if (request()->isPost()) {
            $data = request()->post();
            $file = request()->file('img');
            $res = model('RecruitModel')->edit($data, $id, $file);
            if ($res[0] == 200) {
                Jump($res[1], url('index'));
            } else {
                Jump($res[1]);
            }
        }

        $type = db('zptype')->select();
        $type = collection($type)->toArray();
        $this->assign('type', $type);

        $res = db('recruit')->find($id);
        $this->assign('res',$res);
        return view();
    }

    //招聘简介
    public function summary()
    {
        if (request()->isPost()) {
            $data = request()->post();

            f_set("zhaoping", $data['content']);
            Jump("修改成功",url('index'));
        }
        $this->assign('zhaoping', f_get('zhaoping'));
        return view();
    }
}
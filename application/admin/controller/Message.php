<?php
// +----------------------------------------------------------------------
// | snake
// +----------------------------------------------------------------------
// | Copyright (c) 2016~2022 http://baiyf.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: NickBai <1902822973@qq.com>
// +----------------------------------------------------------------------
namespace app\admin\controller;

use app\admin\model\MessageModel;

class Message extends Base
{
    // 文章列表
    public function index()
    {
        if(request()->isAjax()){

            $param = input('param.');

            $limit = $param['pageSize'];
            $offset = ($param['pageNumber'] - 1) * $limit;

            $where = [];
            if (!empty($param['searchText'])) {
                $where['name'] = ['like', '%' . $param['searchText'] . '%'];
            }

            $message = new MessageModel();
            $selectResult = $message->getMessageByWhere($where, $offset, $limit);

            foreach($selectResult as $key=>$vo){
                //$selectResult[$key]['img'] = '<img src="' . $vo['img'] . '" width="40px" height="40px">';
                $selectResult[$key]['operate'] = showOperate($this->makeButton($vo['id']));
            }

            $return['total'] = $message->getAllMessage($where);  // 总数据
            $return['rows'] = $selectResult;

            return json($return);
        }

        return $this->fetch();
    }

    // 添加文章
    public function messageAdd()
    {
        if(request()->isPost()){
            $param = input('post.');

            unset($param['file']);
            // $param['add_time'] = date('Y-m-d H:i:s');

            $message = new MessageModel();
            $flag = $message->addMessage($param);

            return json(msg($flag['code'], $flag['data'], $flag['msg']));
        }

        return $this->fetch();
    }

    public function messageEdit()
    {
        $message = new MessageModel();
        if(request()->isPost()){

            $param = input('post.');
            unset($param['file']);
            $flag = $message->editMessage($param);

            return json(msg($flag['code'], $flag['data'], $flag['msg']));
        }

        $id = input('param.id');
        $this->assign([
            'message' => $message->getOneMessage($id)
        ]);
        return $this->fetch();
    }

    public function messageDel()
    {
        $id = input('param.id');

        $message = new MessageModel();
        $flag = $message->delMessage($id);
        return json(msg($flag['code'], $flag['data'], $flag['msg']));
    }

   

    /**
     * 拼装操作按钮
     * @param $id
     * @return array
     */
    private function makeButton($id)
    {
        return [
            '查看' => [
                'auth' => 'message/messageedit',
                'href' => url('message/messageedit', ['id' => $id]),
                'btnStyle' => 'primary',
                'icon' => 'fa fa-paste'
            ],
            '删除' => [
                'auth' => 'message/messagedel',
                'href' => "javascript:messageDel(" . $id . ")",
                'btnStyle' => 'danger',
                'icon' => 'fa fa-trash-o'
            ]
        ];
    }
}

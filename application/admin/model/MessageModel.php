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
namespace app\admin\model;

use think\Model;

class MessageModel extends Model
{
    // 确定链接表名
    protected $table = 'snake_message';

    /**
     * 查询留言
     * @param $where
     * @param $offset
     * @param $limit
     */
    public function getMessageByWhere($where, $offset, $limit)
    {
        return $this->where($where)->limit($offset, $limit)->order('id desc')->select();
    }

    /**
     * 根据搜索条件获取所有的留言数量
     * @param $where
     */
    public function getAllMessage($where)
    {
        return $this->where($where)->count();
    }

    /**
     * 添加留言
     * @param $param
     */
    public function addMessage($param)
    {
        try{
            $result = $this->validate('MessageValidate')->save($param);
            if(false === $result){
                // 验证失败 输出错误信息
                return msg(-1, '', $this->getError());
            }else{

                return msg(1, url('message/index'), '添加留言成功');
            }
        }catch (\Exception $e){
            return msg(-2, '', $e->getMessage());
        }
    }

    /**
     * 编辑留言信息
     * @param $param
     */
    public function editMessage($param)
    {
        try{

            $result = $this->validate('MessageValidate')->save($param, ['id' => $param['id']]);

            if(false === $result){
                // 验证失败 输出错误信息
                return msg(-1, '', $this->getError());
            }else{

                return msg(1, url('message/index'), '编辑留言成功');
            }
        }catch(\Exception $e){
            return msg(-2, '', $e->getMessage());
        }
    }

    /**
     * 根据留言的id 获取留言的信息
     * @param $id
     */
    public function getOneMessage($id)
    {
        return $this->where('id', $id)->find();
    }

    /**
     * 删除留言
     * @param $id
     */
    public function delMessage($id)
    {
        try{

            $this->where('id', $id)->delete();
            return msg(1, '', '删除留言成功');

        }catch(\Exception $e){
            return msg(-1, '', $e->getMessage());
        }
    }
}
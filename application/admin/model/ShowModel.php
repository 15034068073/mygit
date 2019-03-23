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

class ShowModel extends Model
{
    // 确定链接表名
    protected $table = 'snake_show';

    /**
     * 查询展会信息
     * @param $where
     * @param $offset
     * @param $limit
     */
    public function getShowByWhere($where, $offset, $limit)
    {
        return $this->where($where)->limit($offset, $limit)->order('id desc')->select();
    }

    /**
     * 根据搜索条件获取所有的展会信息数量
     * @param $where
     */
    public function getAllShow($where)
    {
        return $this->where($where)->count();
    }

    /**
     * 添加展会信息
     * @param $param
     */
    public function addShow($param)
    {
        try{
            $result = $this->validate('ShowValidate')->save($param);
            if(false === $result){
                // 验证失败 输出错误信息
                return msg(-1, '', $this->getError());
            }else{

                return msg(1, url('Show/index'), '添加展会信息成功');
            }
        }catch (\Exception $e){
            return msg(-2, '', $e->getMessage());
        }
    }

    /**
     * 编辑展会信息信息
     * @param $param
     */
    public function editShow($param)
    {
        try{

            $result = $this->validate('ShowValidate')->save($param, ['id' => $param['id']]);

            if(false === $result){
                // 验证失败 输出错误信息
                return msg(-1, '', $this->getError());
            }else{

                return msg(1, url('Show/index'), '编辑展会信息成功');
            }
        }catch(\Exception $e){
            return msg(-2, '', $e->getMessage());
        }
    }

    /**
     * 根据展会信息的id 获取展会信息的信息
     * @param $id
     */
    public function getOneShow($id)
    {
        return $this->where('id', $id)->find();
    }

    /**
     * 删除展会信息
     * @param $id
     */
    public function delShow($id)
    {
        try{

            $this->where('id', $id)->delete();
            return msg(1, '', '删除展会信息成功');

        }catch(\Exception $e){
            return msg(-1, '', $e->getMessage());
        }
    }
}
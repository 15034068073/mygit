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

class JobModel extends Model
{
    // 确定链接表名
    protected $table = 'snake_job';

    /**
     * 查询
     * @param $where
     * @param $offset
     * @param $limit
     */
    public function getJobByWhere($where, $offset, $limit)
    {
        return $this->where($where)->limit($offset, $limit)->order('id desc')->select();
    }

    /**
     * 根据搜索条件获取所有的数量
     * @param $where
     */
    public function getAllJob($where)
    {
        return $this->where($where)->count();
    }

    /**
     * 添加
     * @param $param
     */
    public function addJob($param)
    {
        try{
            $result = $this->validate('JobValidate')->save($param);
            if(false === $result){
                // 验证失败 输出错误信息
                return msg(-1, '', $this->getError());
            }else{

                return msg(1, url('job/index'), '添加成功');
            }
        }catch (\Exception $e){
            return msg(-2, '', $e->getMessage());
        }
    }

    /**
     * 编辑信息
     * @param $param
     */
    public function editJob($param)
    {
        try{

            $result = $this->validate('JobValidate')->save($param, ['id' => $param['id']]);

            if(false === $result){
                // 验证失败 输出错误信息
                return msg(-1, '', $this->getError());
            }else{

                return msg(1, url('job/index'), '编辑成功');
            }
        }catch(\Exception $e){
            return msg(-2, '', $e->getMessage());
        }
    }

    /**
     * 根据的id 获取的信息
     * @param $id
     */
    public function getOneJob($id)
    {
        return $this->where('id', $id)->find();
    }

    /**
     * 删除
     * @param $id
     */
    public function delJob($id)
    {
        try{

            $this->where('id', $id)->delete();
            return msg(1, '', '删除成功');

        }catch(\Exception $e){
            return msg(-1, '', $e->getMessage());
        }
    }
}
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

class JtypeModel extends Model
{
    // 确定链接表名
    protected $table = 'snake_jtype';

    /**
     * 查询分类
     * @param $where
     * @param $offset
     * @param $limit
     */
    public function getJtypeByWhere($where, $offset, $limit)
    {
        return $this->where($where)->limit($offset, $limit)->order('id desc')->select();
    }

    /**
     * 根据搜索条件获取所有的分类数量
     * @param $where
     */
    public function getAllJtype($where)
    {
        return $this->where($where)->count();
    }

    /**
     * 添加分类
     * @param $param
     */
    public function addJtype($param)
    {
        try{
            $result = $this->validate('JtypeValidate')->save($param);
            if(false === $result){
                // 验证失败 输出错误信息
                return msg(-1, '', $this->getError());
            }else{

                return msg(1, url('jtype/index'), '添加分类成功');
            }
        }catch (\Exception $e){
            return msg(-2, '', $e->getMessage());
        }
    }

    /**
     * 编辑分类信息
     * @param $param
     */
    public function editJtype($param)
    {
        try{

            $result = $this->validate('JtypeValidate')->save($param, ['id' => $param['id']]);

            if(false === $result){
                // 验证失败 输出错误信息
                return msg(-1, '', $this->getError());
            }else{

                return msg(1, url('jtype/index'), '编辑分类成功');
            }
        }catch(\Exception $e){
            return msg(-2, '', $e->getMessage());
        }
    }

    /**
     * 根据分类的id 获取分类的信息
     * @param $id
     */
    public function getOneJtype($id)
    {
        return $this->where('id', $id)->find();
    }

    /**
     * 删除分类
     * @param $id
     */
    public function delJtype($id)
    {
        try{

            $this->where('id', $id)->delete();
            return msg(1, '', '删除分类成功');

        }catch(\Exception $e){
            return msg(-1, '', $e->getMessage());
        }
    }
}
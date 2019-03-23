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

class ProductModel extends Model
{
    // 确定链接表名
    protected $table = 'snake_product';

    /**
     * 查询产品
     * @param $where
     * @param $offset
     * @param $limit
     */
    public function getProductByWhere($where, $offset, $limit)
    {
        return $this->where($where)->limit($offset, $limit)->order('id desc')->select();
    }

    /**
     * 根据搜索条件获取所有的产品数量
     * @param $where
     */
    public function getAllProduct($where)
    {
        return $this->where($where)->count();
    }

    /**
     * 添加产品
     * @param $param
     */
    public function addProduct($param)
    {
        try{
            $result = $this->validate('ProductValidate')->save($param);
            if(false === $result){
                // 验证失败 输出错误信息
                return msg(-1, '', $this->getError());
            }else{

                return msg(1, url('product/index'), '添加产品成功');
            }
        }catch (\Exception $e){
            return msg(-2, '', $e->getMessage());
        }
    }

    /**
     * 编辑产品信息
     * @param $param
     */
    public function editProduct($param)
    {
        try{

            $result = $this->validate('ProductValidate')->save($param, ['id' => $param['id']]);

            if(false === $result){
                // 验证失败 输出错误信息
                return msg(-1, '', $this->getError());
            }else{

                return msg(1, url('product/index'), '编辑产品成功');
            }
        }catch(\Exception $e){
            return msg(-2, '', $e->getMessage());
        }
    }

    /**
     * 根据产品的id 获取产品的信息
     * @param $id
     */
    public function getOneProduct($id)
    {
        return $this->where('id', $id)->find();
    }

    /**
     * 删除产品
     * @param $id
     */
    public function delProduct($id)
    {
        try{

            $this->where('id', $id)->delete();
            return msg(1, '', '删除产品成功');

        }catch(\Exception $e){
            return msg(-1, '', $e->getMessage());
        }
    }
}
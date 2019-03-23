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

class BannerModel extends Model
{
    // 确定链接表名
    protected $table = 'snake_banner';

    /**
     * 查询图片
     * @param $where
     * @param $offset
     * @param $limit
     */
    public function getBannerByWhere($where, $offset, $limit)
    {
        return $this->where($where)->limit($offset, $limit)->order('id desc')->select();
    }

    /**
     * 根据搜索条件获取所有的图片数量
     * @param $where
     */
    public function getAllBanner($where)
    {
        return $this->where($where)->count();
    }

    /**
     * 添加图片
     * @param $param
     */
    public function addBanner($param)
    {
        try{
            $result = $this->validate('BannerValidate')->save($param);
            if(false === $result){
                // 验证失败 输出错误信息
                return msg(-1, '', $this->getError());
            }else{

                return msg(1, url('banner/index'), '添加图片成功');
            }
        }catch (\Exception $e){
            return msg(-2, '', $e->getMessage());
        }
    }

    /**
     * 编辑图片信息
     * @param $param
     */
    public function editBanner($param)
    {
        try{

            $result = $this->validate('BannerValidate')->save($param, ['id' => $param['id']]);

            if(false === $result){
                // 验证失败 输出错误信息
                return msg(-1, '', $this->getError());
            }else{

                return msg(1, url('banner/index'), '编辑图片成功');
            }
        }catch(\Exception $e){
            return msg(-2, '', $e->getMessage());
        }
    }

    /**
     * 根据图片的id 获取图片的信息
     * @param $id
     */
    public function getOneBanner($id)
    {
        return $this->where('id', $id)->find();
    }

    /**
     * 删除图片
     * @param $id
     */
    public function delBanner($id)
    {
        try{

            $this->where('id', $id)->delete();
            return msg(1, '', '删除图片成功');

        }catch(\Exception $e){
            return msg(-1, '', $e->getMessage());
        }
    }
}
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

class AboutusModel extends Model
{
    // 确定链接表名
    protected $table = 'snake_aboutus';

    /**
     * 查询
     * @param $where
     * @param $offset
     * @param $limit
     */
    public function getAboutusByWhere($where, $offset, $limit)
    {
        return $this->where($where)->limit($offset, $limit)->order('id desc')->select();
    }

    /**
     * 根据搜索条件获取所有的数量
     * @param $where
     */
    public function getAllAboutus($where)
    {
        return $this->where($where)->count();
    }

    /**
     * 添加
     * @param $param
     */
    public function addAboutus($param)
    {
        try{
            $result = $this->validate('AboutusValidate')->save($param);
            if(false === $result){
                // 验证失败 输出错误
                return msg(-1, '', $this->getError());
            }else{

                return msg(1, url('aboutus/index'), '添加成功');
            }
        }catch (\Exception $e){
            return msg(-2, '', $e->getMessage());
        }
    }

    /**
     * 编辑
     * @param $param
     */
    public function editAboutus($param)
    {
        try{

            $result = $this->validate('AboutusValidate')->save($param, ['id' => $param['id']]);

            if(false === $result){
                // 验证失败 输出错误
                return msg(-1, '', $this->getError());
            }else{

                return msg(1, url('aboutus/index'), '编辑成功');
            }
        }catch(\Exception $e){
            return msg(-2, '', $e->getMessage());
        }
    }

    /**
     * 根据的id 获取的
     * @param $id
     */
    public function getOneAboutus($id)
    {
        return $this->where('id', $id)->find();
    }

    /**
     * 删除
     * @param $id
     */
    public function delAboutus($id)
    {
        try{

            $this->where('id', $id)->delete();
            return msg(1, '', '删除成功');

        }catch(\Exception $e){
            return msg(-1, '', $e->getMessage());
        }
    }
}
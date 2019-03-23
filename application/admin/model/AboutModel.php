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

class AboutModel extends Model
{
    // 确定链接表名
    protected $table = 'snake_about';

    /**
     * 查询信息
     * @param $where
     * @param $offset
     * @param $limit
     */
    public function getAboutByWhere($where, $offset, $limit)
    {
        return $this->where($where)->limit($offset, $limit)->order('id desc')->select();
    }

    /**
     * 根据搜索条件获取所有的信息数量
     * @param $where
     */
    public function getAllAbout($where)
    {
        return $this->where($where)->count();
    }

    /**
     * 添加信息
     * @param $param
     */
    public function addAbout($param)
    {
        try{
            $result = $this->validate('AboutValidate')->save($param);
            if(false === $result){
                // 验证失败 输出错误信息
                return msg(-1, '', $this->getError());
            }else{

                return msg(1, url('about/index'), '添加信息成功');
            }
        }catch (\Exception $e){
            return msg(-2, '', $e->getMessage());
        }
    }

    /**
     * 编辑信息信息
     * @param $param
     */
    public function editAbout($param)
    {
        try{

            $result = $this->validate('AboutValidate')->save($param, ['id' => $param['id']]);

            if(false === $result){
                // 验证失败 输出错误信息
                return msg(-1, '', $this->getError());
            }else{

                return msg(1, url('about/index'), '编辑信息成功');
            }
        }catch(\Exception $e){
            return msg(-2, '', $e->getMessage());
        }
    }

    /**
     * 根据信息的id 获取信息的信息
     * @param $id
     */
    public function getOneAbout($id)
    {
        return $this->where('id', $id)->find();
    }

    /**
     * 删除信息
     * @param $id
     */
    public function delAbout($id)
    {
        try{

            $this->where('id', $id)->delete();
            return msg(1, '', '删除信息成功');

        }catch(\Exception $e){
            return msg(-1, '', $e->getMessage());
        }
    }
}
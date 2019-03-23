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

class LinkModel extends Model
{
    // 确定链接表名
    protected $table = 'snake_link';

    /**
     * 查询链接
     * @param $where
     * @param $offset
     * @param $limit
     */
    public function getLinkByWhere($where, $offset, $limit)
    {
        return $this->where($where)->limit($offset, $limit)->order('id desc')->select();
    }

    /**
     * 根据搜索条件获取所有的链接数量
     * @param $where
     */
    public function getAllLink($where)
    {
        return $this->where($where)->count();
    }

    /**
     * 添加链接
     * @param $param
     */
    public function addLink($param)
    {
        try{
            $result = $this->validate('LinkValidate')->save($param);
            if(false === $result){
                // 验证失败 输出错误链接
                return msg(-1, '', $this->getError());
            }else{

                return msg(1, url('Link/index'), '添加链接成功');
            }
        }catch (\Exception $e){
            return msg(-2, '', $e->getMessage());
        }
    }

    /**
     * 编辑链接链接
     * @param $param
     */
    public function editLink($param)
    {
        try{

            $result = $this->validate('LinkValidate')->save($param, ['id' => $param['id']]);

            if(false === $result){
                // 验证失败 输出错误链接
                return msg(-1, '', $this->getError());
            }else{

                return msg(1, url('Link/index'), '编辑链接成功');
            }
        }catch(\Exception $e){
            return msg(-2, '', $e->getMessage());
        }
    }

    /**
     * 根据链接的id 获取链接的链接
     * @param $id
     */
    public function getOneLink($id)
    {
        return $this->where('id', $id)->find();
    }

    /**
     * 删除链接
     * @param $id
     */
    public function delLink($id)
    {
        try{

            $this->where('id', $id)->delete();
            return msg(1, '', '删除链接成功');

        }catch(\Exception $e){
            return msg(-1, '', $e->getMessage());
        }
    }
}
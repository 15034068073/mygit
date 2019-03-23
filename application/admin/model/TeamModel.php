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

class TeamModel extends Model
{
    // 确定链接表名
    protected $table = 'snake_team';

    /**
     * 查询新闻
     * @param $where
     * @param $offset
     * @param $limit
     */
    public function getTeamByWhere($where, $offset, $limit)
    {
        return $this->where($where)->limit($offset, $limit)->order('id desc')->select();
    }

    /**
     * 根据搜索条件获取所有的新闻数量
     * @param $where
     */
    public function getAllTeam($where)
    {
        return $this->where($where)->count();
    }

    /**
     * 添加新闻
     * @param $param
     */
    public function addTeam($param)
    {
        try{
            $result = $this->validate('TeamValidate')->save($param);
            if(false === $result){
                // 验证失败 输出错误信息
                return msg(-1, '', $this->getError());
            }else{

                return msg(1, url('team/index'), '添加新闻成功');
            }
        }catch (\Exception $e){
            return msg(-2, '', $e->getMessage());
        }
    }

    /**
     * 编辑新闻信息
     * @param $param
     */
    public function editTeam($param)
    {
        try{

            $result = $this->validate('TeamValidate')->save($param, ['id' => $param['id']]);

            if(false === $result){
                // 验证失败 输出错误信息
                return msg(-1, '', $this->getError());
            }else{

                return msg(1, url('team/index'), '编辑新闻成功');
            }
        }catch(\Exception $e){
            return msg(-2, '', $e->getMessage());
        }
    }

    /**
     * 根据新闻的id 获取新闻的信息
     * @param $id
     */
    public function getOneTeam($id)
    {
        return $this->where('id', $id)->find();
    }

    /**
     * 删除新闻
     * @param $id
     */
    public function delTeam($id)
    {
        try{

            $this->where('id', $id)->delete();
            return msg(1, '', '删除新闻成功');

        }catch(\Exception $e){
            return msg(-1, '', $e->getMessage());
        }
    }
}
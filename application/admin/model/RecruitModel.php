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

class RecruitModel extends Model
{
    public function gettype() {
        return $this->belongsTo('ZptypeModel','type','id');
    }

    protected $table = 'snake_recruit';
    public function add($data, $file)
    {
        if ($data['type'] == 0) {
            return [501, "请选择类型"];
        }
        if ($file) {
            $up = uploadsingle($file);
            if ($up[0] == 501) {
                return [501,$up[1]];
            }
            $data['img'] = $up[1];
        }
        $data['date'] = date('Y-m-d H:i:s');
        $res = db('recruit')->insert($data);
        if ($res) {
            return [200,'新增成功'];
        }
        return [501,'新增失败'];
    }

    public function edit($data, $id, $file)
    {
        unset($data['img']);
        if ($file) {
            $up = uploadsingle($file);
            if ($up[0] == 501) {
                return [501,$up[1]];
            }
            $data['img'] = $up[1];
        }
        $res = db('recruit')->where(['id'=>$id])->update($data);
        if ($res !== false) {
            return [200,'修改成功'];
        }
        return [501,'修改失败'];
    }
}
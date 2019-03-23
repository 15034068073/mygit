<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件

/**
 * 提示信息
 * @author wgq
 * @param string $msg   提示信息
 * @param string $url   跳转路径
 */
function Jump($msg,$url=''){
    if($url){
        echo "<script>alert('".$msg."');location.href='".$url."'</script>";
    }else{
        echo "<script>alert('".$msg."');history.back();</script>";
    }
}

//分页函数
function fenye($table, $where = '', $order = 'id desc', $page = 10, $group = '')
{
    $totle = db($table)->where($where)->count();
    $list = db($table)->where($where)->order($order)->group($group)->paginate($page, $totle, ['query'=>request()->param() ]);
    collection($list)->toArray();
    if (!$list) {
        return [[],''];
    }
    $newlist = [];
    foreach ($list as $k=>$v) {
        $newlist[] =$v;
    }
    $page = $list->render();  // 获取分页显示
    return [$newlist,$page,'<tr><th colspan="3">共计'.$totle.'个人脉</th></tr>'];
}

//单图上传
function uploadsingle($file,$size = 5000000, $isCompress = 1){
        $info = $file->validate(['size'=>$size,'ext'=>'jpg,png,gif'])->move(ROOT_PATH . 'public' . DS . 'static'.DS.'uploads');
        if($info){
            $url = str_replace('\\','/','uploads/'.$info->getSaveName());
            return [200,$url];
        }
        return [501,$file->getError()];

}

/**
 * 设置缓存文件
 * @author  wgq
 * @param   string  $file   文件名称
 * @param   mixed   $data   缓存数据
 */
function f_set($file, $data)
{
    //  if (empty($file) || empty($data)) {
    //      return false;
    //  }
    if (!is_dir(ROOT_PATH.'public/static/cache')) {
        mkdir(ROOT_PATH.'public/static/cache');
    }
    $data = serialize($data);
    $res = file_put_contents(ROOT_PATH.'public/static/cache/'.md5($file).'.txt', $data);
    if ($res) {
        return true;
    }
    return false;

}



/**
 * 获取缓存文件
 * @author  wgq
 * @param   string  $file   文件名称
 * @param   mixed   $data   缓存数据
 */
function f_get($file)
{
    if (empty($file)) {
        return '';
    }
    if (!file_exists(ROOT_PATH.'public/static/cache/'.md5($file).'.txt')) {
        return '';
    }
    $res = file_get_contents(ROOT_PATH.'public/static/cache/'.md5($file).'.txt');
    if ($res) {
        return unserialize($res);
    }
    return '';
}

/**
 * 判断是否存在缓存文件
 * @author  wgq
 * @param   string  $file   文件名称
 */
function f_exists($file)
{
    if (empty($file)) {
        return false;
    }
    if (!file_exists(ROOT_PATH.'public/static/cache/'.md5($file).'.txt')) {
        return false;
    }
    $res = filesize(ROOT_PATH.'public/static/cache/'.md5($file).'.txt');
    if ($res) {
        return true;
    }
    return false;
}

/**
 * 清除缓存文件
 * @author  wgq
 * @param   stirng  $file   文件名称
 */
function f_clear($file)
{
    if (empty($file)) {
        return false;
    }
    if (!is_file(ROOT_PATH.'public/static/cache/'.md5($file).'.txt')) {
        return true;
    }
    $res = unlink(ROOT_PATH.'public/static/cache/'.md5($file).'.txt');
    if ($res) {
        return true;
    }
    return false;
}

//关联查询分页函数
function fenye_model($table, $where = '', $with, $order = 'id desc', $page = 10)
{
    $totle = model($table)->where($where)->count();
    switch(count($with)) {
        case 1:
            $list = model($table)->where($where)->with($with[0])->order($order)->paginate($page, $totle, ['query'=>request()->param() ]);
        break;
        case 2:
            $list = model($table)->where($where)->with($with[0])->with($with[1])->order($order)->paginate($page, $totle, ['query'=>request()->param() ]);
        break;
        case 3:
            $list = model($table)->where($where)->with($with[0])->with($with[1])->with($with[2])->order($order)->paginate($page, $totle, ['query'=>request()->param() ]);
        break;
    }

    $page = $list->render();  // 获取分页显示
    $list = collection($list)->toArray();
    if (!$list) {
        return [[],''];
    }
    $newlist = [];
    foreach ($list as $k=>$v) {
        $newlist[] =$v;
    }

    return [$newlist[1],$page,'<tr ><th colspan="3">共计'.$totle.'个人脉</th></tr>'];
}
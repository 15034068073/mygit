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
namespace app\admin\validate;

use think\Validate;

class JishuValidate extends Validate
{
    protected $rule = [
        ['title', 'require', '标题不能为空'],
        ['img', 'require', '缩略图不能空'],
        ['content', 'require', '内容不能为空']
    ];

}
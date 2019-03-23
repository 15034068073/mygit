<?php 

	function msg($code, $data, $msg)
{
    return compact('code', 'data', 'msg');
}


	function getpic($content){
		//对文章内容代码进行反转义
		$content = html_entity_decode($content);
		//用正则表达式把文章内容代码中所有<img>标签提取出来
		preg_match_all("/<img.*>/isU",$content , $ereg);
		//只提取第一张图片
		$img=$ereg[0][0];
		//正则表达式获取图片的src属性
		$p="#src=('|\")(.*)('|\")#isU";
		//获取src属性的值
		preg_match_all($p,$img,$img1);

		//为空的话不输出
		if (isset($img[2][0])) {
			return $img[2][0];
		}

	}
	
	function subtext($text, $length){
        if(mb_strlen($text, 'utf8') > $length) 
        return mb_substr($text, 0, $length, 'utf8').'...';
        return $text;
    }
    
    function alert($msg="", $url=""){
	echo '<meta charset="utf-8">';
    echo '<script>';
    echo 'alert("'.$msg.'");';
    if(!empty($url)) {
        echo 'location.href="'.$url.'"';
    }else{
        echo 'history.go(-1);';
    }
    echo '</script>';
    exit;
}
<?php
/**
 * Created by JetBrains PhpStorm.
 * User: 吴文付 hi_php@163.com
 * Blog: wuwenfu.cn
 * Date: 2016/4/8
 * Time: 16:51
 * description:
 *
 *
 */
//http://dzgbk.cc/plugin.php?id=htt_robot:robot 访问该页面的url
if(!defined('IN_DISCUZ')) { exit('Access Denied');}
include_once DISCUZ_ROOT.'./source/plugin/htt_robot/function.inc.php';

loadcache('plugin');
$var = $_G['cache']['plugin'];
$groupstr = $var['htt_robot']['groups']; //用户组。哪些用户组可以看到机器人。
$welcome_msg = $var['htt_robot']['welcome_msg']; //欢迎语
$tuling_key= $var['htt_robot']['tuling_key']; //key
$check = $var['htt_robot']['is_show'];  //1隐藏 2启用



//
////请求图灵接口。获取数据。
//if(!empty($tuling_key)){
//    $key = $tuling_key;
//    echo 11;
//}else{
//    echo json_encode(array('msg'=>lang('plugin/htt_robot', 'error_setting_key')));
//    exit();
//}


$key = $tuling_key;

$info= $_POST['msg'];

//Key:c2d6661fd001217c4fec38d0e4b98c31
//
//$arr = array(
//    'key'=>$key,
//    'info'=>$info
//);

//$url = 'http://www.tuling123.com/openapi/api?'.http_build_query($arr);
$url = 'http://www.tuling123.com/openapi/api?key='.$key.'&info='.urlencode($info);


//echo $url;
//
//exit();


$replystr = curl_html($url);

//echo $replystr;




$replyarr = json_decode($replystr,true);


//var_dump($replyarr);




echo json_encode(array('msg'=>$replyarr['text']));
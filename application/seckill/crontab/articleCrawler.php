<?php

/*
* 爬虫 搜狗微信
*/

define('IN_DVD_CRON', true);
define('SG_DOMAIN', 'http://weixin.sogou.com');
define('WX_DOMAIN', 'http://mp.weixin.qq.com');
define('COOKIE_FILE', dirname(__FILE__) . '/sg.cookie');
require('/export/cron/bin/base.php');

// $name = '大V店';
// $openId = 'oIWsFt6ofqVaHskEzj78H-Sehnds';
// $weixin_name = 'idavdian';

$weixin_array = array(
	'0' => array(
		'name' => '家教智慧',
		'weixin_name' => 'jiajiao_zh',
	),
	'1' => array(
		'name' => '小土大橙子',
		'weixin_name' => 'buyateng',
	),
	'2' => array(
		'name' => '童书乌蒙',
		'weixin_name' => 'gh_fd8bca26bff0',
	),
	'3' => array(
		'name' => '钱志亮工作室',
		'weixin_name' => 'qzlgzs',
	),
	'4' => array(
		'name' => '桃花马上石榴裙',
		'weixin_name' => 'taohuama2015',
	),
	'5' => array(
		'name' => 'knowyourself',
		'weixin_name' => 'knowyourself2015',
	),
	'6' => array(
		'name' => '美人的底气',
		'weixin_name' => 'beauties-4',
	),
	'7' => array(
		'name' => '北京小升初网',
		'weixin_name' => 'bjxschu',
	),
	'8' => array(
		'name' => '家长公会',
		'weixin_name' => 'Parents_Guild',
	),
	'9' => array(
		'name' => '教子有方',
		'weixin_name' => 'jiaoziyoufang',
	),
	'10' => array(
		'name' => '年糕妈妈',
		'weixin_name' => 'niangao-mama',
	),
	'11' => array(
		'name' => '大J小D',
		'weixin_name' => 'jiayoubaobao2015',
	),
	'12' => array(
		'name' => '叶月幽',
		'weixin_name' => 'yeyueyou168',
	),
	'13' => array(
		'name' => '妈妈商学院',
		'weixin_name' => 'mamamba',
	),
	'14' => array(
		'name' => '功夫妈咪孩子教育',
		'weixin_name' => 'haizijiaoyu',
	),
	'15' => array(
		'name' => '李月亮',
		'weixin_name' => 'bymooneye',
	),
	'16' => array(
		'name' => '家长帮',
		'weixin_name' => 'eduujzb',
	),
	'17' => array(
		'name' => '我们仨',
		'weixin_name' => 'qinlingyewei521',
	),
	'18' => array(
		'name' => '一小时爸爸',
		'weixin_name' => 'hrdaddy',
	),
	'19' => array(
		'name' => '六妈罗罗',
		'weixin_name' => 'liumaluoluo',
	),
	'20' => array(
		'name' => '问对教育',
		'weixin_name' => 'cdwendui',
	),
	'21' => array(
		'name' => '亲子派',
		'weixin_name' => 'qinzipaidui',
	),
	'22' => array(
		'name' => '米皮妈',
		'weixin_name' => 'qinzipaidui',
	),
	'23' => array(
		'name' => '米皮妈',
		'weixin_name' => 'mipima',
	),
	'24' => array(
		'name' => '益智学堂',
		'weixin_name' => 'yizhixuetang01',
	),
	'25' => array(
		'name' => '经典图画书',
		'weixin_name' => 'jingdiantuhuashu',
	),
	'26' => array(
		'name' => '视觉志',
		'weixin_name' => 'QQ_shijuezhi',
	),
	'27' => array(
		'name' => '海伦画报',
		'weixin_name' => 'helenview',
	),
	'28' => array(
		'name' => '手工爱好者',
		'weixin_name' => 'mydiyclub',
	),
	'29' => array(
		'name' => '中国教育报',
		'weixin_name' => 'Zhongguojiaoyubao',
	),
	'30' => array(
		'name' => '尖叫童年',
		'weixin_name' => 'jjtongnian',
	),
	'31' => array(
		'name' => '源创图书',
		'weixin_name' => 'yuanchuangtushu',
	),
	'32' => array(
		'name' => '新学校研究院',
		'weixin_name' => 'idealschool',
	),
	'33' => array(
		'name' => '卢勤问答平台',
		'weixin_name' => 'luqinwendapingtai',
	),
	'34' => array(
		'name' => '新校长传媒',
		'weixin_name' => 'new_xiaozhang',
	),
	'35' => array(
		'name' => '艺非凡',
		'weixin_name' => 'efifan',
	),
	'36' => array(
		'name' => '婚姻与家庭杂志',
		'weixin_name' => 'hunyinyujiating99',
	),
	'37' => array(
		'name' => '有品生活',
		'weixin_name' => 'pinpinlife',
	),
	'38' => array(
		'name' => '卡娃微卡',
		'weixin_name' => 'kawa01',
	),
);

if ($weixin_array) {
	foreach ($weixin_array as $key => $value) {
		if (empty($value['name']) || empty($value['weixin_name'])) {
			echo "[error]公众号信息有误～" . "\n";
			return false;
		}
		$name = $value['name'];
		$weixin_name = $value['weixin_name'];
		doAllThings($name,$weixin_name);
		sleep(300);
	}
}

function doAllThings($name,$weixin_name) {
	echo $name . "====================开始时间：".date("Y-m-d H:i:s", time())."====================\n";

	$strCookie = getCookieStr('http://weixin.sogou.com/gzh?openid=' . $weixin_name);
	$GLOBALS['strCookie'] = $strCookie;

	$first_url = get_first_url($name, $weixin_name);

	$article_data = array();
	if (!$first_url) {
		echo "未获取到url呢～" . "\n";
	} else {
		$article_url_list = get_article_url_list($first_url);
		if ($article_url_list) {
			foreach ($article_url_list as $k => $v) {
				if ($k>4) continue;
				$article_info = get_article_info($v['content_url']);
				$article_info['image'] = $v['cover'];
				if ($article_info) {
					$article_data[] = $article_info;
				}
			}
		}
	}
	// var_dump($article_data);die;
	if ($article_data) {
		foreach ($article_data as $k=> $data) {
			insertArticle($data, $name);
		}
	} else {
		echo "没有获取到内容呢～" . "\n";
	}
	echo $name . "====================结束时间：".date("Y-m-d H:i:s", time())."====================\n";

} 


function getCookieStr ($url)
{
	$ch = curl_init($url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	// get headers too with this line
	curl_setopt($ch, CURLOPT_HEADER, 1);
	$result = curl_exec($ch);
	// get cookie
	// multi-cookie variant contributed by @Combuster in comments

	preg_match_all('/^Set-Cookie:\s*([^;]*)/mi', $result, $matches);
	$cookies = array();
	foreach($matches[1] as $item) {
	    parse_str($item, $cookie);
	    $cookies = array_merge($cookies, $cookie);
	}
	$str = '';
	foreach ($cookies as $k => $v) {
		$str .= $k . '=' . $v . ';';
	}
	// $str .= 'SUV=1460471989484184;';
	$str .= 'SUV=' . intval( intval(microtime(true)*1000) * 1 * 1000 );
	return $str;
}


/**
 * 获取链接
 * @param $name 	string 	公众号名称
 * @param $weixin_name 	string  微信号
 * @return $weixin_url 	string 	url
 */
function get_first_url ($name, $weixin_name) {

	// $url = SG_DOMAIN . '/weixin?type=1&query=' . urlencode($name);
	// $content = file_get_contents($url);
	// $rule = '/<!-- a -->([\s\S]*?)<!-- z -->/';
	// var_dump($content);die;
	// $result = preg_match_all($rule, $content, $match);

	$url = SG_DOMAIN . '/weixin?type=1&query=' . urlencode($name);
	// var_dump($url);exit();
	$ua = 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_10_2) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/49.0.2623.110 Safari/537.36';
	// $strCookie = 'SNUID=524CE38BE0E5D0AA43C3C561E1EC7078';
	$ch = curl_init();
	// $timeout = 0;
	curl_setopt ($ch, CURLOPT_URL, $url);
	// curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
	curl_setopt($ch, CURLOPT_HEADER, 1);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_BINARYTRANSFER, 1);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
	// curl_setopt($ch, CURLOPT_USERAGENT, $ua);
	curl_setopt($ch, CURLOPT_HTTPHEADER, array('X-FORWARDED-FOR:111.222.333.4', 'CLIENT-IP:111.222.333.4'));
	curl_setopt($ch, CURLOPT_REFERER, "http://weixin.sogou.com");
	// curl_setopt($ch, CURLOPT_PROXY, "http://weixin.sogou.com");
	curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 6.1) AppleWebKit/536.11 (KHTML, like Gecko) Chrome/20.0.1132.57 Safari/536.11");
	curl_setopt($ch, CURLOPT_COOKIE, $GLOBALS['strCookie']);
	// curl_setopt($ch, CURLOPT_COOKIEFILE, COOKIE_FILE);
	// echo $GLOBALS['strCookie']."\n";die;
	$content = curl_exec($ch);
	curl_close($ch);
	$rule = '/<!-- a -->([\s\S]*?)<!-- z -->/';
	$result = preg_match_all($rule, $content, $match);

	if (!$result) {
		if (strstr($content,"用户您好，您的访问过于频繁，为确认本次访问为正常用户行为，需要您协助验证。")) {
			echo "用户您好，您的访问过于频繁，为确认本次访问为正常用户行为，需要您协助验证。" . "\n";
		} else {
			echo "啊喔～出错了～" . "\n";
		}
		// 邮件或短信通知～
		return false;
	} else {
		foreach ($match[1] as $key => $value) {
			$rule1 = '/<label name="em_weixinhao">([\s\S]*?)<\/label>/';
			$res1 = preg_match_all($rule1, $value, $mat1);
			if ($res1) {
				if ($mat1[1][0]==$weixin_name){
					$rule2 = '/gotourl\(\'([\s\S]*?)\',event,this\)/';
					$res2 = preg_match_all($rule2, $value, $mat2);
					if ($res2) {
						return $mat2[1][0];
					} else {
						return false;
					}
				}
			}
		}
	}
}

function get_article_url_list($url) {
	$url = htmlspecialchars_decode($url);
	// echo $url;die;
	// Mozilla/5.0 (Windows NT 6.1) AppleWebKit/536.11 (KHTML, like Gecko) Chrome/20.0.1132.57 Safari/536.11
	// $ua = 'Mozilla/5.0 (iPhone; CPU iPhone OS 9_0_2 like Mac OS X) AppleWebKit/601.1.46 (KHTML, like Gecko) Mobile/13A452 MicroMessenger/6.3.5 NetType/WIFI Language/zh_CN';
	$ua = 'Mozilla/5.0 (iPhone; CPU iPhone OS 9_0_2 like Mac OS X) AppleWebKit/601.1.46 (KHTML, like Gecko) Mobile/13A452 MicroMessenger/6.3.5 NetType/WIFI Language/zh_CN';
	$ch = curl_init();
	curl_setopt ($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_HEADER, 1);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_BINARYTRANSFER, 1);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
	curl_setopt($ch, CURLOPT_USERAGENT, $ua);
	curl_setopt($ch, CURLOPT_REFERER, "http://mp.weixin.qq.com");
	// curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 6.1) AppleWebKit/536.11 (KHTML, like Gecko) Chrome/20.0.1132.57 Safari/536.11");
	curl_setopt($ch, CURLOPT_COOKIE, $GLOBALS['strCookie']);
	$content = htmlspecialchars_decode(curl_exec($ch));
	// var_dump($content);die;
	curl_close($ch);
	// "content_url":"\\
	// $rule = '/\"content_url\"\:\"[\\\][\\\]([\s\S]*?)\"\,\"source_url\"/';
	// $result = preg_match_all($rule, $content, $match);
	$rule = '/\= \'([\s\S]*?)\'\;/';
	$result = preg_match_all($rule, $content, $match);
	// var_dump($match[1][0]);die;
	$data = json_decode($match[1][0],true);
	// var_dump($data);die;
	$return_data = array();
	if ($data) {
		foreach ($data['list'] as $k => $v) {
			$content_url = isset($v['app_msg_ext_info']['content_url']) ? htmlspecialchars_decode($v['app_msg_ext_info']['content_url']) : '';
			$cover = isset($v['app_msg_ext_info']['cover']) ? htmlspecialchars_decode($v['app_msg_ext_info']['cover']) : '';
			$content_url = str_replace('\\','',$content_url);
			$cover = str_replace('\\','',$cover);
			$return_data[$k] = array(
				'content_url' => $content_url,
				'cover' => $cover,
			);
			// var_dump($return_data);die;
		}
	}
	if (!$return_data) {
		echo "啊喔～出错了～" . "\n";
		return false;
	} else {
		return $return_data;
	}
}

function get_article_info($uri){
	$url = WX_DOMAIN . htmlspecialchars_decode($uri);
	$ua = 'Mozilla/5.0 (iPhone; CPU iPhone OS 9_0_2 like Mac OS X) AppleWebKit/601.1.46 (KHTML, like Gecko) Mobile/13A452 MicroMessenger/6.3.5 NetType/WIFI Language/zh_CN';
	$ch = curl_init();
	curl_setopt ($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_HEADER, 1);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_BINARYTRANSFER, 1);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
	curl_setopt($ch, CURLOPT_USERAGENT, $ua);
	curl_setopt($ch, CURLOPT_REFERER, "http://mp.weixin.qq.com");
	// curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 6.1) AppleWebKit/536.11 (KHTML, like Gecko) Chrome/20.0.1132.57 Safari/536.11");
	curl_setopt($ch, CURLOPT_COOKIE, $GLOBALS['strCookie']);
	$content = htmlspecialchars_decode(curl_exec($ch));
	// var_dump(htmlspecialchars_decode($content));die;
	curl_close($ch);
	// "content_url":"\\
	$rule_title = '/\<h2 class\=\"rich_media_title\" id\=\"activity\-name\"\>([\s\S]*?)\<\/h2\>/';
	$result_title = preg_match_all($rule_title, trim($content), $match_title);
	// var_dump($match_title);die;
	$title = trim($match_title[1][0]);
	
	$rule_time = '/\<em id\=\"post\-date\" class\=\"rich_media\_meta rich\_media\_meta\_text\"\>([\s\S]*?)\<\/em\>/';
	$result_time = preg_match_all($rule_time, trim($content), $match_time);
	$time = trim($match_time[1][0]);
	// var_dump($title);
	// var_dump($time);die;

	$rule_content = '/\<div class\=\"rich\_media\_content \" id\=\"js\_content\"\>([\s\S]*?)\<\/div\>/';
	$result_content = preg_match_all($rule_content, $content, $match_content);
	$con1 = trim($match_content[1][0]);
	$con_final = str_replace('data-src="http://mmbiz.qpic.cn','src="http://mmbiz.qpic.cn',$con1);
	return array(
		'title' => $title,
		'date' => $time,
		'content' => $con_final
	);

}

function insertArticle($params, $name)
{
	if (empty($params['title']) 
		|| empty($params['date']) 
		|| empty($params['content'])
		|| empty($params['image'])
	)
	{
		echo '[error] insertArticle fail, invalid params, [params:' . json_encode($params) . "]\n";
		return false;
	}

	// 判断当前文章是否已经抓取过
	$title = $params['title'];
	$sql = "select id from d_page_spiders_log where weixin_name='$name' and article_title='$title' limit 1 ";
	$res = mysql_query($sql, $GLOBALS['conn']);
	if ($res) {
		$row = mysql_fetch_assoc($res,MYSQL_ASSOC);
		if ($row['id']>0) {
			return false;
		}
	}


	// $now = time();
    $fields = array(
        'page_type'     =>  1,
        'title'         =>  -1,
        'category'      =>  0,
        'image'         =>  0,
        'image_show'    =>  0,
        'author'        =>  $name,
        'content'       =>  -1,
        'head_csss'     =>  '',
        'head_jss'      =>  '',
        'tail_csss'     =>  '',
        'tail_jss'      =>  '',
        'sort_score'    =>  0,
        'read_times'    =>  0,
        'share_times'   =>  0,
        // 'begin_time'    =>  $now,
        // 'end_time'      =>  $now + 86400,
        'online_status' =>  0,
        'share_people' =>  '',
        'share_people_desc' =>  '',
        'class_time' =>  0,
        'class_desc' =>  '',
    );
    $errors = array();
    $columns = array();
    $values = array();
    foreach($fields as $k => $v) {
        if(isset($params[$k])) {
            $columns[] = "`$k`";
            $values[] = "'" . mysql_escape_string($params[$k]) . "'";
            continue;
        }
        if(!is_int($v) || $v >= 0) {
            $columns[] = $k;
            $values[] = "'$v'";
            continue;
        }
        if($v == -1) {
            $errors[] = $k;
        }
    }
    $sql = "INSERT IGNORE INTO d_page(" . implode(", ", $columns) . ") VALUES (" . implode(", ", $values) . ")";
    mysql_query($sql, $GLOBALS['conn']);
    $ac = mysql_affected_rows($GLOBALS['conn']);
    if ($ac == 0)
    {
    	echo "[error] insertArticle fail, sql insert fail, [sql:$sql]\n";
    	return false;
    }
    echo "标题：<<" . $params['title'] . ">>插入成功～" . "\n";
    // 记录抓取日志
    $weixin_name = $name;
    $article_title = $params['title'];
    $now = time();
    $sql = "INSERT IGNORE INTO d_page_spiders_log(`weixin_name`,`article_title`,`ctime`) VALUES ('$weixin_name','$article_title','$now')";
    mysql_query($sql, $GLOBALS['conn']);

    return true;
}



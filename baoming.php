<?php

//test  github
echo "test"
require_once (dirname(__FILE__) . "/include/common.inc.php");
require_once (dirname(__FILE__) . "/include/init.php");
require_once(DEDEINC."/memberlogin.class.php");
$cfg_ml = new MemberLogin(-1);

/*检测 是否可以使用 数据库操作类*/
//fei_dump($feidb);
$tnSysconfig='usite_sysconfig';
$tnCategory='usite_category';
$tnContent='usite_content';
$syscfgInfo=array();
/*查询站点配置*/
$syscfgArr=array(
	'cfg_basehost'=>'cfg_basehost',
	'cfg_indexurl'=>'cfg_indexurl',
	'cfg_indexname'=>'cfg_indexname',
	'cfg_webname'=>'cfg_webname',
	'cfg_powerby'=>'cfg_powerby',
	'cfg_keywords'=>'cfg_keywords',
	'cfg_description'=>'cfg_description',
	'cfg_beian'=>'cfg_beian'
);
foreach($syscfgArr as $key=>$value){
	$syscfg_where=" AND varname='".$value."' ";
	$syscfg_limit=' 0,1 ';
	$syscfg_sql='SELECT value FROM '.$tnSysconfig.' WHERE 1 '.$syscfg_where.' LIMIT '.$syscfg_limit;
	$syscfg_row=$feidb->getOne($syscfg_sql);
	$syscfgInfo[$key]=$syscfg_row['value'];
}
/*查询学习类别*/
$studytype_where=' AND pid=1 AND is_avail=1 ';
$studytype_order=' sortnumber ASC,id ASC ';
$studytype_limit=' 0,4 ';
$studytype_sql='SELECT id,cname FROM '.$tnCategory.' WHERE 1 '.$studytype_where.' ORDER BY '.$studytype_order.' LIMIT '.$studytype_limit;
$pub_studytype_list=$feidb->getAll($studytype_sql);
/*查询学习类别 详细内容*/
foreach($pub_studytype_list as $key=>$row){
	$guidelines_id=intval($row['id']);
	$guidelines_where=' AND catid= '.$guidelines_id;
	$guidelines_limit=' 0,1 ';
	$guidelines_sql='SELECT id,content FROM '.$tnContent.' WHERE 1 '.$guidelines_where.' LIMIT '.$guidelines_limit;
	$guidelines_row=$feidb->getOne($guidelines_sql);
	$guidelines_row['catid']=$guidelines_id;
	$guidelines_list[]=$guidelines_row;
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<script id="allmobilize" charset="utf-8" src="http://a.yunshipei.com/c95f531f6dc7f112147df4adf5d7baf3/allmobilize.min.js"></script><meta http-equiv="Cache-Control" content="no-siteapp" /><link rel="alternate" media="handheld" href="#" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>网上报名-<?php echo $syscfgInfo['cfg_webname'];?></title>
<meta name="description" content="<?php echo $syscfgInfo['cfg_description'];?>" />
<meta name="keywords" content="<?php echo $syscfgInfo['cfg_keywords'];?>" />
<link href="/templets/default/css/comm.css" rel="stylesheet" type="text/css" />
<link href="/templets/default/css/baoming.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="templets/default/js/jquery.min.js"></script>
<script type="text/javascript" src="templets/default/js/studyentry.js"></script>
<script type="text/javascript" src="/templets/default/js/study.js"></script>
<script type="text/javascript" src="templets/default/js/jquery.dateSelector.js"></script>
<script type="text/javascript">
$(function(){
	$("#birthday").dateSelector({yearBegin:1949,yearEnd:2013});
})
</script>
</head>
<body>
<!-- header begin-->
<div class="site_global_nav" >
    <div class="site_column site_global_nav_div"><span>今天是</span><span id="ymdclock"></span><span class="site_welcome">欢迎报读西安广播电视大学</span><a target="_blank" href="/baoming.php" title="网上报名">网上报名</a>|<a target="_blank" href="http://qiao.baidu.com/v3/?module=default&controller=webim&action=index&siteid=3109044" title="在线咨询">在线咨询</a>|<a target="_blank" href="/html/edu/" title="网上教学">网上教学</a>|<a href="javascript:window.external.AddFavorite('{dede:global.cfg_basehost/}','{dede:global.cfg_webname/}')">加入收藏</a>|<a target="_blank"  href="http://www.xaxdjy.com" title="旧版入口" class="last">旧版入口</a></div>
</div>
<div class="site_head" >
    <div class="site_column site_head_div">
        <div class="site_head_logo"><a href="/index.php" title="<?php echo $syscfgInfo['cfg_webname'];?>"><img src="/templets/default/image/logo.png" alt="<?php echo $syscfgInfo['cfg_webname'];?>" title="<?php echo $syscfgInfo['cfg_webname'];?>" /></a></div>
        <div class="site_head_login"><script src="/loginjs.php?open=1&rand=Math.ceil(Math.random()*10000);" type="text/javascript" language="javascript"></script></div>
    </div>
</div>
<div class="site_navgation clear" >
    <div class="site_column site_navgation_div"><a href="/index.php" title="首页">首页</a><img src="/templets/default/image/x.png"> <a href="/html/xuexiao/about/" title="学校简介">学校简介</a><img src="/templets/default/image/x.png"><a href="/html/openedu/jianzhang/" title="电大开放教育">电大开放教育</a><img src="/templets/default/image/x.png"><a href="/html/aduledu/jianzhang/" title="电大成人高考">电大成人高考</a><img src="/templets/default/image/x.png"><a href="/html/xueliedu/jianzhang/" title="网络学历教育">网络学历教育</a><img src="/templets/default/image/x.png"> <a href="/html/guanli/jiaoxue" title="教学管理">教学管理</a><img src="/templets/default/image/x.png"><a href="/html/edu/" title="网上教学">网上教学</a><img src="/templets/default/image/x.png"> <a href="/baoming.php" title="网上报名">网上报名</a><img src="/templets/default/image/x.png"> <a href="/html/about/" title="联系我们">联系我们</a> </div>
</div>
<!-- header end-->
<div class="site_container martop10 clear" >
    <div class="site_column site_container_div">
        <div class="site_cotainer_top">&nbsp;</div>
        <div class="site_cotainer_middle">
            <div class="site_side">
                <div class="site_side_caption">报名须知</div>
                <div class="site_side_content">
                    <div class="open_guidelines">
                    
                        <div id="studyDefault"><?php echo $guidelines_list[0]['content'];?></div>
						<?php
						foreach($guidelines_list as $key=>$row){
						?>
                        <div id="studytype<?php echo $row['catid'];?>"><?php echo $row['content'];?></div>
						<?php
						}
						?>
                    </div>
                </div>
            </div>
            <div class="site_main">
                <div class="site_position f_yahei_grey_12"><a href="/index.php" title="<?php echo $syscfgInfo['cfg_webname'];?>">首页</a> &gt; <span class="current">网上报名</span></div>
                <div class="site_dashed_underline">&nbsp;</div>
                <div class="studyentry_tips_tit">提示语</div>
                <div class="studyentry_tips_text">预报名信息提交后，我们会在24小时内为你提供专业的学业咨询，并引导你顺利完成后续报名程序。</div>
                <div class="studyentry_form">
                    <form action="studyenter.php" method="post" name="studyentryForm" target="_self">
                        <div class="studyentry_div">
                            <table width="100%" border="0" cellspacing="0" cellpadding="0" class="studyentry_table">
                                <tr>
                                    <td colspan="4" class="headtd">报读信息</td>
                                </tr>
                                <tr>
                                    <td class="commtd keytd"><span class="red_star">*</span> 报读类别</td>
                                    <td colspan="3" class="valuetd"><select name="typeid" id="typeid" onchange="selectChange('prev','typeid','univid',1);">
                                            <option value="0">请选择</option>
                                            <?php
											foreach($pub_studytype_list as $key=>$row){
                                            ?>
                                            <option value="<?php echo $row['id'];?>"><?php echo $row['cname'];?></option>
                                            <?php
                                            }
											?>
                                        </select></td>
                                </tr>
                                <tr>
                                    <td width="120" class="commtd keytd"><span class="red_star">*</span> 报读学校</td>
                                    <td width="235" class="valuetd"><select name="univid" id="univid" onchange="selectChange('typeid','univid','forbatch',2);">
                                            <option value="0">请选择</option>
                                        </select></td>
                                    <td width="120" class="keytd"><span class="red_star">*</span> 报读批次</td>
                                    <td width="*" class="valuetd"><select name="forbatch" id="forbatch" onchange="selectChange('univid','forbatch','majorlevel',3);">
                                            <option value="0">请选择</option>
                                        </select></td>
                                </tr>
                                <tr>
                                    <td class="commtd keytd"><span class="red_star">*</span> 报读层次</td>
                                    <td class="valuetd"><select name="majorlevel" id="majorlevel" onchange="getMajorName('univid','forbatch','majorlevel','majorid',4);">
                                            <option value="0">请选择</option>
                                        </select></td>
                                    <td class="keytd"><span class="red_star">*</span> 报读专业</td>
                                    <td class="valuetd"><select name="majorid" id="majorid" onchange="getMajorInfo('majorid',5);">
                                            <option value="0">请选择</option>
                                        </select></td>
                                </tr>
                            </table>
                        </div>
                        <div class="studyentry_div">
                            <table width="100%" border="0" cellspacing="0" cellpadding="0" class="studyentry_table">
                                <tr>
                                    <td colspan="6" class="headtd">费用参考</td>
                                </tr>
                                <tr>
                                    <td class="commtd keytd">毕业学分(学分)</td>
                                    <td align="center" class="valuetd"><span id="credit">0</span></td>
                                    <td class="keytd">费用标准（元/学分）</td>
                                    <td align="center" class="valuetd"><span id="tuition_standard">0</span></td>
                                  <td class="keytd">总学费(元)</td>
                                    <td align="center" class="valuetd"><span id="total_tuition">0</span></td>
                                </tr>
                                <tr>
                                    <td class="commtd keytd">报名费(元)</td>
                                    <td class="valuetd" align="center"><span id="entryfee">0</span></td>
                                    <td class="keytd">入学测试费(元)</td>
                                    <td align="center" class="valuetd"><span id="entrancefee">0</span></td>
                                  <td class="keytd">预收书本费(元)</td>
                                    <td align="center" class="valuetd"><span id="bookscosts">0</span></td>
                                </tr>
                            </table>
                        </div>
                        <div class="studyentry_div">
                            <table width="100%" border="0" cellspacing="0" cellpadding="0" class="studyentry_table">
                                <tr>
                                    <td colspan="2" class="headtd">报读人信息</td>
                                </tr>
                                <tr>
                                    <td width="80" class="commtd keytd"><span class="red_star">*</span> 真实姓名</td>
                                    <td class="valuetd"><input type="text" name="name" id="name" class="studyentry_comm_text" /></td>
                                </tr>
                                <tr>
                                    <td class="commtd keytd"><span class="red_star">*</span> 性别</td>
                                    <td class="valuetd"><input type="radio" name="sex" id="sex_boy" value="1" class="studyentry_comm_radio"  />
                                        <label for="sex_boy">男</label>
                                        <input type="radio" name="sex" id="sex_girl" value="2" class="studyentry_comm_radio"  />
                                        <label for="sex_girl">女</label></td>
                                </tr>
                                <tr>
                                    <td class="commtd keytd"><span class="red_star">*</span> 出生日期</td>
                                    <td class="valuetd"><input type="text" name="birthday" id="birthday" class="studyentry_comm_text" /></td>
                                </tr>
                                <tr>
                                    <td class="commtd keytd"><span class="red_star">*</span> 现在学历</td>
                                    <td class="valuetd"><input type="radio" name="existingeducation" id="edu_gaozhong" value="1" class="studyentry_comm_radio"  />
                                        <label for="edu_gaozhong">高中</label>
                                        <input type="radio" name="existingeducation" id="edu_zhongzhuan" value="2" class="studyentry_comm_radio" />
                                        <label for="edu_zhongzhuan">中专</label>
                                        <input type="radio" name="existingeducation" id="edu_jixiao" value="3" class="studyentry_comm_radio" />
                                        <label for="edu_jixiao">技校</label>
                                        <input type="radio" name="existingeducation" id="edu_zhuanke" value="4" class="studyentry_comm_radio" />
                                        <label for="edu_zhuanke">专科</label>
                                        <input type="radio" name="existingeducation" id="sex_benke" value="5" class="studyentry_comm_radio" />
                                        <label for="sex_benke">本科</label>
                                        <input type="radio" name="existingeducation" id="edu_other" value="6" class="studyentry_comm_radio" />
                                        <label for="edu_other">其他</label></td>
                                </tr>
                                <tr>
                                    <td class="commtd keytd"><span class="red_star">*</span> 移动电话</td>
                                    <td class="valuetd"><input type="text" name="phone" id="phone" class="studyentry_comm_text" /></td>
                                </tr>
                                <tr>
                                    <td class="commtd keytd">电子邮箱</td>
                                    <td class="valuetd"><input type="text" name="email" id="email" class="studyentry_comm_text" /></td>
                                </tr>
                                <tr>
                                    <td class="commtd keytd">备注</td>
                                    <td class="valuetd"><div class="studyentry_textarea_div">
                                            <textarea name="beizhu" id="beizhu" class="studyentry_textarea" ></textarea>
                                        </div></td>
                                </tr>
                            </table>

                        </div>
                        <div class="studyentry_div">
                            <table width="100%" border="0" cellspacing="0" cellpadding="0" class="studyentry_table">
                                <tr>
                                    <td colspan="2" class="studyentry_td_submit"><input type="submit" class="studyentry_btn_submit" value="&nbsp;" /><input type="reset" class="studyentry_btn_reset" value="&nbsp;" /></td>
                                </tr>
                               </table>
                         </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="site_cotainer_bottom">&nbsp;</div>
    </div>
    <div class="clear_line">&nbsp;</div>
</div>

<!-- footer begin -->
<div class="clear site_column martop10 friendlink">
    <div class="friendlink_div f_yahei_grey_12">
        <div class="friendlink_caption">友情链接：</div>
        <div class="friendlink_alink"><a href="#xiandai" title="西安电大现代教育工作站">西安电大现代教育工作站</a><a href="#guangdian" title="中央广播电视大学">中央广播电视大学</a><a href="#aopeng" title="奥鹏网络教育中心">奥鹏网络教育中心</a><a href="http://www.zhumeng365.com" title="西安助梦网络科技有限公司" target="_blank">西安助梦网络</a><a href="#xiandai" title="西安电大现代教育工作站">西安电大现代教育工作站</a><a href="#guangdian" title="中央广播电视大学">中央广播电视大学</a><a href="#aopeng" title="奥鹏网络教育中心">奥鹏网络教育中心</a><a href="http://www.zhumeng365.com" title="西安助梦网络科技有限公司" target="_blank">西安助梦网络</a></div>
    </div>
</div>
<div class="footer_copyright martop10 f_yahei_grey_12">
    <div class="site_column footer_copyright_div">
        <div class="footer_site_link"><span class="records_number">陕ICP备05007857号</span>|<a href="#forad" title="广告联系">广告联系</a>|<a href="#forad" title="广告联系">管理站点</a>|<a href="#forad" title="广告联系">联系我们</a>|<a href="http://www.zhumeng365.com" title="西安助梦网络科技有限公司" target="_blank">技术支持</a></div>
        <div class="school_addr">学校地址：西安市南关正街51号 学校电话：(029)87898109 传真：(029)87809797</div>
        <div class="training_addr">培训部地址：西安市经济开发区赛高国际大厦1107室 电话：(029)86137698 传真：(029)86137696</div>
    </div>
</div>
</body>
</html>
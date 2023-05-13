<?php
/**
 * Setting
 * 
 */
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
function themeConfig($form) {
    
/* 数据备份 */
$str1 = explode('/themes/', Helper::options()->themeUrl);
$str2 = explode('/', $str1[1]);
$name=$str2[0];
$db = Typecho_Db::get();
$sjdq=$db->fetchRow($db->select()->from ('table.options')->where ('name = ?', 'theme:'.$name));
$ysj = $sjdq['value'];
if(isset($_POST['type']))
{ 
if($_POST["type"]=="备份模板设置数据"){
if($db->fetchRow($db->select()->from ('table.options')->where ('name = ?', 'theme:'.$name.'bf'))){
$update = $db->update('table.options')->rows(array('value'=>$ysj))->where('name = ?', 'theme:'.$name.'bf');
$updateRows= $db->query($update);
echo '<div class="tongzhi col-mb-12 home">备份已更新，请等待自动刷新！如果等不到请点击';
?>    
<a href="<?php Helper::options()->adminUrl('options-theme.php'); ?>">这里</a></div>
<script language="JavaScript">window.setTimeout("location=\'<?php Helper::options()->adminUrl('options-theme.php'); ?>\'", 2500);</script>
<?php
}else{
if($ysj){
    $insert = $db->insert('table.options')
    ->rows(array('name' => 'theme:'.$name.'bf','user' => '0','value' => $ysj));
    $insertId = $db->query($insert);
echo '<div class="tongzhi col-mb-12 home">备份完成，请等待自动刷新！如果等不到请点击';
?>    
<a href="<?php Helper::options()->adminUrl('options-theme.php'); ?>">这里</a></div>
<script language="JavaScript">window.setTimeout("location=\'<?php Helper::options()->adminUrl('options-theme.php'); ?>\'", 2500);</script>
<?php
}
}
        }
if($_POST["type"]=="还原模板设置数据"){
if($db->fetchRow($db->select()->from ('table.options')->where ('name = ?', 'theme:'.$name.'bf'))){
$sjdub=$db->fetchRow($db->select()->from ('table.options')->where ('name = ?', 'theme:'.$name.'bf'));
$bsj = $sjdub['value'];
$update = $db->update('table.options')->rows(array('value'=>$bsj))->where('name = ?', 'theme:'.$name);
$updateRows= $db->query($update);
echo '<div class="tongzhi col-mb-12 home">检测到模板备份数据，恢复完成，请等待自动刷新！如果等不到请点击';
?>    
<a href="<?php Helper::options()->adminUrl('options-theme.php'); ?>">这里</a></div>
<script language="JavaScript">window.setTimeout("location=\'<?php Helper::options()->adminUrl('options-theme.php'); ?>\'", 2000);</script>
<?php
}else{
echo '<div class="tongzhi col-mb-12 home">没有模板备份数据，恢复不了哦！</div>';
}
}
if($_POST["type"]=="删除备份数据"){
if($db->fetchRow($db->select()->from ('table.options')->where ('name = ?', 'theme:'.$name.'bf'))){
$delete = $db->delete('table.options')->where ('name = ?', 'theme:'.$name.'bf');
$deletedRows = $db->query($delete);
echo '<div class="tongzhi col-mb-12 home">删除成功，请等待自动刷新，如果等不到请点击';
?>    
<a href="<?php Helper::options()->adminUrl('options-theme.php'); ?>">这里</a></div>
<script language="JavaScript">window.setTimeout("location=\'<?php Helper::options()->adminUrl('options-theme.php'); ?>\'", 2500);</script>
<?php
}else{
echo '<div class="tongzhi col-mb-12 home">不用删了！备份不存在！！！</div>';
}
}
    }

//查询是否备份
function CheckSetBack()
{
    $db = Typecho_Db::get();
    $res = $db->fetchRow($db->select()->from('table.options')->where('name = ?', 'theme:' . $GLOBALS['config']['theme'] . 'bf'));
    if ($res) {
        return '<span style="color: #1462ff">模板已备份</span>';
    } else {
        return '<span style="color: red">未备份任何数据</span>';
    }
}

echo '<form class="protected home" action="?'.$name.'bf" method="post" style="margin-bottom: 1rem;text-align: center;">
<div class="options-bf">
<input type="submit" name="type" class="btn btn-s" value="备份模板设置数据" />&nbsp;&nbsp;<input type="submit" name="type" class="btn btn-s" value="还原模板设置数据" />&nbsp;&nbsp;<input type="submit" name="type" class="btn btn-s" value="删除备份数据" />
</div>
</form>';
$CheckSetBack .= '<div class="typecho-option"><label class="typecho-label">主题设置项备份：' . CheckSetBack() . '</label></div>';

$ver = themeVersion();
echo '<link href="' . Helper::options()->themeUrl . '/src/css/options.css" rel="stylesheet" type="text/css" />
<script>var version = "'. $ver .'";</script>';


echo '
<div class="options-contain">
    <div class="options-left">
        <div class="options-left-aside">
            <div class="options-logo">A-My v'. $ver .' </div>
            <ul class="options-tab">
                <li data-current="options-notice">主题信息</li>
                <li data-current="options-Basic">基本设置</li>
                <li data-current="options-nav">导航设置</li>
                <li data-current="options-bloger">博主设置</li>
                <li data-current="options-sidebar">双栏设置</li>
                <li data-current="options-increase">增强功能</li>
                <li data-current="options-links">友情链接</li>
                <li data-current="options-customize">自定义设置</li>
                <li data-current="options-comments">评论设置</li>
                <li data-current="options-CommentPush">推送服务设置</li>
                <li data-current="options-orther">其它设置</li>
            </ul>
        </div>
    </div>

    <div class="options-notice"> 
        <h1 class="theme-plane-title">A-My 主题设置面板</h1>
        <ol>
            <li>'.$CheckSetBack.'</li>
            <li>欢迎食用A-My '. $ver .' ！</li>
            <li>作者博客：<a href="https://rz.sb" target="_blank">若志随笔</a></li>
            <li>主题文档：<a href="http://docs.rzv.cc/a-my" target="_blank">docs.rzv.cc/a-my</a></li>
            <li>欢迎加入售后群：<a href="https://jq.qq.com/?_wv=1027&k=iDp9GVN9" target="_blank">209406113</a></li>
        </ol>
    </div>
';
echo '
<script src="' . Helper::options()->themeUrl . '/src/js/plugins/jquery.js"></script>
<script src="' . Helper::options()->themeUrl . '/src/js/options.js"></script>
';


/* 基本设置 Basic*/
$favicon = new Typecho_Widget_Helper_Form_Element_Text(
    'favicon', NULL, 'https://q1.qlogo.cn/g?b=qq&nk=80360650&s=100',
    _t('站点Favicon'), _t('在这里填入一个图片地址, 用于站点的favicon')
);
$favicon->setAttribute('class', 'options-content options-Basic');
$form->addInput($favicon);

$sites_create_time = new Typecho_Widget_Helper_Form_Element_Text(
    'sites_create_time', NULL, '2018-10-29',
    _t('建站时间'), _t('在这里输入你的建站时间，显示你的站点运行时间，格式如：2018-10-29，清空即可隐藏')
);
$sites_create_time->setAttribute('class', 'options-content options-Basic');
$form->addInput($sites_create_time);

$bannerUrl = new Typecho_Widget_Helper_Form_Element_Text(
    'bannerUrl', NULL, '/usr/themes/A-My/src/img/1.webp',
    _t('博客头图'), _t('在这里填入一个图片 URL 地址, 用在头部背景图片')
);
$bannerUrl->setAttribute('class', 'options-content options-Basic');
$form->addInput($bannerUrl);

$background_image_bgUrl = new Typecho_Widget_Helper_Form_Element_Text(
    'background_image_bgUrl', NULL, NULL,
    _t('背景图'), _t('
    在这里填入一个图片 URL 地址, 用在站点背景图片,不填则默认纯色，可直链，可路径，比如：/usr/themes/A-My/src/img/bg.webp<br />
    ')
);
$background_image_bgUrl->setAttribute('class', 'options-content options-Basic');
$form->addInput($background_image_bgUrl);

$dark_bgUrl = new Typecho_Widget_Helper_Form_Element_Text(
    'dark_bgUrl', NULL, NULL,
    _t('夜间模式背景图'), _t('
    在这里填入一个图片 URL 地址, 用在夜间模式背景图<br />
    ')
);
$dark_bgUrl->setAttribute('class', 'options-content options-Basic');
$form->addInput($dark_bgUrl);

/* 导航设置 nav */

$nav_item = new Typecho_Widget_Helper_Form_Element_Textarea('nav_item', NULL, 
'https://www.rz.sb/ , 自定义导航1
https://www.rz.sb/ , 自定义导航2', _t('增加导航栏项'), 
_t('
在这里填入欲显示在页面导航的链接<br />
格式：站点链接 , 站点标题 （中间使用,英文逗号分隔）<br />
其他：一行一个，一行代表一个友链 <br />
例如：<br />
https://www.rz.sb/ , 自定义导航1<br />
https://www.rz.sb/ , 自定义导航2
'));
$nav_item->setAttribute('class', 'options-content options-nav');
$form->addInput($nav_item);

$nav_item_category = new Typecho_Widget_Helper_Form_Element_Checkbox('nav_item_category', 
array('photos' => _t('显示相册'),
'books' => _t('显示书单'),
'movies' => _t('显示影单')),
NULL, _t('导航栏相册、书单、影单展示'));
$nav_item_category->setAttribute('class', 'options-content options-nav');
$form->addInput($nav_item_category->multiMode());


$category_switch = new Typecho_Widget_Helper_Form_Element_Radio(
    'category_switch', array('0'=> '显示', '1'=> '隐藏'), 0, '是否显示分类<br />',
        '导航栏是否显示分类');
$category_switch->setAttribute('class', 'options-content options-nav');
$form->addInput($category_switch);

//前后顺序
$pageortags = new Typecho_Widget_Helper_Form_Element_Radio('pageortags', array('0' => '分前独后', '1' => '独前分后',), '0', '分类与独立页面顺序', '默认为分类在前，独立页面在后;如果需要分类在后，建议下一设置项：分类展开');
$form->addInput($pageortags);
$pageortags->setAttribute('class', 'options-content options-nav');
//合并分类
$sortalls = new Typecho_Widget_Helper_Form_Element_Radio('sortalls', array('0' => '展开分类', '1' => '合并分类'), '1', '分类选项', '分类合并还是展开？默认合并');
$form->addInput($sortalls);
$sortalls->setAttribute('class', 'options-content options-nav');
//分类合并显示名称
$sortallname = new Typecho_Widget_Helper_Form_Element_Text('sortallname', NULL, '分类', _t('分类合并分类显示名称'), _t('在这里输入导航栏页面下拉菜单的显示名称，默认为：分类'));
$form->addInput($sortallname);
$sortallname->setAttribute('class', 'options-content options-nav');

//}
/* 博主设置 bloger*/

$author_gravatar = new Typecho_Widget_Helper_Form_Element_Text(
    'author_gravatar', NULL, 'https://q1.qlogo.cn/g?b=qq&nk=80360650&s=100',
    _t('博主头像'), _t('你的头像')
);
$author_gravatar->setAttribute('class', 'options-content options-bloger');
$form->addInput($author_gravatar);

$index_gravatar_Select = new Typecho_Widget_Helper_Form_Element_Select('index_gravatar_Select',array('0'=> '博主设置中的博主头像', '1'=> '后台个人资料邮箱解析的地址'), 0, '文章内页博主头像显示选择',
'这里选择的是博主头像显示的方式');
$index_gravatar_Select->setAttribute('class', 'options-content options-bloger');
$form->addInput($index_gravatar_Select);

$author_gravatar_url = new Typecho_Widget_Helper_Form_Element_Text(
    'author_gravatar_url', NULL, '#',
    _t('博主头像跳转地址'), _t('请输入点击头像跳转地址')
);
$author_gravatar_url->setAttribute('class', 'options-content options-bloger');
$form->addInput($author_gravatar_url);

$author_name = new Typecho_Widget_Helper_Form_Element_Text(
    'author_name', NULL, '若志奕鑫',
    _t('博主昵称'), _t('你叫什么？')
);
$author_name->setAttribute('class', 'options-content options-bloger');
$form->addInput($author_name);

$author_describe = new Typecho_Widget_Helper_Form_Element_Text(
    'author_describe', NULL, '愿世界安康，愿你我皆好！',
    _t('博主描述'), _t('在这里填入签名, 描述博主')
);
$author_describe->setAttribute('class', 'options-content options-bloger');
$form->addInput($author_describe);

$author_describe_typed = new Typecho_Widget_Helper_Form_Element_Checkbox('author_describe_typed', 
array('author_describe_typed' => _t('开启')),
array('author_describe_typed'), _t('是否开启博主描述打字效果'),_t('是否开启博主描述打字效果'));
$author_describe_typed->setAttribute('class', 'options-content options-bloger');
$form->addInput($author_describe_typed->multiMode());

/* 双栏设置 sidebar*/
$sidebar_switch = new Typecho_Widget_Helper_Form_Element_Select('sidebar_switch',array('0'=> '关闭', '1'=> '开启'), 1, '是否开启双栏布局',
'双栏布局，打开即增加侧边栏，移动端不显示');
$sidebar_switch->setAttribute('class', 'options-content options-sidebar');
$form->addInput($sidebar_switch->multiMode());

$sidebar_box_show = new Typecho_Widget_Helper_Form_Element_Checkbox('sidebar_box_show', 
array('gg' => _t('显示公告'),
'yy' => _t('显示一言'),
'zxpl' => _t('显示最新评论'),
'sjwz' => _t('显示随机文章')),
array('yy', 'zxpl', 'sjwz'), _t('侧边栏模块展示'));
$sidebar_box_show->setAttribute('class', 'options-content options-sidebar');
$form->addInput($sidebar_box_show->multiMode());

$gonggao = new Typecho_Widget_Helper_Form_Element_Textarea(
    'gonggao', NULL, '这是公告内容...',
    _t('公告'), _t('请输入需要展示的公告')
);
$gonggao->setAttribute('class', 'options-content options-sidebar');
$form->addInput($gonggao);

$sjwz_img = new Typecho_Widget_Helper_Form_Element_Checkbox('sjwz_img', 
array('sjwz_img' => _t('显示')),
NULL, _t('是否显示随机文章左图'));
$sjwz_img->setAttribute('class', 'options-content options-sidebar');
$form->addInput($sjwz_img->multiMode());

$sidebar_box = new Typecho_Widget_Helper_Form_Element_Textarea('sidebar_box',
NULL, 
NULL, 
_t('侧边栏模块添加'), 
_t('
介绍：用于侧边栏模块添加，请务必填写正确的格式 <br />
格式：标题 , 内容 （中间使用,英文逗号分隔）<br />
其他：一行一个，一行代表一个侧边栏模块 <br />
例如：<br />
广告位 , 这是广告内容<br />
    '));
$sidebar_box->setAttribute('class', 'options-content options-sidebar');
$form->addInput($sidebar_box);

/* 增强功能 increase*/
$JEditor = new Typecho_Widget_Helper_Form_Element_Select(
    'JEditor',
    array(
        'on' => '开启（默认）',
        'off' => '关闭',
    ),
    'on',
    '是否启用Joe自定义编辑器',
    '介绍：开启后，文章编辑器将替换成Joe编辑器 <br>
     其他：目前编辑器处于拓展阶段，如果想继续使用原生编辑器，关闭此项即可'
);
$JEditor->setAttribute('class', 'options-content options-increase');
$form->addInput($JEditor->multiMode());

$sticky_cids = new Typecho_Widget_Helper_Form_Element_Text(
    'sticky_cids', NULL, '',
    '首页置顶文章的 cid', '按照排序输入, 请以半角逗号或空格分隔 cid.');
    $sticky_cids->setAttribute('class', 'options-content options-increase');
$form->addInput($sticky_cids);

$sticky_html = new Typecho_Widget_Helper_Form_Element_Textarea(
    'sticky_html', NULL, "<span style='color:red'>[置顶] </span>",
    '置顶标题的 html', '例子:&lt;span style="color:red">[置顶] &lt;/span>');
$sticky_html->input->setAttribute('rows', '7')->setAttribute('cols', '80');
$sticky_html->setAttribute('class', 'options-content options-increase');
$form->addInput($sticky_html);

$pjax_switch = new Typecho_Widget_Helper_Form_Element_Select('pjax_switch',array('0'=> '关闭', '1'=> '开启'), 1, '是否开启Pjax加载',
'Pjax加载，网站响应速度更快');
$pjax_switch->setAttribute('class', 'options-content options-increase');
$form->addInput($pjax_switch->multiMode());
$pjax_complete = new Typecho_Widget_Helper_Form_Element_Textarea('pjax_complete', NULL, NULL, _t('Pjax 回调函数'), _t('Pjax 跳转页面后执行的事件，写入 js 代码，一般将 Pjax 重载(回调)函数写在这里。<hr>'));
$pjax_complete->setAttribute('class', 'options-content options-increase');
$form->addInput($pjax_complete);

$ymusic = new Typecho_Widget_Helper_Form_Element_Select(
'ymusic', array('0'=> '关闭', '1'=> '开启'), 0, '是否开启背景播放器',
    '自动播放顾名思义，就是开不开启背景播放器，开启的话，将在首页显示，不开启的话隐藏，<span style="color:red;display:inline-block">建议同时开启Pjax加载！</span>体验更佳');
$ymusic->setAttribute('class', 'options-content options-increase');
$form->addInput($ymusic);
$bof = new Typecho_Widget_Helper_Form_Element_Radio(
'bof', array('0'=> '不自动播放', '1'=> '自动播放'), 0, '播放设置',
    '自动播放顾名思义，就是页面打开后音乐就会自动播放');
$bof->setAttribute('class', 'options-content options-increase');
$form->addInput($bof);
$sxj = new Typecho_Widget_Helper_Form_Element_Radio(
'sxj', array('0'=> '隐藏', '1'=> '不隐藏'), 0, '手机端是/否隐藏',
    '手机端是/否隐藏音乐播放器');
$sxj->setAttribute('class', 'options-content options-increase');
$form->addInput($sxj);
$musicList = new Typecho_Widget_Helper_Form_Element_Textarea('musicList', NULL, 
'',_t('歌曲列表'), _t('
<div style="
    background: #fff;
    padding: 10px;
    margin-top: -0.5em;
">填写格式<p>直链方式：</b><br>填写歌曲链接地址即可，多首歌曲的话请在两首歌曲之间加换行，千万别多加回车换行。</p>
<p>调用网易云：</b><br>书写网易云歌曲id即可，多首歌曲的话请在两首歌曲id之间加换行，单首歌曲直接写id就行，千万别多加回车换行</p>
<p>注意：</b><br>这两种填写方式不能混合输入，要么只用直链方式，要么只用网易云方式</p>
</div>
'));
$musicList->setAttribute('class', 'options-content options-increase');
$form->addInput($musicList);


/* 友情链接 links*/
$randomFriends = new Typecho_Widget_Helper_Form_Element_Checkbox('randomFriends', 
array('randomFriends' => _t('随机排序')),
array('randomFriends'), _t('友链排序方式'));
$randomFriends->setAttribute('class', 'options-content options-links');
$form->addInput($randomFriends->multiMode());

$friends = new Typecho_Widget_Helper_Form_Element_Textarea('friends',
NULL, 
'https://q1.qlogo.cn/g?b=qq&nk=80360650&s=100 , https://www.rz.sb/ , 若志随笔1 , 愿世界安康，愿你我皆好！
https://q1.qlogo.cn/g?b=qq&nk=80360650&s=100 , https://www.rz.sb/ , 若志随笔2 , 愿世界安康，愿你我皆好！', 
_t('友情链接'), 
_t('
介绍：用于显示友链，请务必填写正确的格式 <br />
格式：图片地址 , 站点链接 , 站点标题 , 站点介绍 （中间使用,英文逗号分隔）<br />
其他：一行一个，一行代表一个友链 <br />
例如：<br />
https://q1.qlogo.cn/g?b=qq&nk=80360650&s=100 , https://www.rz.sb/ , 若志随笔1 , 愿世界安康，愿你我皆好！<br />
https://q1.qlogo.cn/g?b=qq&nk=80360650&s=100 , https://www.rz.sb/ , 若志随笔2 , 愿世界安康，愿你我皆好！
    '));
$friends->setAttribute('class', 'options-content options-links');
$form->addInput($friends);

/* 自定义设置 customize*/
$GravatarUrl = new Typecho_Widget_Helper_Form_Element_Text('GravatarUrl',null,'https://cravatar.cn/avatar/', '自定义Gravatar镜像源地址', 
'请填入自定义Gravatar镜像源地址, <br />
推荐：<br />
https://cravatar.cn/avatar/<br />
https://sdn.geekzu.org/avatar/<br />
https://gravatar.loli.net/avatar/<br />
https://dn-qiniu-avatar.qbox.me/avatar/
');
$GravatarUrl->setAttribute('class', 'options-content options-customize');
$form->addInput($GravatarUrl);

$Thumbnail_Select = new Typecho_Widget_Helper_Form_Element_Select('Thumbnail_Select',array('0'=> '选取随机缩略图', '1'=> '选取文章第一张图'), 0, '文章缩略图展示方式',
'若自定义字段中自定义缩略图未填写时展示的图片方式');
$Thumbnail_Select->setAttribute('class', 'options-content options-customize');
$form->addInput($Thumbnail_Select);

$Thumbnail = new Typecho_Widget_Helper_Form_Element_Textarea(
    'Thumbnail',
    NULL,
    NULL,
    '自定义缩略图',
    '介绍：用于修改主题默认缩略图 <br/>
     格式：图片地址，一行一个 <br />
     注意：不填写时，则使用主题内置的默认缩略图
     '
);
$Thumbnail->setAttribute('class', 'options-content options-customize');
$form->addInput($Thumbnail);

$ArchiveHeaderBgurl = new Typecho_Widget_Helper_Form_Element_Text(
    'ArchiveHeaderBgurl',
    NULL,
    '/usr/themes/A-My/src/img/1.webp',
    '自定义搜索、标签、分类页头部缩略图',
    '介绍：用于修改主题搜索、标签、分类页头部缩略图
     '
);
$ArchiveHeaderBgurl->setAttribute('class', 'options-content options-customize');
$form->addInput($ArchiveHeaderBgurl);


$Diyfont = new Typecho_Widget_Helper_Form_Element_Text('Diyfont',null,'', '自定义字体', '您可以自定义网站所显示的字体，请填入字体直链，若为空则表示使用默认字体');
$Diyfont->setAttribute('class', 'options-content options-customize');
$form->addInput($Diyfont);

$CustomPlayer = new Typecho_Widget_Helper_Form_Element_Text(
    'CustomPlayer',
    NULL,
    NULL,
    '自定义视频播放器api（非必填）',
    '介绍：用于修改主题自带的默认播放器DPlayer <br />
     例如：https://zomv.cn/jx/?url= <br />'
);
$CustomPlayer->setAttribute('class', 'options-content options-customize');
$form->addInput($CustomPlayer);

$headmyself = new Typecho_Widget_Helper_Form_Element_Textarea('headmyself', NULL, NULL, _t('自定义头部信息'), _t('填写 html 代码，将输出在 <head> 标签中，可以在这里写上统计代码'));
$headmyself->setAttribute('class', 'options-content options-customize');
$form->addInput($headmyself);

$IcpBa = new Typecho_Widget_Helper_Form_Element_Text('IcpBa', null, '', 'ICP备案号', '请填写您网站的ICP备案号,若无ICP备案请为空');
$IcpBa->setAttribute('class', 'options-content options-customize');
$form->addInput($IcpBa);

$PoliceBa = new Typecho_Widget_Helper_Form_Element_Text('PoliceBa', null, '', '公安备案号', '请填写您网站的公安备案号,若无公安备案请为空');
$PoliceBa->setAttribute('class', 'options-content options-customize');
$form->addInput($PoliceBa);

$footermyself = new Typecho_Widget_Helper_Form_Element_Textarea('footermyself', NULL, NULL, _t('自定义页脚部信息'), _t('填写 html 代码，将输出在页脚的版权信息之后'));
$footermyself->setAttribute('class', 'options-content options-customize');
$form->addInput($footermyself);

$Cssmyself = new Typecho_Widget_Helper_Form_Element_Textarea('Cssmyself', NULL, NULL, _t('自定义 CSS'), _t('填写 CSS 代码，输出在 head 标签结束之前的 style 标签内'));
$Cssmyself->setAttribute('class', 'options-content options-customize');
$form->addInput($Cssmyself);

$JavaScriptmyself = new Typecho_Widget_Helper_Form_Element_Textarea('JavaScriptmyself', NULL, NULL, _t('自定义 JavaScript'), _t('填写 JavaScript代码，输出在 body 标签结束之前'));
$JavaScriptmyself->setAttribute('class', 'options-content options-customize');
$form->addInput($JavaScriptmyself);

/* 评论设置 comments*/
$opt_ip = new Typecho_Widget_Helper_Form_Element_Radio('opt_ip', array("none" => "无动作", "waiting" => "标记为待审核", "spam" => "标记为垃圾", "abandon" => "评论失败"), "abandon",
_t('屏蔽IP操作'), "如果评论发布者的IP在屏蔽IP段，将执行该操作");
$form->addInput($opt_ip);
$opt_ip->setAttribute('class', 'options-content options-comments');

$words_ip = new Typecho_Widget_Helper_Form_Element_Textarea('words_ip', NULL, "0.0.0.0",
_t('屏蔽IP'), _t('多条IP请用换行符隔开<br />支持用*号匹配IP段，如：192.168.*.*'));
$form->addInput($words_ip);
$words_ip->setAttribute('class', 'options-content options-comments');

$opt_mail = new Typecho_Widget_Helper_Form_Element_Radio('opt_mail', array("none" => "无动作", "waiting" => "标记为待审核", "spam" => "标记为垃圾", "abandon" => "评论失败"), "abandon",
_t('屏蔽邮箱操作'), "如果评论发布者的邮箱与禁止的一致，将执行该操作");
$form->addInput($opt_mail);
$opt_mail->setAttribute('class', 'options-content options-comments');

$words_mail = new Typecho_Widget_Helper_Form_Element_Textarea('words_mail', NULL, "",
_t('邮箱关键词'), _t('多个邮箱请用换行符隔开<br />可以是邮箱的全部，或者邮箱部分关键词'));
$form->addInput($words_mail);        
$words_mail->setAttribute('class', 'options-content options-comments');

$opt_url = new Typecho_Widget_Helper_Form_Element_Radio('opt_url', array("none" => "无动作", "waiting" => "标记为待审核", "spam" => "标记为垃圾", "abandon" => "评论失败"), "abandon",
_t('屏蔽网址操作'), "如果评论发布者的网址与禁止的一致，将执行该操作。如果网址为空，该项不会起作用。");
$form->addInput($opt_url);
$opt_url->setAttribute('class', 'options-content options-comments');

$words_url = new Typecho_Widget_Helper_Form_Element_Textarea('words_url', NULL, "",
_t('网址关键词'), _t('多个网址请用换行符隔开<br />可以是网址的全部，或者网址部分关键词。如果网址为空，该项不会起作用。'));
$form->addInput($words_url);
$words_url->setAttribute('class', 'options-content options-comments');

$opt_title = new Typecho_Widget_Helper_Form_Element_Radio('opt_title', array("none" => "无动作", "waiting" => "标记为待审核", "spam" => "标记为垃圾", "abandon" => "评论失败"), "abandon",
_t('内容含有文章标题'), "如果评论内容中含有本页面的文章标题，则强行按该操作执行");
$form->addInput($opt_title);
$opt_title->setAttribute('class', 'options-content options-comments');

$opt_au = new Typecho_Widget_Helper_Form_Element_Radio('opt_au', array("none" => "无动作", "waiting" => "标记为待审核", "spam" => "标记为垃圾", "abandon" => "评论失败"), "abandon",
_t('屏蔽昵称关键词操作'), "如果评论发布者的昵称含有该关键词，将执行该操作");
$form->addInput($opt_au);
$opt_au->setAttribute('class', 'options-content options-comments');

$words_au = new Typecho_Widget_Helper_Form_Element_Textarea('words_au', NULL, "",
_t('屏蔽昵称关键词'), _t('多个关键词请用换行符隔开'));
$form->addInput($words_au);
$words_au->setAttribute('class', 'options-content options-comments');

$au_length_min = new Typecho_Widget_Helper_Form_Element_Text('au_length_min', NULL, '1', '昵称最短字符数', '昵称允许的最短字符数。');
$form->addInput($au_length_min);
$au_length_min->setAttribute('class', 'options-content options-comments');

$au_length_max = new Typecho_Widget_Helper_Form_Element_Text('au_length_max', NULL, '15', '昵称最长字符数', '昵称允许的最长字符数');
$form->addInput($au_length_max);
$au_length_max->setAttribute('class', 'options-content options-comments');

$opt_au_length = new Typecho_Widget_Helper_Form_Element_Radio('opt_au_length', array("none" => "无动作", "waiting" => "标记为待审核", "spam" => "标记为垃圾", "abandon" => "评论失败"), "abandon",
_t('昵称字符长度操作'), "如果昵称长度不符合条件，则强行按该操作执行。如果选择[无动作]，将忽略下面长度的设置");
$form->addInput($opt_au_length);   
$opt_au_length->setAttribute('class', 'options-content options-comments');

$opt_nojp_au = new Typecho_Widget_Helper_Form_Element_Radio('opt_nojp_au', array("none" => "无动作", "waiting" => "标记为待审核", "spam" => "标记为垃圾", "abandon" => "评论失败"), "abandon",
_t('昵称日文操作'), "如果用户昵称中包含日文，则强行按该操作执行");
$form->addInput($opt_nojp_au);
$opt_nojp_au->setAttribute('class', 'options-content options-comments');

$opt_nourl_au = new Typecho_Widget_Helper_Form_Element_Radio('opt_nourl_au', array("none" => "无动作", "waiting" => "标记为待审核", "spam" => "标记为垃圾", "abandon" => "评论失败"), "abandon",
_t('昵称网址操作'), "如果用户昵称是网址，则强行按该操作执行");
$form->addInput($opt_nourl_au);
$opt_nourl_au->setAttribute('class', 'options-content options-comments');

$opt_nojp = new Typecho_Widget_Helper_Form_Element_Radio('opt_nojp', array("none" => "无动作", "waiting" => "标记为待审核", "spam" => "标记为垃圾", "abandon" => "评论失败"), "abandon",
_t('日文评论操作'), "如果评论中包含日文，则强行按该操作执行");
$form->addInput($opt_nojp);
$opt_nojp->setAttribute('class', 'options-content options-comments');

$opt_nocn = new Typecho_Widget_Helper_Form_Element_Radio('opt_nocn', array("none" => "无动作", "waiting" => "标记为待审核", "spam" => "标记为垃圾", "abandon" => "评论失败"), "none",
_t('非中文评论操作'), "如果评论中不包含中文，则强行按该操作执行");
$form->addInput($opt_nocn);
$opt_nocn->setAttribute('class', 'options-content options-comments');

$length_min = new Typecho_Widget_Helper_Form_Element_Text('length_min', NULL, '1', '评论最短字符数', '允许评论的最短字符数。');
$form->addInput($length_min);
$length_min->setAttribute('class', 'options-content options-comments');

$length_max = new Typecho_Widget_Helper_Form_Element_Text('length_max', NULL, '1000', '评论最长字符数', '允许评论的最长字符数');
$form->addInput($length_max);
$length_max->setAttribute('class', 'options-content options-comments');

$opt_length = new Typecho_Widget_Helper_Form_Element_Radio('opt_length', array("none" => "无动作", "waiting" => "标记为待审核", "spam" => "标记为垃圾", "abandon" => "评论失败"), "abandon",
_t('评论字符长度操作'), "如果评论中长度不符合条件，则强行按该操作执行。如果选择[无动作]，将忽略下面长度的设置");
$form->addInput($opt_length);    
$opt_length->setAttribute('class', 'options-content options-comments');    

$opt_ban = new Typecho_Widget_Helper_Form_Element_Radio('opt_ban', array("none" => "无动作", "waiting" => "标记为待审核", "spam" => "标记为垃圾", "abandon" => "评论失败"), "abandon",
_t('禁止词汇操作'), "如果评论中包含禁止词汇列表中的词汇，将执行该操作");
$form->addInput($opt_ban);
$opt_ban->setAttribute('class', 'options-content options-comments');

$words_ban = new Typecho_Widget_Helper_Form_Element_Textarea('words_ban', NULL, "fuck\n操你妈\n[url\n[/url]",
_t('禁止词汇'), _t('多条词汇请用换行符隔开'));
$form->addInput($words_ban);
$words_ban->setAttribute('class', 'options-content options-comments');

$opt_chk = new Typecho_Widget_Helper_Form_Element_Radio('opt_chk', array("none" => "无动作", "waiting" => "标记为待审核", "spam" => "标记为垃圾", "abandon" => "评论失败"), "abandon",
_t('敏感词汇操作'), "如果评论中包含敏感词汇列表中的词汇，将执行该操作");
$form->addInput($opt_chk);
$opt_chk->setAttribute('class', 'options-content options-comments');

$words_chk = new Typecho_Widget_Helper_Form_Element_Textarea('words_chk', NULL, "http://",
_t('敏感词汇'), _t('多条词汇请用换行符隔开<br />注意：如果词汇同时出现于禁止词汇，则执行禁止词汇操作'));
$form->addInput($words_chk);
$words_chk->setAttribute('class', 'options-content options-comments');

/* 评论发信推送服务设置 */
$CommentsMail = new Typecho_Widget_Helper_Form_Element_Select(
    'CommentsMail',
    array('off' => '关闭（默认）', 'on' => '开启'),
    'off',
    '是否开启评论邮件通知',
    '介绍：开启后评论内容将会进行邮箱通知 <br />
     注意：此项需要您完整无错的填写下方的邮箱设置！！ <br />
     其他：下方例子以QQ邮箱为例，推荐使用QQ邮箱'
);
$CommentsMail->setAttribute('class', 'options-content options-CommentPush');
$form->addInput($CommentsMail->multiMode());

$CommentsMailHost = new Typecho_Widget_Helper_Form_Element_Text(
    'CommentsMailHost',
    NULL,
    NULL,
    '邮箱服务器地址',
    '例如：smtp.qq.com'
);
$CommentsMailHost->setAttribute('class', 'options-content options-CommentPush');
$form->addInput($CommentsMailHost->multiMode());

$CommentsSMTPSecure = new Typecho_Widget_Helper_Form_Element_Select(
    'CommentsSMTPSecure',
    array('ssl' => 'ssl（默认）', 'tsl' => 'tsl'),
    'ssl',
    '加密方式',
    '介绍：用于选择登录鉴权加密方式'
);
$CommentsSMTPSecure->setAttribute('class', 'options-content options-CommentPush');
$form->addInput($CommentsSMTPSecure->multiMode());

$CommentsMailPort = new Typecho_Widget_Helper_Form_Element_Text(
    'CommentsMailPort',
    NULL,
    NULL,
    '邮箱服务器端口号',
    '例如：465'
);
$CommentsMailPort->setAttribute('class', 'options-content options-CommentPush');
$form->addInput($CommentsMailPort->multiMode());

$CommentsMailFromName = new Typecho_Widget_Helper_Form_Element_Text(
    'CommentsMailFromName',
    NULL,
    NULL,
    '发件人昵称',
    '例如：若志奕鑫'
);
$CommentsMailFromName->setAttribute('class', 'options-content options-CommentPush');
$form->addInput($CommentsMailFromName->multiMode());

$CommentsMailAccount = new Typecho_Widget_Helper_Form_Element_Text(
    'CommentsMailAccount',
    NULL,
    NULL,
    '发件人邮箱',
    'irils@qq.com'
);
$CommentsMailAccount->setAttribute('class', 'options-content options-CommentPush');
$form->addInput($CommentsMailAccount->multiMode());

$CommentsMailPassword = new Typecho_Widget_Helper_Form_Element_Text(
    'CommentsMailPassword',
    NULL,
    'oqptbkrewsykhfjd',
    '邮箱授权码',
    '介绍：这里填写的是邮箱生成的授权码 <br>
     获取方式（以QQ邮箱为例）：<br>
     QQ邮箱 > 设置 > 账户 > IMAP/SMTP服务 > 开启 <br>
     其他：这个可以百度一下开启教程，有图文教程'
);
$CommentsMailPassword->setAttribute('class', 'options-content options-CommentPush');
$form->addInput($CommentsMailPassword->multiMode());

$CommentsToMailAuthorHtml = new Typecho_Widget_Helper_Form_Element_Textarea('CommentsToMailAuthorHtml',
NULL, 
'<div style="border-radius:5px;font-size:13px;width:680px;margin:30px auto 0;max-width:100%"><div style="box-shadow:0 0 30px 0 rgb(219 216 214);border-radius:5px;width:630px;margin:auto;max-width:100%;margin-bottom:-30px"><div style="line-height:180%;padding:0 15px 12px;margin:10px auto;color:#555;font-size:12px;margin-bottom:0"><h2 style="border-bottom:1px solid #ddd;font-size:14px;font-weight:400;padding:13px 0 10px 8px"><span style="color:#12addb;font-weight:700">&gt; </span>您的文章 <a style="text-decoration:none;color:#de6561" href="{permalink}" target="_blank">《{title}》</a>有了新的评论耶~</h2><div style="padding:0 12px 0 12px;margin-top:18px"><p>时间：<span style="border-bottom:1px dashed #ccc" t="5" times=" 20:42">{time}</span></p><div class="Messages_box"><p><strong>{author}</strong> 给你评论：</p><div class="ax_post_box-comments-single Messages-user" style="display:flex;margin-bottom:5px"><div class="ax_post_box-comment-avatar" style="width:auto;flex:none"><img src="{imgUrl}" style="width:40px;height:40px;border-radius:5px"></div><div class="ax_post_box-comment-text" style="position:relative;margin-left:10px"><span class="ax_post_box-comment-text-before" style="width:0;height:0;border-top:8px solid transparent;border-bottom:8px solid transparent;border-right:8px solid;border-right-color:#f4f4f4;left:-7px;right:auto;top:12px;position:absolute"></span><div class="ax_post_box-comment-text-inner" style="background-color:#f1f3fa;padding:10px;border-radius:9px;margin-bottom:3px">{content}</div></div></div></div><p>其他信息：</p><p style="background-color:#f5f5f5;border:0 solid #ddd;padding:10px 15px;margin:18px 0">IP：{ip}<br>邮箱：<a href="mailto:{mail}">{mail}</a><br>状态：{status} [<a href="{manage}" target="_blank">管理评论</a>]</p></div></div><div style="text-align:center"><a style="text-decoration:none;color:#fff;background-color:#94a9b9;padding:5px 20px;border-radius:4px;position:absolute;margin-left:-35px;margin-top:10px" href="{permalink}" target="_blank">查看</a></div></div><div style="height:345px;background-repeat:no-repeat;border-radius:5px 5px 0 0;background-image:url(https://cdn.jsdelivr.net/gh/iRoZhi/irils-imgs/picgo/commttomailbg.png);background-size:cover;background-position:50% 50%;max-width:100%"></div><div style="color:#8c8c8c;font-size:10px;width:100%;text-align:center"><p>©2021 Copyright 若志-随笔</p></div></div>', 
_t('自定义邮件通知模板-博主收'), 
_t('
介绍：用于博主收邮件时显示的邮件通知模板，支持html <br>
相关调用代码介绍： <br>
{title}：文章标题 <br>
{author}：评论者昵称 <br>
{ip}：评论者ip <br>
{mail}：评论者mail <br>
{time}：评论时间 <br>
{permalink}：评论链接地址 <br>
{content}：评论内容 <br>
{status}：评论状态 <br>
{manage}：后台评论管理地址 <br>
{imgUrl}：评论者头像链接
    '));
$CommentsToMailAuthorHtml->setAttribute('class', 'options-content options-CommentPush');
$form->addInput($CommentsToMailAuthorHtml);

$CommentsToMailParentHtml = new Typecho_Widget_Helper_Form_Element_Textarea('CommentsToMailParentHtml',
NULL, 
'<div style="border-radius:5px;font-size:13px;width:680px;margin:30px auto 0;max-width:100%"><div style="box-shadow:0 0 30px 0 rgb(219 216 214);border-radius:5px;width:630px;margin:auto;max-width:100%;margin-bottom:-30px"><div style="width:200px;height:40px;margin-top:-20px;margin-left:0;text-align:center;line-height:40px;text-decoration:none;color:#fff;background-color:#94a9b9;border-radius:5px 0">Dear: {parentAuthor}</div><div style="line-height:180%;padding:0 15px 12px;margin:30px auto;color:#555;font-size:12px;margin-bottom:0"><h2 style="border-bottom:1px solid #ddd;font-size:14px;font-weight:400;padding:13px 0 10px 8px"><span style="color:#12addb;font-weight:700">&gt; </span>您在 <a style="text-decoration:none;color:#de6561" href="{permalink}" target="_blank">《{title}》</a>的评论有了新的回复呐~</h2><div style="padding:0 12px 0 12px;margin-top:18px"><p>时间：<span style="border-bottom:1px dashed #ccc" t="5" times=" 20:42">{time}</span></p><div class="Messages_box"><p style="display:flex;justify-content:flex-end">您说：</p><div class="ax_post_box-comments-single Messages-author" style="display:flex;justify-content:flex-end;margin-bottom:5px"><div class="ax_post_box-comment-avatar" style="width:auto;flex:none;order:2"><img src="{parentImgUrl}" style="width:40px;height:40px;border-radius:5px"></div><div class="ax_post_box-comment-text" style="position:relative;margin-right:10px"><span class="ax_post_box-comment-text-before" style="width:0;height:0;border-top:8px solid transparent;border-bottom:8px solid transparent;border-left:8px solid;border-left-color:#f4f4f4;border-right:0;border-right-color:transparent;right:-7px;left:auto;top:12px;position:absolute"></span><div class="ax_post_box-comment-text-inner" style="background-color:#f1f3fa;padding:10px;border-radius:9px;margin-bottom:3px">{parentContent}</div></div></div><p><strong>{author}</strong> 给你回复：</p><div class="ax_post_box-comments-single Messages-user" style="display:flex;margin-bottom:5px"><div class="ax_post_box-comment-avatar" style="width:auto;flex:none"><img src="{imgUrl}" style="width:40px;height:40px;border-radius:5px"></div><div class="ax_post_box-comment-text" style="position:relative;margin-left:10px"><span class="ax_post_box-comment-text-before" style="width:0;height:0;border-top:8px solid transparent;border-bottom:8px solid transparent;border-right:8px solid;border-right-color:#f4f4f4;left:-7px;right:auto;top:12px;position:absolute"></span><div class="ax_post_box-comment-text-inner" style="background-color:#f1f3fa;padding:10px;border-radius:9px;margin-bottom:3px">{content}</div></div></div></div></div></div><div style="color:#8c8c8c;font-size:10px;width:100%;text-align:center;word-wrap:break-word;margin-top:-30px"><p style="padding:20px">愿世界安康，愿你我皆好！</p></div><div style="text-align:center"><a style="text-decoration:none;color:#fff;background-color:#94a9b9;padding:5px 20px;border-radius:4px;position:absolute;margin-left:-35px;margin-top:10px" href="{permalink}" target="_blank">查看</a></div></div><div style="height:345px;background-repeat:no-repeat;border-radius:5px 5px 0 0;background-image:url(https://cdn.jsdelivr.net/gh/iRoZhi/irils-imgs/picgo/commttomailbg.png);background-size:cover;background-position:50% 50%;max-width:100%"></div><div style="color:#8c8c8c;font-size:10px;width:100%;text-align:center;margin-top:30px"><p>本邮件为系统自动发送，请勿直接回复~</p></div><div style="color:#8c8c8c;font-size:10px;width:100%;text-align:center"><p>©2021 Copyright 若志-随笔</p></div></div>', 
_t('自定义邮件通知模板-用户收'), 
_t('
介绍：用于普通用户收发邮件时显示的邮件通知模板，支持html <br>
相关调用代码介绍： <br>
{title}：文章标题 <br>
{author}：回复者昵称 <br>
{parentAuthor}：你的评论昵称 <br>
{ip}：回复者ip <br>
{mail}：回复者mail <br>
{parentMail}：你的评论mail <br>
{time}：评论时间 <br>
{permalink}：评论链接地址 <br>
{content}：回复者评论内容 <br>
{parentContent}：你的评论内容 <br>
{imgUrl}：回复者头像链接 <br>
{parentImgUrl}：你的头像链接 <br>
    '));
$CommentsToMailParentHtml->setAttribute('class', 'options-content options-CommentPush');
$form->addInput($CommentsToMailParentHtml);


/* 其它设置 orther*/
$time_code = new Typecho_Widget_Helper_Form_Element_Text('time_code', NULL, 'default', '说说身份验证编码', '用于微信公众号发送说说验证个人身份的编码，请勿告诉任何人。如果编码泄露，别人可以通过该编码在微信公众号向的博客添加说说。你可以随时更新此编码，以便不被别人使用。');
$time_code->setAttribute('class', 'options-content options-orther');
$form->addInput($time_code);

$SrcCdn = new Typecho_Widget_Helper_Form_Element_Select('SrcCdn', array('1' => '本地储存','3' => '自定义CDN储存'), '1', '样式资源储存选择', '本主题支持您选择合适的储存方式来储存js、css等文件进而达到网站加速的效果');
$SrcCdn->setAttribute('class', 'options-content options-orther');
$form->addInput($SrcCdn->multiMode());

$SrcCdn_Custom = new Typecho_Widget_Helper_Form_Element_Text('SrcCdn_Custom',null,'', '自定义储存源地址', '<span style="color:red">【填写该项时请先在上一个设置项选择：自定义cdn储存】</span>请填入风格文件储存源地址,例子:https://xxxx.com/，或者https://xxxx.com/xxx/，请务必将整个Src目录都放进去!!!<br>当你填写的是https://xxxx.com/时，风格存储地址应该是https://xxxx.com/src<br>');
$SrcCdn_Custom->setAttribute('class', 'options-content options-orther');
$form->addInput($SrcCdn_Custom);   

$aidao = new Typecho_Widget_Helper_Form_Element_Checkbox('aidao', array('aidao' => '开启后，网站将变为灰色'), null, '哀悼模式');
$aidao->setAttribute('class', 'options-content options-orther'); 
$form->addInput($aidao->multiMode());

$imgAlt = new Typecho_Widget_Helper_Form_Element_Checkbox('imgAlt', 
array('imgAlt' => _t('显示')),
array('imgAlt'), _t('是否显示Alt在图片左下角'),_t('是否显示Alt在图片左下角'));
$imgAlt->setAttribute('class', 'options-content options-orther');
$form->addInput($imgAlt->multiMode());


$theAllViews = new Typecho_Widget_Helper_Form_Element_Checkbox('theAllViews', 
array('theAllViews' => _t('显示')),
    _t('是否显示总访问量'),_t('是否显示总访问量'));
$theAllViews->setAttribute('class', 'options-content options-orther');
$form->addInput($theAllViews->multiMode());

$index_comments_list = new Typecho_Widget_Helper_Form_Element_Checkbox('index_comments_list', 
array('index_comments_list' => _t('显示')),
array('index_comments_list'), _t('是否显示首页评论列表'),_t('是否显示首页动态以及文章下面的评论列表'));
$index_comments_list->setAttribute('class', 'options-content options-orther');
$form->addInput($index_comments_list->multiMode());


$page_next_style = new Typecho_Widget_Helper_Form_Element_Radio('page_next_style',array('默认分页' => '默认分页','Ajax翻页' => 'Ajax翻页'),'Ajax翻页',_t('分页样式<br>'),_t('请选择分页样式'));
$page_next_style->setAttribute('class', 'options-content options-orther');
$form->addInput($page_next_style);


}



<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
class Contents{
    public static $frag = false;
    public static function parseContent($data, $widget, $last)
    {
        $text = empty($last) ? $data : $last;
        if ($widget instanceof Widget_Archive) {
            $text = self::parseBiaoQing($text);
            $text = self::parseimages($text);
            $text = self::parsePhoto($text);
            $text = self::parseimgurl($text);
            $text = self::parseTextColor($text);
            $text = self::parseMessagesEnd($text);
            $text = self::cidToContent($text);
        }
        
        return $text;
    }

    public static function excerptEx($data, $widget, $last)
    {
        $text = empty($last) ? $data : $last;
        if ($widget instanceof Widget_Archive) {
            $text = preg_replace("/{(.*?)}/", "${1}", $text);
        }
        
        return $text;
    }


    /* 短代码解析 */

    /**
     * 解析表情
     * 
     * @return string
     */
    public static function parseBiaoQing($content)
    {   $emo = false;
        global $emo;
        if(!$emo){
            $emo = json_decode(file_get_contents(dirname(dirname(__FILE__)).'/src/owo/OwO.json'), true);
        }
        /* $options = Helper::options();
        $url = $options->siteUrl; */
        foreach ($emo as $v){
            if($v['type'] == 'image'){
                foreach ($v['container'] as $vv){
                    $content = str_replace($vv['data'], '<img class="biaoqing no-fabcybox" width="35px" height="35px" src='.$vv['icon'] .' alt="'.$vv['text'] .'">', $content);
                }
            }
        }

        $reg='/\!\[(.*?)\]\((.*?)\)/';
        $rp='';
        $content=preg_replace($reg,$rp,$content);

        $options = Typecho_Widget::widget('Widget_Options');
        if(!empty($options->src_add) && !empty($options->cdn_add)){
            $content = str_ireplace($options->src_add,$options->cdn_add,$content);
        }
        $content = preg_replace("/<a href=\"([^\"]*)\">/i", "<a href=\"\\1\" target=\"_blank\">", $content);

        return $content;
        
    }

    /**
     * 图集
     * @param $text
     * @return string|string[]|null
     */
    public static function parseimages($text)
    {
        $reg='/\[images\](.*?)\[\/images\]/ism';
        $rp='<div class="img_images">${1}</div>';
        $text=preg_replace($reg,$rp,$text);
        return $text;
    }
    /**
     * 相册
     * @param $text
     * @return string|string[]|null
     */
    public static function parsePhoto($text)
    {
        $reg='/\[photos\](.*?)\[\/photos\]/ism';
        $rp='<div class="masonry-grid">${1}</div>';
        $text=preg_replace($reg,$rp,$text);
        
        return $text;
    }
    /**
     * 图片超链接
     * 
     * @param $text
     * @return string|string[]|null
     */
    public static function parseimgurl($text)
    {
        return preg_replace('/\[imgurl url="(.*?)" src="(.*?)" alt="(.*?)"\]/sm', '<a href="$1" target="_blank" class="no-fabcybox masonry-item"> <img src="${2}" alt="${3}"> <span class="masonry-alt">${3}</span></a>', $text);
    }
    /**
     * 多彩字体
     * 
     * @param $text
     * @return string|string[]|null
     */
    public static function parseTextColor($text)
    {
        return preg_replace('/\[textColor color="(.*?)"\](.*?)\[\/textColor\]/s', '<span style="color:${1}">${2}</span>', $text);
    }

    /**
     * 消息对话
     * 
     * @param $text
     * @return string|string[]|null
     */
    public static function parseMessagesEnd($text)
    {
        $text = preg_replace_callback('/\[Messages\]\<?[br]*\>(.*?)\[\/Messages\]/ism', function ($text) {
            return '<div class="Messages_box" style="padding: 0 1rem;">
                    ' . $text[1] . '
                    </div>';
        }, $text);
        $text = preg_replace_callback('/\[Messages-item by="(.*?)" avatar="(.*?)"\]\<?[br]*\>(.*?)\<?[br]*\>\[\/Messages-item\]\<?[br]*\>/ism', function ($text) {
            return '<div class="post_box-comments-single Messages-' . $text[1] . '">
                        <div class="post_box-comment-avatar">
                            <img src="' . $text[2] . '">
                        </div>
                        <div class="post_box-comment-text">
                            <div class="post_box-comment-text-inner">
                            ' . $text[3] . '
                            </div>
                        </div>
                    </div>';
        }, $text);
        return $text;
    }

    /**
     * 文章卡片
     */
    public static function cidToContent($text)
    {
        $reg = '/\[cid="(.+?)"]/';
        if (preg_match_all($reg, $text, $matches)) {
            $db = Typecho_Db::get();
            foreach ($matches[1] as $match) {
                $result = $db->fetchAll($db->select()->from('table.fields')
                    ->where('cid = ?',$match)
                );
                $articleArr = $db->fetchAll($db->select()->from('table.contents')
                    ->where('status = ?','publish')
                    ->where('type = ?', 'post')
                    ->where('cid = ?',$match)
                );
                if (count($articleArr) == 0){
                    $text =  preg_replace($reg, '<br>文章cid不存在<br>', $text, 1);
                    return $text;
                }
                $val = Typecho_Widget::widget('Widget_Abstract_Contents')->push($articleArr[0]);

                $tamde = ''.$val['text'].'';
                $targetSummary = Utils::excerpt(Markdown::convert($val['text']), 60);
                $replacement = '
                                <a target="_blank" href="'.$val['permalink'].'" class="LinkCard">
                                    <span class="LinkCard-content">
                                        <span class="LinkCard-text">
                                            <span class="LinkCard-title">'.$val['title'].'</span>
                                            <span class="LinkCard-excerpt text-ell">'.$targetSummary.'</span>
                                            <span class="LinkCard-meta">
                                                <span style="display:inline-flex;">​
                                                <svg fill="currentColor" viewBox="0 0 24 24" width="17" height="17"><path d="M6.77 17.23c-.905-.904-.94-2.333-.08-3.193l3.059-3.06-1.192-1.19-3.059 3.058c-1.489 1.489-1.427 3.954.138 5.519s4.03 1.627 5.519.138l3.059-3.059-1.192-1.192-3.059 3.06c-.86.86-2.289.824-3.193-.08zm3.016-8.673l1.192 1.192 3.059-3.06c.86-.86 2.289-.824 3.193.08.905.905.94 2.334.08 3.194l-3.059 3.06 1.192 1.19 3.059-3.058c1.489-1.489 1.427-3.954-.138-5.519s-4.03-1.627-5.519-.138L9.786 8.557zm-1.023 6.68c.33.33.863.343 1.177.029l5.34-5.34c.314-.314.3-.846-.03-1.176-.33-.33-.862-.344-1.176-.03l-5.34 5.34c-.314.314-.3.846.03 1.177z" fill-rule="evenodd"></path></svg>
                                                </span>
                                                <span>'.$val['permalink'].'</span>
                                            </span>
                                        </span>
                                        <span class="LinkCard-imageCell">
                                        <span class="LinkCard-image LinkCard-image-default">
                                            <svg fill="currentColor" viewBox="0 0 24 24" width="32" height="32"><path d="M11.991 3C7.023 3 3 7.032 3 12s4.023 9 8.991 9C16.968 21 21 16.968 21 12s-4.032-9-9.009-9zm6.237 5.4h-2.655a14.084 14.084 0 0 0-1.242-3.204A7.227 7.227 0 0 1 18.228 8.4zM12 4.836A12.678 12.678 0 0 1 13.719 8.4h-3.438A12.678 12.678 0 0 1 12 4.836zM5.034 13.8A7.418 7.418 0 0 1 4.8 12c0-.621.09-1.224.234-1.8h3.042A14.864 14.864 0 0 0 7.95 12c0 .612.054 1.206.126 1.8H5.034zm.738 1.8h2.655a14.084 14.084 0 0 0 1.242 3.204A7.188 7.188 0 0 1 5.772 15.6zm2.655-7.2H5.772a7.188 7.188 0 0 1 3.897-3.204c-.54.999-.954 2.079-1.242 3.204zM12 19.164a12.678 12.678 0 0 1-1.719-3.564h3.438A12.678 12.678 0 0 1 12 19.164zm2.106-5.364H9.894A13.242 13.242 0 0 1 9.75 12c0-.612.063-1.215.144-1.8h4.212c.081.585.144 1.188.144 1.8 0 .612-.063 1.206-.144 1.8zm.225 5.004c.54-.999.954-2.079 1.242-3.204h2.655a7.227 7.227 0 0 1-3.897 3.204zm1.593-5.004c.072-.594.126-1.188.126-1.8 0-.612-.054-1.206-.126-1.8h3.042c.144.576.234 1.179.234 1.8s-.09 1.224-.234 1.8h-3.042z"></path></svg>
                                        </span>
                                        </span>
                                    </span>
                                </a>
                            ';
                $text =  preg_replace($reg, $replacement, $text, 1);
            }
        }
        return $text;
    }



    /* 获取文章缩略图 */
    public static function getThumbnails($item)
    {
        $result = [];
        $pattern = '/\<img.*?src\=\"(.*?)\"[^>]*>/i';
        $patternMD = '/\!\[.*?\]\((http(s)?:\/\/.*?(jpg|jpeg|gif|png|webp))/i';
        $patternMDfoot = '/\[.*?\]:\s*(http(s)?:\/\/.*?(jpg|jpeg|gif|png|webp))/i';
        /* 如果填写了自定义缩略图，则优先显示填写的缩略图 */
        if ($item->fields->thumb) {
            $fields_thumb_arr = explode("\r\n", $item->fields->thumb);
            foreach ($fields_thumb_arr as $list) $result[] = $list;
        }
            /* 如果匹配到正则，则继续补充匹配到的图片 */
            if (preg_match_all($pattern, $item->content, $thumbUrl)) {
                foreach ($thumbUrl[1] as $list) $result[] = $list;
            }
            if (preg_match_all($patternMD, $item->content, $thumbUrl)) {
                foreach ($thumbUrl[1] as $list) $result[] = $list;
            }
            if (preg_match_all($patternMDfoot, $item->content, $thumbUrl)) {
                foreach ($thumbUrl[1] as $list) $result[] = $list;
            }

        /* 如果上面的数量不足3个，则直接补充3个随即图进去 */
        if (sizeof($result) < 3) {
            $custom_thumbnail = Helper::options()->Thumbnail;
            $options = Helper::options();
            if($options->SrcCdn == '1' || $options->SrcCdn == null){
                $url = '/usr/themes/A-My/';
            }
            else if($options->SrcCdn == '2'){
                $url = '/usr/themes/A-My/';
            }
            else{
                $url = $options->SrcCdn_Custom;
            }
            /* 将for循环放里面，减少一次if判断 */
            if ($custom_thumbnail) {
                $custom_thumbnail_arr = explode("\r\n", $custom_thumbnail);
                for ($i = 0; $i < 3; $i++) {
                    $result[] = $custom_thumbnail_arr[array_rand($custom_thumbnail_arr, 1)] . "?key=" . mt_rand(0, 1000000);
                }
            } else {
                for ($i = 0; $i < 3; $i++) {
                    $result[] = ''.$url.'src/img/sj/' . rand(1, 10) . '.jpg';
                }
            }
        }
        return $result;
    }


    /**
     * 文章中文字数统计
     * @param $cid
     */
    public static function artCount($cid)
    {
        $db = Typecho_Db::get();
        $rs = $db->fetchRow($db->select('table.contents.text')->from('table.contents')->where('table.contents.cid=?', $cid)->order('table.contents.cid', Typecho_Db::SORT_ASC)->limit(1));
        $text = preg_replace("/[^\x{4e00}-\x{9fa5}]/u", "", $rs['text']);
        echo mb_strlen($text, 'UTF-8');
    }

    /**
    * 文章中图片统计
    * @param $content
    */
    public static function imgNum($content){
        $output = preg_match_all('#<img(.*?) src="([^"]*/)?(([^"/]*)\.[^"]*)"(.*?)>#', $content,$s);
        $cnt = count( $s[1] );
        return $cnt;
    }

    /**
     * 文章阅读次数统计
     * @param $archive
     */
    public static function getPostView($archive)
    {
        $cid = $archive->cid;
        $db = Typecho_Db::get();
        $prefix = $db->getPrefix();
        if (!array_key_exists('views', $db->fetchRow($db->select()->from('table.contents')))) {
            $db->query('ALTER TABLE `' . $prefix . 'contents` ADD `views` INT(10) DEFAULT 0;');
            echo 0;
            return;
        }
        $row = $db->fetchRow($db->select('views')->from('table.contents')->where('cid = ?', $cid));
        if ($archive->is('single')) {
            $views = Typecho_Cookie::get('extend_contents_views');
            if (empty($views)) {
                $views = array();
            } else {
                $views = explode(',', $views);
            }
            if (!in_array($cid, $views)) {
                $db->query($db->update('table.contents')->rows(array('views' => (int)$row['views'] + 1))->where('cid = ?', $cid));
                array_push($views, $cid);
                $views = implode(',', $views);
                Typecho_Cookie::set('extend_contents_views', $views); //记录查看cookie
            }
        }
        echo $row['views'];
    }

    /**
     * 首页输出文章九宫格图片
     * 
     */  
    public static function imgNumCCC($content){
        $output = preg_match_all('#<img(.*?) src="([^"]*/)?(([^"/]*)\.[^"]*)"(.*?)>#', $content,$s);
        $cnt = count( $s[1] );
        if(intval($cnt)==1){ //当图片等于1张时
            for ($i=0; $i < 1; $i++) { 
                $c .= '
                <dl class="img_gallery-item">
                <dt  data-src="'.$s[2][$i].$s[3][$i].'" class="img_gallery-item-dt" >
                <img data-src="'.$s[2][$i].$s[3][$i].'" class="lazy ViewImage" src="'.$s[2][$i].$s[3][$i].'" title="点击放大图片">
                </dt>
                <dd></dd>
                </dl>';
            }
            $c = '<div id="img_gallery-1" class="img_gallery">'.$c.'</div>'; //输出
        }elseif(intval($cnt)==2){//当图片等于2张时
            for ($i=0; $i < 2; $i++) { 
                $c .= '
                <dl class="img_gallery-item">
                <dt  data-src="'.$s[2][$i].$s[3][$i].'" class="img_gallery-item-dt" >
                <img data-src="'.$s[2][$i].$s[3][$i].'" class="lazy ViewImage" src="'.$s[2][$i].$s[3][$i].'" title="点击放大图片">
                </dt>
                <dd></dd>
                </dl>';
            }
            $c = '<div id="img_gallery-2" class="img_gallery">'.$c.'</div>'; //输出
        }elseif(intval($cnt)==3){//当图片等于3张时
            for ($i=0; $i < 3; $i++) { 
                $c .= '
                <dl class="img_gallery-item">
                <dt  data-src="'.$s[2][$i].$s[3][$i].'" class="img_gallery-item-dt" >
                <img data-src="'.$s[2][$i].$s[3][$i].'" class="lazy ViewImage" src="'.$s[2][$i].$s[3][$i].'" title="点击放大图片">
                </dt>
                <dd></dd>
                </dl>';
            }
            $c = '<div id="img_gallery-3" class="img_gallery">'.$c.'</div>'; //输出
        }elseif(intval($cnt)==4){//当图片等于4张时
            for ($i=0; $i < 4; $i++) { 
                $c .= '
                <dl class="img_gallery-item">
                <dt  data-src="'.$s[2][$i].$s[3][$i].'" class="img_gallery-item-dt" >
                <img data-src="'.$s[2][$i].$s[3][$i].'" class="lazy ViewImage" src="'.$s[2][$i].$s[3][$i].'" title="点击放大图片">
                </dt>
                <dd></dd>
                </dl>';
            }
            $c = '<div id="img_gallery-2" class="img_gallery">'.$c.'</div>'; //输出
        }elseif(intval($cnt)==5){//当图片等于5张时
            for ($i=1; $i < 5; $i++) { 
                if($i==4){ //判断是否最后一张,如果为最后一张,则进行计算/增加className
                    $n = 'img_gallery-item-dt num" remnant="'.(intval($cnt)-$i).'"'; //最后一张时的className
                }else{
                    $n = 'img_gallery-item-dt"'; //正常的className
                }
                $c .= '
                <dl class="img_gallery-item">
                <dt  data-src="'.$s[2][$i].$s[3][$i].'" class="'.$n.' >
                <img data-src="'.$s[2][$i].$s[3][$i].'" class="lazy ViewImage" src="'.$s[2][$i].$s[3][$i].'" title="点击放大图片">
                </dt>
                <dd></dd>
                </dl>';
            }
            $c = '<div id="img_gallery-2" class="img_gallery">'.$c.'</div>'; //输出
        }elseif(intval($cnt)==6){//当图片等于6张时
            for ($i=0; $i < 6; $i++) { 
                $c .= '
                <dl class="img_gallery-item">
                <dt  data-src="'.$s[2][$i].$s[3][$i].'" class="img_gallery-item-dt" >
                <img data-src="'.$s[2][$i].$s[3][$i].'" class="lazy ViewImage" src="'.$s[2][$i].$s[3][$i].'" title="点击放大图片">
                </dt>
                <dd></dd>
                </dl>';
            }
            $c = '<div id="img_gallery-3" class="img_gallery">'.$c.'</div>'; //输出
        }elseif(intval($cnt)>=7){//当图片大于或等于7张时
            for ($i=1; $i < 7; $i++) { 
                if($i==6){ //判断是否最后一张,如果为最后一张,则进行计算/增加className
                    $n = 'img_gallery-item-dt num" remnant="'.(intval($cnt)-$i).'"'; //最后一张时的className
                }else{
                    $n = 'img_gallery-item-dt"'; //正常的className
                }
                $c .= '
                <dl class="img_gallery-item">
                <dt  data-src="'.$s[2][$i].$s[3][$i].'" class="'.$n.' >
                <img data-src="'.$s[2][$i].$s[3][$i].'" class="lazy ViewImage" src="'.$s[2][$i].$s[3][$i].'" title="点击放大图片">
                </dt>
                <dd></dd>
                </dl>';
            }
            $c = '<div id="img_gallery-3" class="img_gallery">'.$c.'</div>'; //输出
        }
        echo $c;
    }

    //  获取 ECharts 格式要求的文章更新日历
    public static function postCalendar($start, $end) {
        $db = Typecho_Db::get();
        $dateList = $db->fetchAll($db->select('created')->from('table.contents')->where('created > ?', $start)->where('created < ?', $end));
        if (count($dateList) < 1) {
            return array();
        }
        $dateList2 = array();
        foreach ($dateList as $val) {
            array_push($dateList2, date('Y-m-d', $val['created']));
        }
        $dateList2 = array_count_values($dateList2);
        $key = array_keys($dateList2);
        $dateList = array();

        for ($i = 0;$i < count($dateList2);$i ++) {
            array_push($dateList, array(
                $key[$i],
                $dateList2[$key[$i]]
            ));
        }

        return $dateList;
    }
    //  获取 ECharts 格式要求的评论更新日历
    public static function commentCalendar($start, $end) {
        $db = Typecho_Db::get();
        $dateList = $db->fetchAll($db->select('created')->from('table.comments')->where('created > ?', $start)->where('created < ?', $end));
        if (count($dateList) < 1) {
            return array();
        }
        $dateList2 = array();
        foreach ($dateList as $val) {
            array_push($dateList2, date('Y-m-d', $val['created']));
        }
        $dateList2 = array_count_values($dateList2);
        $key = array_keys($dateList2);
        $dateList = array();

        for ($i = 0;$i < count($dateList2);$i ++) {
            array_push($dateList, array(
                $key[$i],
                $dateList2[$key[$i]]
            ));
        }

        return $dateList;
    }

        /**
     * 随机文章
     * @param int $limit
     */
    public static function random_posts()
    {
    	$db = Typecho_Db::get();
    	$result = $db->fetchAll($db->select()->from('table.contents')
    			->where('status = ?','publish')
    			->where('type = ?', 'post')
    			->where('created <= unix_timestamp(now())', 'post')
    			->limit(5)
    			->order('RAND()')
    	);

    	if($result){
    		$i=1;
    		foreach($result as $val){
    			if($i<=3){
    				$var = ' class="red"';
    			}else{
    				$var = '';
    			}
                $options = Helper::options(); 
    			$val = Typecho_Widget::widget('Widget_Abstract_Contents')->push($val);?>
                 <div class="flex items-center pt-3 mt-3 border-t border-color text-sm">
                    <?php if (!empty($options->sjwz_img) && in_array('sjwz_img', $options->sjwz_img)): ?>
                     <div class="h-12 w-20 rounded mr-3 flex-1">
                        <img class="h-full w-full object-cover rounded" src="<?php echo Contents::getThumbnails($val)[0] ?>" alt="<?php echo $val['title']; ?>">
                     </div>
                    <?php endif; ?>
                    <span class="grid flex-4 sm:flex-5 md:flex-2">
                        <a href="<?php echo $val['permalink']; ?>" class="mb-2 ell"><?php echo $val['title']; ?></a>
                        <small><?php echo $val['views']; ?> 浏览 - <?php echo date('Y/m/d', $val['created']); ?></small>
                    </span>
                </div>
    		<?php
    			$i++;
    		}
    	}
    }

    public static function createCatalog($obj) {    //为文章标题添加锚点
        global $catalog;
        global $catalog_count;
        $catalog = array();
        $catalog_count = 0;
        $obj = preg_replace_callback('/<h([1-6])(.*?)>(.*?)<\/h\1>/i', function($obj) {
            global $catalog;
            global $catalog_count;
            $catalog_count ++;
            $catalog[] = array('text' => trim(strip_tags($obj[3])), 'depth' => $obj[1], 'count' => $catalog_count);
            return '<h'.$obj[1].$obj[2].'><a id="cl-'.$catalog_count.'"></a>'.$obj[3].'</h'.$obj[1].'>';
        }, $obj);
        return $obj;
      }
      
    public static function getCatalog() {    //输出文章目录容器
        global $catalog;
        $index = '';
        if ($catalog) {
            $index = '<ul class="toc-list">'."\n";
            $prev_depth = '';
            $to_depth = 0;
            foreach($catalog as $catalog_item) {
                $catalog_depth = $catalog_item['depth'];
                if ($prev_depth) {
                    if ($catalog_depth == $prev_depth) {
                        $index .= '</li>'."\n";
                    } elseif ($catalog_depth > $prev_depth) {
                        $to_depth++;
                        $index .= '<ul>'."\n";
                    } else {
                        $to_depth2 = ($to_depth > ($prev_depth - $catalog_depth)) ? ($prev_depth - $catalog_depth) : $to_depth;
                        if ($to_depth2) {
                            for ($i=0; $i<$to_depth2; $i++) {
                                $index .= '</li>'."\n".'</ul>'."\n";
                                $to_depth--;
                            }
                        }
                        $index .= '</li>';
                    }
                }
                $index .= '<li class="toc-list-item"><a href="#cl-'.$catalog_item['count'].'" class="toc-link">'.$catalog_item['text'].'</a>';
                $prev_depth = $catalog_item['depth'];
            }
            for ($i=0; $i<=$to_depth; $i++) {
                $index .= '</li>'."\n".'</ul>'."\n";
            }
        $index = "\n".$index;
        }
        echo $index;
    }

}

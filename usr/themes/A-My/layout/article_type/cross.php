<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<div class="news-item box sm:box mb-3 pt-3">
    <div class="post_entry-info flex mx-3">
        <div class="post_entry-left-info flex items-center flex-1">
            <div class="author-avatar flex">
                <iconpark-icon name="comment" class="iconpark avatar rounded-md mr-3 p-1 shadow" size="2rem"></iconpark-icon>
            </div>
            <div style="display: flex;flex-direction: column;">
                <a href="<?php $this->permalink() ?>" class="author-title font-bold ell" aria-label="<?php $this->title() ?>"><?php $this->sticky(); $this->title() ?></a>
                <span style="font-size: 12px; font-weight: 400; color: #74858F;"><?php echo Utils::formatTime($this->created); ?></span>
            </div>
        </div>
        <div class="post_entry-right-info" style="overflow: hidden;">
            <span class="post_entry-category post_category-link" style="margin: 0 4px; white-space: nowrap;">
                <?php $this->category(' '); ?>
            </span>
        </div>
    </div>
    <div class="post_entry-content m-3" style="letter-spacing:1px;">
        <?php
            preg_match_all('/<p>.*?<\/p>/im', $this->content, $m);
            if (count($m[0]) > 0) {
                if (strlen($m[0][0]) < 150) {
                    $result = $m[0][0] . $m[0][1] . $m[0][2];
                } else {
                    $result = $m[0][0];
                }
                $result = preg_replace("/<[img|IMG].*?src=[\'|\"](.*?)[\'|\"].*?[\/]?>/", "", $result);
                $result = preg_replace("/<?[br][^>]*><div class=\"ax_images\">(.*?)<\/div>/im", "", $result);
                $result = preg_replace("/<?[br][^>]*><div class=\"masonry-grid\">(.*?)<\/div>/im", "", $result);
                $result = preg_replace("/{(.*?)}/", "${1}", $result);
                echo $result;
            } else {
                $this->excerpt(200, '...');
            }
        ?>

        <?php if($this->fields->wymusic) { ?>
            <iframe title="wymusic" src="//music.163.com/outchain/player?type=2&id=<?php echo ''.$this->fields->wymusic.'' ?>&auto=0&height=66" frameborder="no" border="0" marginwidth="0" marginheight="0" width="330" height="86"></iframe>
        <?php }?>
        <?php if($this->fields->video) { ?>
            <iframe title="video" src="<?php 
            $player = Helper::options()->CustomPlayer ? Helper::options()->CustomPlayer : Helper::options()->themeUrl . '/libs/player.php?url=' . $this->fields->video . ''; 
            echo ''.$player.'' ?>
            " 
            class="video py-3" scrolling="no" border="0" frameborder="no" framespacing="0" allowfullscreen="true"> </iframe>
        <?php }?>

        <a href="<?php $this->permalink() ?>" style="line-height:1.7; " aria-label="read more">阅读更多...</a>

        <?php if($this->fields->video == NULL) { ?>
            <?php if($this->fields->Cross_imgNumCCC == true) { ?>
                <?php echo ''.Contents::imgNumCCC($this->content).'' ; ?>
            <?php }?>
        <?php }?>
    </div>
    <div class="post_box-state">
        <?php $suport = get_post_support($this->cid) ?>
        <div class="post_box-state-btns post-suport" data-cid="<?php echo $this->cid ?>">
            <iconpark-icon class="iconpark" name="<?php echo $suport['icon'] ?>"></iconpark-icon> <span><?php echo ' '.$suport['count'] .' '. $suport['text'] ?></span>
        </div>
        <a href="<?php $this->permalink() ?>#comments" class="post_box-state-btns" aria-label="comments">
            <iconpark-icon class="iconpark" name="comments"></iconpark-icon><span><?php $this->commentsNum('0 评论', '1 评论', '%d 评论'); ?></span>
        </a>
        <div class="post_box-state-btns">
            <iconpark-icon class="iconpark" name="eyes"></iconpark-icon><span> <?php Contents::getPostView($this); ?> 浏览</span>
        </div>
    </div>
    <?php if (!empty($this->options->index_comments_list) && in_array('index_comments_list', $this->options->index_comments_list)): ?>
        <div class="post_box-comments m-3">
            <?php foreach (Comments::get_post_comment($this) as $item): ?>
                <div class="post_box-comments-single">
                    <div class="post_box-comment-avatar tips--top" aria-label="<?= $item['author'] ?>">
                        <img src="<?= utils::ParseAvatar($item['mail']) ?>" alt="<?= $item['author'] ?>" title="<?= $item['author'] ?>" />
                    </div>
                    <div class="post_box-comment-text">
                        <div class="post_box-comment-text-inner">
                            <a href="<?php $this->permalink() ?>#comments" class="ell" aria-label="comments">
                                <?= $result = preg_replace("/\[secret\](.*?)\[\/secret\]/sm", "<div class=\"secret\">此条为悄悄话，首页不可见</div>", Contents::parseBiaoQing($item['text'])); ?> 
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
    
</div>



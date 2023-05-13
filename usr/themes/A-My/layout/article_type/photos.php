<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<div class="news-item box sm:box mb-3 pt-3">
    <div class="post_entry-info flex mx-3">
        <div class="post_entry-left-info flex items-center flex-1">
            <div class="author-avatar flex">
                <iconpark-icon name="pic" class="iconpark avatar rounded-md mr-3 p-1 shadow" size="2rem"></iconpark-icon>
            </div>
            <div style="display: flex;flex-direction: column;">
                <strong class="author-title ell"><a href="<?php $this->permalink() ?>" target="_self" aria-label="Read more">上传了一个相册《<?php $this->title() ?>》</a></strong>
                <span style="font-size: 12px; font-weight: 400; color: #74858F;"><?php echo Utils::formatTime($this->created); ?></span>
            </div>
        </div>
        <div class="post_entry-right-info" style="overflow: hidden;">
            <span class="post_entry-category post_category-link" style="margin: 0 4px; white-space: nowrap;">
                <?php $this->category(''); ?>
            </span>
        </div>
    </div>
    <div class="post_entry-content mx-3" style="letter-spacing:1px;">
        <?php echo ''.Contents::imgNumCCC($this->content).'' ; ?>
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
</div>
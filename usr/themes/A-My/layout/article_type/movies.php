<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<div class="news-item box sm:box mb-3 pt-3">
    <div class="post_entry-info flex mx-3">
        <div class="post_entry-left-info flex items-center flex-1">
            <div class="author-avatar flex">
                <iconpark-icon name="movie" class="iconpark avatar rounded-md mr-3 p-1 shadow" size="2rem"></iconpark-icon>
            </div>
            <div style="display: flex;flex-direction: column;">
                <strong class="author-title">看了一部影片</strong>
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
        <div class="movies-content my-5">
            <div class="info flex">
                <a href="<?php $this->permalink() ?>" class="movies-img overflow-auto rounded-md">
                    <img class="lazy" data-src="<?php echo Contents::getThumbnails($this)[0] ?>"
                        src="<?php echo Contents::getThumbnails($this)[0] ?>"
                        alt="<?php $this->title() ?>">
                </a>
                <div class="flex-1 ml-5 grid items-center">
                    <a href="<?php $this->permalink() ?>">
                        <h3>《<?php $this->title() ?>》</h3>
                    </a>
                    <div class="ml-3 grid">
                        <p>导演: <?php $this->fields->movies_author(); ?></p>
                        <p>上映时间: <?php $this->fields->movies_time(); ?></p>
                        <p class="ell">"<?php $this->fields->movies_excerpt(); ?>"</p>
                    </div>

                </div>
            </div>
        </div>
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
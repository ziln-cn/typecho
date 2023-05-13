<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this->need('layout/header.php'); ?>
<div class="container flex flex-wrap flex-1 px-0 sm:px-2 mx-auto mt-3 md:flex-no-wrap">
  <main class="flex-1 w-full" style="width: 0;">
    <div class="box sm:box mb-3 p-3">
      <div class="post_thumbnail-custom flex mb-3 h-32 sm:h-48 relative rounded-md overflow-auto">
        <img class="lazy w-full h-full rounded-md absolute object-cover object-center" 
            data-src="<?php echo Contents::getThumbnails($this)[0] ?>" 
            src="<?php echo Contents::getThumbnails($this)[0] ?>" 
            alt="<?php $this->title() ?>">
        
        <span class="article-headline-p w-full flex items-center justify-center text-white font-bold text-2xl tracking-wider m-auto flex-col z-10">
          <?php $this->title() ?>
          <font class="archiveTitle text-sm">- Pages -</font>
        </span>
      </div>

      <section class="joe_detail__article py-3">
        <?php _parseContent($this, $this->user->hasLogin()) ?>
      </section>

      <span class="flex pb-3 post-tags">
        <?php $this->tags(' ', true, ''); ?>
      </span>
      <div class="flex items-center justify-between pt-3 border-t border-color">
        <div class="inline-flex items-center">
            <?php $suport = get_post_support($this->cid) ?>
            <a href="javascript:void(0);" class="favorite mr-4 tips--top inline-flex items-center post-suport" params="unfavorite vote_topic 1"
                aria-label="点赞" data-cid="<?php echo $this->cid ?>">
                <iconpark-icon class="iconpark mr-1" name="<?php echo $suport['icon'] ?>" size="19px"></iconpark-icon> <span class="ml-1"><?php echo ' '.$suport['count'] ?></span>
            </a>
            <a href="javascript:void(<?php Contents::getPostView($this); ?>);" class="thank mr-4 tips--top inline-flex items-center" id="thank topic 1" aria-label="浏览数">
              <div class="inline-flex items-center">
                <span class="mr-1 inline-flex items-center">
                  <iconpark-icon class="iconpark" name="eyes" size="18px"></iconpark-icon>
                </span>
                <span class="stars_count mr-1"><?php Contents::getPostView($this); ?></span>
              </div>
            </a>
        </div>
        
        <div class="inline-flex items-center">
            <span class="mr-3 sub">分享:</span>
            <span class="mr-3 inline-flex items-center">
                <a href="https://api.qrserver.com/v1/create-qr-code/?size=200x200&margin=10&data=<?php $this->permalink() ?>" class="inline-flex items-center tips--top" aria-label="微信" onclick="window.open(this.href, 'wechat-share', 'width=730,height=500');return false;">
                  <iconpark-icon class="iconpark" name="friends-circle"></iconpark-icon>
                </a>
            </span>
            <span class="mr-3 inline-flex items-center">
                <a href="http://service.weibo.com/share/share.php?url=<?php $this->permalink(); ?>/&title=<?php $this->title() ?>" class="inline-flex items-center tips--top" aria-label="微博"  onclick="window.open(this.href, 'weibo-share', 'width=730,height=500');return false;">
                  <iconpark-icon class="iconpark" name="weibo"></iconpark-icon>
                </a>
            </span>
            <span>
                <a href="https://connect.qq.com/widget/shareqq/index.html?url=<?php $this->permalink(); ?>&sharesource=qq&title=<?php $this->title() ?>" class="inline-flex items-center tips--top" aria-label="QQ" onclick="window.open(this.href, 'qzone-share', 'width=730,height=500');return false;">
                  <iconpark-icon class="iconpark" name="tencent-qq"></iconpark-icon>
                </a>
            </span>
        </div>
      </div>
    </div>
    
    <?php $this->need('layout/article_comments/comments.php'); ?>
  </main>

  <?php $this->need('layout/sidebar.php'); ?>
</div>
<?php $this->need('layout/footer.php'); ?>


<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; 
 $GLOBALS['isLogin'] = $this->user->hasLogin();
 $GLOBALS['rememberEmail'] = $this->remember('mail',true);
 $GLOBALS['convertip'] = $this->options->convertip;
 Comments::commentReply($this);
?>
    <?php function threadedComments($comments, $options) {
        $commentClass = '';$group = '';
            if ($comments->authorId) {
                if ($comments->authorId == $comments->ownerId) {
                    $group = '<svg t="1655533356614" class="icon ml-1" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="1253" width="18" height="18"><path d="M907.8 467.1l-79.2-77.7v-98c-0.1-34.9 10.3-97.9-24.4-98H609L560.2 120c-24.6-24.6-68.8-30.7-93.4-6.1l-53 79.6H267.3c-34.8 0.1-74.9 27.5-75 62.4v128.3l-77.5 83c-24.5 24.7-24.5 64.7 0 89.4l77.5 84.1V769c0.1 34.9 15.8 61.3 50.6 61.4h146.4l77.4 79.4c24.6 24.6 64.5 24.6 89.1 0l77.5-79.4h122c34.8-0.1 73.1-38.6 73.2-73.5V634.4l79.2-77.8c24.6-24.8 24.6-64.7 0.1-89.5zM511.9 704.8L288.2 384.1H448l63.3 191 64.5-191h159.8L511.9 704.8z" p-id="1254" fill="#1296db"></path></svg>';
                        $commentClass .= 'By-authors';  //如果是文章作者的评论添加 .comment-by-author 样式
                    } else {
                        $group = '游客';
                        $commentClass .= 'By-user';  //如果是评论作者的添加 .comment-by-user 样式
                    }
                } 
        $commentLevelClass = $comments->_levels > 0 ? ' comment-child' : ' comment-parent';  //评论层数大于0为子级，否则是父级
        $depth = $comments->levels +1;
        if ($comments->url) {
            $author = '<a href="' . $comments->url . '"' . '" target="_blank"' . ' rel="external nofollow"  style="font-size: 16px;" class="flex items-center mr-1">' . $comments->author . '' . $group . '</a>';
        } else {
            $author = $comments->author;
        }
    ?>
        <li class="m-comments-list <?php 
            if ($comments->levels > 0) {
                echo 'comment-child';
                $comments->levelsAlt(' comment-level-odd', ' comment-level-even');
            } else {
                echo 'comment-parent';
            }
            $comments->alt(' comment-odd', ' comment-even');
            ?> depth-<?php echo $depth ?>" id="li-<?php $comments->theId(); ?>">
                <!--class  -->
                <div id="<?php $comments->theId(); ?>">
                    <div class="pt-3 border-t border-color" id="<?php echo $commentClass;?>">
                        <div class="flex">
                            <div class="mr-4">
                                <div class="relative preview">
                                    <?php $imgUrl = utils::ParseAvatar($comments->mail);echo '<img src="'.$imgUrl.'" aria-hidden="true" class="object-cover w-12 h-12 rounded">'; ?>
                                    <span class="absolute left-0 top-0 w-full h-full flex items-center justify-center">
                                        <a rel='nofollow' href="#回复给<?php $comments->author(false); ?>" class="comment-reply-link" id="createReply" onclick="createReply('<?php $comments->coid();?>','<?php $comments->author(false); ?>') " title="回复给<?php $comments->author(false); ?>">@</a>
                                    </span>
                                </div>
                            </div>
                            <div class="flex-1 action-list-parent">
                                <div class="flex flex-wrap items-center justify-between">
                                    <div class="inline-flex items-center">
                                        <span class="font-semibold inline-flex items-center"><?php echo $author ?><?php echo Comments::getPermalinkFromCoid($comments->parent);?></span>
                                        <span class="ml-2 meta flex">
                                            <svg viewBox="0 0 24 24" class="w-4 h-4 fill-current mr-1">
                                                <path fill="none" d="M0 0h24v24H0z"></path>
                                                <path
                                                    d="M12 22C6.477 22 2 17.523 2 12S6.477 2 12 2s10 4.477 10 10-4.477 10-10 10zm0-2a8 8 0 1 0 0-16 8 8 0 0 0 0 16zm1-8h4v2h-6V7h2v5z">
                                                </path>
                                            </svg><?php $comments->dateWord(); ?>
                                        </span>
                                    </div>
                                    <div class="inline-flex items-center metas">
                                        <span class="mr-2 meta"><?php echo Utils::getOs($comments->agent); ?> · <?php echo Utils::getBrowser($comments->agent); ?></span>
                                    </div>
                                </div>
                                <div class="mb-2 text-primary-700 whitespace">
                                    <?php 
                                        echo preg_replace('/\<img src="(.*?)"(.*?)">/i','
                                            <dl class="image-thumb">
                                                <dt  data-src="$1" class="img_thumb-item-dt" >
                                                    <img data-src="$1" class="cross-img lazy view-image" data-fancybox="gallery" src="$1"  title="点击放大图片">
                                                </dt>
                                            </dl>
                                        ', Comments::postCommentContent($comments->content,$GLOBALS['isLogin'],$GLOBALS['rememberEmail'],$comments->mail,$parentMail)); ?>
                                    <?php if ('waiting' == $comments->status) : ?>
                                    <p class="ml-1" style="color:orange;">您的评论正在等待审核……</p>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--class  -->
                <?php if ($comments->children) { ?>
                    <div class="comment-children">
                        <?php $comments->threadedComments($options); ?>
                    </div>
                <?php } ?>
        </li>
    <?php } ?>

    <section class="Comments-warpper box sm:box p-3 mb-3" id="comments">
        <?php $this->comments()->to($comments); ?>
        <div class="flex items-center justify-between pb-3">
            <div class="inline-flex items-center">
            <span class="mr-1 inline-flex items-center">
                <iconpark-icon class="iconpark" name="comments" size="20px"></iconpark-icon>
            </span>
            <span>
                <?php if (isset($GLOBALS['page']) && $GLOBALS['page'] == 'page-messages'): ?>
                    <?php $this->commentsNum(_t('<span class="comment-count">0</span> 条留言'), _t('仅有 <span class="comment-count">1</span> 条留言'), _t(' 共 <span class="comment-count">%d</span> 条留言')); ?>
                <?php else: ?>
                    <?php $this->commentsNum(_t('<span class="comment-count">0</span> 条评论'), _t('仅有 <span class="comment-count">1</span> 条评论'), _t(' 共 <span class="comment-count">%d</span> 条评论')); ?>
                <?php endif; ?>
            </span>
            </div>
            <div class="inline-flex items-center">
            <a class="inline-flex items-center" href="#comments">
                <iconpark-icon class="iconpark" name="hand-down" size="18px"></iconpark-icon>
            </a>
            </div>
        </div>
        <!--  -->
        <?php if($this->allow('comment')): ?>
			<div id="<?php $this->respondId(); ?>" class="comment-respond">
                <div class="vcomment">
                    <!--form-->

                    <form id="comment-form" action="<?php $this->commentUrl() ?>" method="post" role="form" class="comment-form relative">
                        <div class="border-b border-color">
                            <div class="mt-1">
                                <div class="form-group field-editor required">

                                    <div class="wysibb">
                                        <div class="wysibb-text">
                                            <textarea id="textarea" class="block w-full mt-1 form-textarea wysibb-texarea textarea OwO-textarea" name="text" rows="6" placeholder="说点什么呢..." aria-required="true" onkeydown="if((event.ctrlKey||event.metaKey)&&event.keyCode==13){document.getElementById('submitComment').click();return false};"></textarea>
                                        </div>
                                        
                                        <div class="wysibb-toolbar" style="max-height: 105px;">
                                            <div class="wysibb-toolbar-container">
                                                <?php if ($this->user->hasLogin()): ?>
                                                    <div class="wysibb-toolbar-btn">
                                                        <a href="/admin" target="_blank" class="btn-inner">
                                                            <?php $email=$this->author->mail; $imgUrl = utils::ParseAvatar($email);echo '<img draggable="false" src="'.$imgUrl.'" alt="admin" class="rounded-full" width="26" height="26">'; ?>
                                                        </a>
                                                        <span class="btn-tooltip">后台管理</span>
                                                    </div>
                                                <?php else: ?>
                                                    <div class="wysibb-toolbar-btn wbb-info">
                                                        <span class="btn-inner">
                                                            <?php $MD5email= md5(Typecho_Cookie::get('__typecho_remember_mail')); echo '<img draggable="false" src="https://cravatar.cn/avatar/'.$MD5email.'?d=mm" alt="user" class="rounded-full" width="26" height="26">'; ?>
                                                        </span>
                                                        <span class="btn-tooltip">编辑评论信息</span>
                                                    </div>
                                                <?php endif; ?>
                                                    <div class="wysibb-toolbar-btn wbb-smilebox static">
                                                        <span class="btn-inner OwO"></span>
                                                    </div>
                                                    <div class="wysibb-toolbar-btn wbb-img">
                                                        <span class="btn-inner" onclick="document.getElementById('textarea').value+='![图片描述](图片地址)' ">
                                                            <iconpark-icon name="pic" size="1.2rem"></iconpark-icon>
                                                        </span>
                                                        <span class="btn-tooltip">插入图片</span>
                                                    </div>
                                                    <div class="wysibb-toolbar-btn wbb-link">
                                                        <span class="btn-inner" onclick="document.getElementById('textarea').value+='[](https://)' ">
                                                            <iconpark-icon name="link-55da7cgk" size="1.2rem"></iconpark-icon>
                                                        </span>
                                                        <span class="btn-tooltip">链接</span>
                                                    </div>
                                                    <div class="wbb-at absolute right-0 top-0 flex items-center justify-center h-full px-2 cursor-pointer bg-gray-400:hover">
                                                        <div id="cancelReply" onclick="cancelReply();" title="点击取消回复" style="display: none;">取消</div>
                                                    </div>
                                            </div>
                                        </div>
                                        <?php if ($this->user->hasLogin()): ?>
                                        <?php else: ?>
                                            <div class="wbb-info-body absolute bottom-10 w-full" style="display:none">
                                                <div class="md:flex">
                                                    <div class="form-group flex">
                                                        <input type="text" id="qqinfo" class="form-input w-full m-2" name="qqinfo" placeholder="QQ号可获取头像和昵称" onblur="fn_qqinfo()">
                                                        <input type="text" id="author" class="form-input w-full m-2" name="author" placeholder="* 怎么称呼" autocomplete="on" value="<?php $this->remember('author'); ?>" required="required">
                                                    </div>
                                                    <div class="form-group flex">
                                                        <input type="email" id="mail" class="form-input w-full m-2" name="mail" placeholder="<?php if ($this->options->commentsRequireMail): ?>* <?php endif; ?>邮箱(放心~会保密~.~)" value="<?php $this->remember('mail'); ?>" <?php if ($this->options->commentsRequireMail): ?> autocomplete="on"  required="required"<?php endif; ?>  onblur="fn_email_info()" lay-verify="email">
                                                        <input type="url" id="url" class="form-input w-full m-2" name="url" placeholder="<?php if ($this->options->commentsRequireURL): ?>* <?php endif; ?><?php _e('http://您的主页'); ?>" value="<?php $this->remember('url'); ?>" <?php if ($this->options->commentsRequireURL): ?> autocomplete="on" required="required"<?php endif; ?> lay-verify="url">
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                        
                                    </div>
                                    
                                    <p class="help-block help-block-error"></p>
                                </div>
                            </div>
                        </div>
                        <div class="py-3 flex items-center justify-between">
                            <div class="form-group field-userinfo-email_close">
                                <div class="flex items-center">
                                    <input type="checkbox" id="secret-button" name="secret" value="1">
                                    <label class="ui-switch2 items-center" for="secret-button" title="开启该功能，您的评论仅作者和评论双方可见"></label>
                                    <span class="ml-4">隐私评论</span>
                                </div>
                            </div>
                            <button id="submitComment" type="submit" class="btn btn-default inline-flex items-center create_comment">
                                <span class="mr-2">
                                    <svg viewBox="0 0 512 512" class="h-3 w-3 fill-current">
                                        <path opacity=".4"
                                            d="M504.5 144.42L264.75 385.5 192 312.59l240.11-241c9.912-9.996 26.052-10.064 36.048-.152l.012.012.14.14L504.5 108c9.998 10.081 9.998 26.339 0 36.42z">
                                        </path>
                                        <path
                                            d="M264.67 385.59l-54.57 54.87c-9.92 9.996-26.063 10.058-36.06.14l-.14-.14L7.5 273.1c-10.003-10.076-10.003-26.334 0-36.41l36.2-36.41c9.902-9.97 26.004-10.045 36-.17l.16.17z">
                                        </path>
                                    </svg>
                                </span>
                                <span>提交</span>
                            </button>
                        </div>
                    </form>

                    
                </div>
            </div>
        <?php else : ?>
            <h3 class="vcount" style="text-align: center;"> 评论已关闭 &gt;_&lt; </h3>
		<?php endif; ?>

        <div class="v-comment" >
            <div class="Comments-lists">
                <?php if ($comments->have()): ?>
                    <?php $comments->listComments(); ?>
                    <?php $comments->pageNav('<', '>', 1, ''); ?>
                <?php endif; ?>	
            </div>
        </div>

	</section>


    <script>
        function fn_qqinfo() {
            //获取QQ信息
            var qq = $("#qqinfo").val();
            if (qq) {
                if (!isNaN(qq)) {
                    $.ajax({
                        url: "https://api.rzv.cc/api/qq?qq=" + qq,
                        method: "get",
                        success: function (data) {
                            if (data == null) {
                                $("#author").val('过路人');
                            }else {
                                $("#author").val(data.data.name);
                                $("#mail").val(qq + '@qq.com');
                                $('.wbb-info img').attr('src',data.data.avatar);
                            }
                            console.log(data);
                        },
                        error: function () {
                            $("#author").val('过路人');
                        }
                    })
                } else {            
                    $("#mail").val('你输入的好像不是QQ号码');
                }
            } else {
                $("#qqinfo").val('请输入您的QQ号');        
            }
        }
        function fn_email_info() {
            var _email = $("input#mail").val();
            if (_email != '') {
                $.ajax({
                type: 'get',
                data: {
                    action: 'ajax_avatar_get',  
                    form: '<?php $this->options->siteUrl(); ?>', // 修改为你的Ajax路径
                    email: _email
                },
                success: function(data) {
                    console.log(data);
                    $('.wbb-info img').attr('src', data); // 修改为你自己的头像标签
                }
                }); // end ajax
            }
        }
    </script>

    
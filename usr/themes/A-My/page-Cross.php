<?php 
/**
 * 动态
 * 
 * @package custom 
 * 
 */
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
$GLOBALS['page'] = 'page-cross';
$this->need('layout/header.php');
?>
<style>
#Cross-mian{}#Cross-mian .comment-parent .comment-children{padding:10px;background:var(--primary-300);border-radius:8px;border-top:solid 2px var(--primary-400);font-size:13px;margin-top:0.5rem;position:relative}#Cross-mian .comment-parent .comment-children .news-content{font-size:unset}#Cross-mian .comment-parent .comment-children:before{box-sizing:content-box;width:0px;height:0px;position:absolute;top:-15px;right:68px;padding:0;border-bottom:8px solid var(--primary-300);border-top:8px solid transparent;border-left:8px solid transparent;border-right:8px solid transparent;display:block;content:'';z-index:12}#Cross-mian .comment-parent .comment-children::after{box-sizing:content-box;width:0px;height:0px;position:absolute;top:-21px;right:66px;padding:0;border-bottom:10px solid var(--primary-400);border-top:10px solid transparent;border-left:10px solid transparent;border-right:10px solid transparent;display:block;content:'';z-index:10}#Cross-mian .action-list-parent:before{box-sizing:content-box;width:0px;height:0px;position:absolute;top:15px;left:-17px;padding:0;border-bottom:8px solid transparent;border-top:8px solid transparent;border-left:8px solid transparent;border-right:8px solid var(--tertiary-99);display:block;content:'';z-index:12}#Cross-mian .show-comment-children{cursor:pointer;color:var(--primary-600);-webkit-transition:all 0.15s linear;-moz-transition:all 0.15s linear;-o-transition:all 0.15s linear;-ms-transition:all 0.15s linear;transition:all 0.15s linear}.cross-head{padding-bottom:5px;margin-bottom:5px;border-bottom:1px solid var(--primary-300)}#Cross-mian .comment-parent .comment-children .comment-children:before,#Cross-mian .comment-parent .comment-children .comment-children:after,#Cross-mian .comment-parent .comment-children .action-list-parent:before,#Cross-mian .comment-parent .comment-children .action-list-parent:after,#Cross-mian .comment-parent .comment-children .cross-tx,#Cross-mian .comment-parent .comment-children .cross-dateWord{display:none}#Cross-mian .comment-parent .comment-children .comment-children{display:block;padding:0;background:unset;border-radius:0;border-top:none;font-size:13px}#Cross-mian .comment-parent .comment-children .action-list-parent{display:block;padding:0;background:unset;border-radius:0;border-top:none;font-size:13px;box-shadow:none}#Cross-mian .comment-parent .comment-children .m-comments-list,#Cross-mian .comment-parent .comment-children .cross-list-li{padding:0}#Cross-mian .comment-parent .comment-children .cross-head{float:left}#Cross-mian .comment-parent .comment-children .cross-state{opacity:0;flex:1;display:flex;align-items:center;justify-content:flex-end;position:absolute;right:0;top:0;transition:all 0.15s linear}#Cross-mian .comment-parent .comment-children .action-list-parent:hover>.cross-foot .cross-state{opacity:1 !important}#Cross-mian .comment-children .action-list-parent .cross-content{display:unset}#Cross-mian .comment-children .action-list-parent .cross-head{line-height:1;margin-bottom:0px !important}
</style>
<div class="container flex flex-wrap flex-1 px-0 sm:px-2 mx-auto mt-3 md:flex-no-wrap">
  <main id="Cross-mian" class="flex-1 w-full" style="width: 0;">
    <div class="box sm:box mb-3 p-3">
		<div class="post_thumbnail-custom flex mb-3 h-32 sm:h-48 relative rounded-md overflow-auto">
			<img class="lazy w-full h-full rounded-md absolute object-cover object-center" 
			data-src="<?php echo Contents::getThumbnails($this)[0] ?>" 
			src="<?php echo Contents::getThumbnails($this)[0] ?>" 
			alt="<?php $this->title() ?>">
			<span class="article-headline-p w-full flex items-center justify-center text-white font-bold text-2xl tracking-wider m-auto flex-col z-10">
				<?php $this->title() ?>
				<font class="archiveTitle text-sm capitalize">- <?php $this->slug() ?> -</font>
			</span>
		</div>
    </div>

    <?php $this->need('layout/article_comments/cross.php'); ?>
  </main>

  <?php $this->need('layout/sidebar.php'); ?>
</div>

<script>
	/* cross子评论数量 */
	function Crosslength() {
		$("#Cross-mian .comment-parent").each(function (){
		var childDiv =  $(this).has(".comment-children");
		if (childDiv.length > 0){
			var tc = childDiv.find(".m-comments-list");
			if (tc.length> 0){
				$(this).find(".show-comment-children").get(0).innerText='展开 ('+tc.length+')';
			}
			/* console.log(tc.length); */
		}
		})  
	}
	Crosslength();
	
	function changeCommentVisibility(obj){
		var text = $(obj).get(0).innerText;
		if (text.indexOf("展开")>-1){
			$(obj).get(0).innerText = text.replace("展开","收起");
		}else {
			$(obj).get(0).innerText = text.replace("收起","展开");
		}
		$(obj).closest(".cross-foot").children(".comment-children").slideToggle();
	}
	$(".cross-content").children(".cross_photos:first").addClass("mt-3");
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
<?php $this->need('layout/footer.php'); ?>
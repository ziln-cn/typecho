<?php 
/**
 * Github
 * 
 * @package custom 
 * 
 */
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
$this->need('layout/header.php');
?>
<div class="container flex flex-wrap flex-1 px-0 sm:px-2 mx-auto mt-3 md:flex-no-wrap">
  <main class="flex-1 w-full" style="width: 0;">
    <div class="box sm:box mb-3 p-3">
		<div class="post_thumbnail-custom flex mb-3 h-32 sm:h-48 relative rounded-md overflow-auto">
			<img class="lazy w-full h-full rounded-md absolute object-cover object-center" 
			data-src="<?php echo Contents::getThumbnails($this)[0] ?>" 
			src="<?php echo Contents::getThumbnails($this)[0] ?>" 
			alt="<?php $this->title() ?>">
		</div>

		<section id="github">
			<!-- 头部 -->
			<style>
				.github-index{display:flex}
				.github-index::-webkit-scrollbar{width:0!important}
				.github-adaption{position:relative;width:0;min-width:0;flex:1}
				.github-index .one-git .search-title{display:flex;align-items:center;height:45px;line-height:45px;color:rgba(0,0,0,.9);user-select:none;border-bottom:1px solid var(--classC);font-size:19px;text-transform:uppercase;padding-bottom:15px}
				.github-index .one-git .search-title svg{width:20px;height:20px;min-width:20px;min-height:20px;margin-right:8px}
				.github-index .one-git .search-title section{display:flex;align-items:center;width:100%}
				.github-index .one-git .search-title{padding:0 15px;margin-bottom:15px;}
				.github-index .one-git .search-title .ellipsis{color: var(--primary-800);max-width:85%;overflow:hidden;white-space:nowrap;text-overflow:ellipsis}
				.hide{display:none}
				.text-center{text-align:center}
				.row-sm>div{padding-right:10px;padding-left:10px}
				.panel{margin:.5rem;background-color:#fff;border:1px solid transparent;border-radius:4px;-webkit-box-shadow:0 1px 1px rgba(0,0,0,.05);box-shadow:0 1px 1px rgba(0,0,0,.05)}
				.panel-body:after,.panel-body:before,.row:after,.row:before{display:table;content:" "}
				.panel-body:after,.row:after{clear:both}
				.panel-body a{color:#58666e;word-wrap:break-word;word-break:break-all}
				@-webkit-keyframes spinner-border{to{-webkit-transform:rotate(360deg);transform:rotate(360deg)}
				}
				@keyframes spinner-border{to{-webkit-transform:rotate(360deg);transform:rotate(360deg)}
				}
				.spinner-border{display:inline-block;width:2rem;height:2rem;vertical-align:text-bottom;border:.25em solid currentColor;border-right-color:transparent;border-radius:50%;border-width:.125em;-webkit-animation:spinner-border .75s linear infinite;animation:spinner-border .75s linear infinite}
				.sr-only{position:absolute;width:1px;height:1px;padding:0;margin:-1px;overflow:hidden;clip:rect(0,0,0,0);white-space:nowrap;border:0}
				.b-light{border-color:var(--primary-300)}
				.bg-success .text-muted{color:#9ee4af!important}
				.font-thin{font-weight:300}
				.panel-body{padding:15px;position:relative}
				.github_language{position:absolute;font-size:20px;bottom:6px;right:14px}
				.clear{display:block;overflow:hidden}
				.text-ellipsis{display:block;overflow:hidden;text-overflow:ellipsis;white-space:nowrap}
				.m-sm{margin:10px}
				.text-muted{color:#a0a0a0}
				.btn{display:inline-block;padding:6px 12px;margin-bottom:0;font-size:14px;line-height:1.42857143;text-align:center;white-space:nowrap;vertical-align:middle;-ms-touch-action:manipulation;touch-action:manipulation;cursor:pointer;-webkit-user-select:none;-moz-user-select:none;-ms-user-select:none;user-select:none;background-image:none;border:1px solid transparent;font-weight:500;border-radius:2px;outline:0!important}
				.btn-rounded{padding-right:15px;padding-left:15px;border-radius:50px}
				.panel-body a:hover{color:#222}
				.bg-light {
					background-color: var(--primary-300);
				}
				.bg-dark a{color:#c1c3c9}
				.bg-dark {
					background-color: #465161!important;
					color: #fff!important
				}
				.bg-dark a:hover{color:#fff}
				.bg-dark .text-muted{color:#8b8e99!important}
				.bg-black a{color:#96abbb}
				.bg-black a:hover{color:#fff}
				.bg-black .text-muted{color:#5c798f!important}
				.bg-primary a{color:#fff}
				.bg-primary {
					background-color: #000!important;
					color: #fff!important
				}
				.bg-primary a:hover{color:#fff}
				.bg-primary .text-muted{color:#d6d3e6!important}
				.bg-success a{color:#eefaf1}
				.bg-success {
					background-color: #15c377!important;
					color: #fff!important
				}
				.bg-success a:hover{color:#fff}
				.bg-success .text-muted{color:#9ee4af!important}
				.bg-info a{color:#fff}
				.bg-info {
					background-color: #48b0f7!important;
					color: #fff!important
				}
				.bg-info a:hover{color:#fff}
				.bg-info .text-muted{color:#b0e1f1!important}
				.bg-warning a{color:#fff}
				.bg-warning {
					background-color: #faa64b!important;
					color: #fff!important
				}
				.bg-warning a:hover{color:#fff}
				.bg-warning .text-muted{color:#fbf2cb!important}
				.bg-danger a{color:#fff}
				.bg-danger {
					background-color: #f96868!important;
					color: #fff!important
				}
				.bg-danger a:hover{color:#fff}
				.bg-danger .text-muted{color:#e6e6e6!important}
				.bg-info a:hover{color:#fff}
				.btn{font-weight:500;border-radius:2px;outline:0!important}
				.block{display:block}


				</style>
			<!-- 主体 -->
			<section class="container github-index">
				<section class="github-adaption">
					<section class="one-git">
						<?php
						$githubUser = $this->fields->github;
						if ($githubUser == "" || $githubUser == null) {
							$githubUser = 'irozhi';
						}
						?>
						<section class="search-title">
							<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
									stroke="currentColor" stroke-width="2" stroke-linecap="round"
									stroke-linejoin="round">
								<path d="M20.24 12.24a6 6 0 0 0-8.49-8.49L5 10.5V19h8.5z"></path>
								<line x1="16" y1="8" x2="2" y2="22"></line>
								<line x1="17.5" y1="15" x2="9" y2="15"></line>
							</svg>
							<section>
								<span class="ellipsis"><?php echo $githubUser; ?> 的 Repo</span>
							</section>
						</section>
						<section class="github-index-article article">

							<small class="text-muted letterspacing github_tips"></small>

							<div class="github_page">
								<div class="loading-nav text-center" style="padding: 2rem;">
									<div class="spinner-border" role="status">
										<span class="sr-only"></span>
									</div>
								</div>
								<nav class="alert alert-warning hide text-center" role="alert">
									<p class="infinite-scroll-request">加载失败！尝试重新加载</p>
								</nav>
							</div>
						</section>

					</section>
				</section>

			</section>
			<!-- 尾部 -->
		</section>
    </div>
  </main>

  <?php $this->need('layout/sidebar.php'); ?>
</div>
<script type="text/javascript">
    function appendHtml(elem, value) {
        let node = document.createElement("div"),
            fragment = document.createDocumentFragment(),
            childs = null,
            i = 0;
        node.innerHTML = value;
        childs = node.childNodes;
        for (; i < childs.length; i++) {
            fragment.appendChild(childs[i]);
        }
        elem.appendChild(fragment);
        childs = null;
        fragment = null;
        node = null;
    }

    function openGithub () {
            const githubItemTemple = '<div class="flex-50">' +
            '<div class="panel b-light {BG_COLOR}">\n' +
            '        <div class="panel-body"><div class="github_language">{PROJECT_LANGUAGE}</div>' +
            '          \n' +
            '          <div class="clear">\n' +
            '            <h3 class="text-ellipsis font-thin h3">{REPO_NAME}</h3>\n' +
            '            <small class="block m-sm"><i class="iconfont icon-star m-r-xs"></i>{REPO_STARS} stars / <i class="iconfont icon-fork"></i> {REPO_FORKS} forks</small>\n' +
            '<small class="text-ellipsis block text-muted">{REPO_DESC}</small>' +
            '<a target="_blank" href="{REPO_URL}" class="m-sm btn btn-rounded btn-sm lter btn-{BUTTON_COLOR}"><i class="glyphicon glyphicon-hand-up"></i>访问</a>' +
            '          </div>\n' +
            '        </div>\n' +
            '      </div>' +
            '</div>';
        function handleGithub () {
            var repoContainer = document.querySelector('.github_page')//$('.github_page');
            var loadingContainer = document.querySelector(".github_page .loading-nav");
            var errorContainer = document.querySelector(".github_page .error-nav");
            var countContainer = document.querySelector(".github_tips");
            var colors = ["light", "info", "dark", "success", "black", "warning", "primary", "danger"];
            let httpRequest = new XMLHttpRequest();
            httpRequest.open('GET', "https://api.github.com/users/<?php echo $githubUser; ?>/repos?accept=application/vnd.github.v3+json&sort=updated&direction=desc&per_page=100", true);
            httpRequest.send();
            httpRequest.onreadystatechange = function () {
                if (httpRequest.readyState === 4 && httpRequest.status === 200) {
                    let json = JSON.parse(httpRequest.responseText);
                    if (json) {
                        loadingContainer.classList.add("hide")
                        let ul = "<div class='raw'><div class='col-md-12'><div class=\"flexbox grid text-center " +
                            "github_contain" +
                            "\"></div></div></div>";
                        appendHtml(repoContainer, ul)
                        let contentContainer = document.querySelector(".github_contain");
                        json.sort(function (a, b) {
                            return b.stargazers_count - a.stargazers_count
                        })
                        let show_len = json.length > 33 ? 33 : json.length
                        for (let i = 0; i < show_len; i++) {
                            let repo = json[i]
                            repo.updated_at = repo.updated_at.substring(0, repo.updated_at.lastIndexOf("T"));
                            if (repo.language == null) {
                                repo.language = "未知";
                            }
                            //匹配替换
                            let item = githubItemTemple.replace("{REPO_NAME}", repo.name)
                                .replace("{REPO_URL}", repo.html_url)
                                .replace("{REPO_STARS}", repo.stargazers_count)
                                .replace("{REPO_FORKS}", repo.forks_count)
                                .replace("{REPO_DESC}", repo.description)
                                .replace("{BG_COLOR}", "bg-" + colors[i % 8])
                                .replace("{BUTTON_COLOR}", colors[(i) % 8])
                                .replace("{PROJECT_LANGUAGE}", repo.language);
                            appendHtml(contentContainer, item)
                        }
                    } else {
                        errorContainer.classList.remove("hide");
                    }
                }
            };
        };

        return {
            init: function () {
                handleGithub();
            }
        }
    };
    openGithub().init();


</script>
<?php $this->need('layout/footer.php'); ?>
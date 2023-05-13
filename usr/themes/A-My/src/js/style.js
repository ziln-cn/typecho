console.log("\n %c Theme %c A-My \n\n", "color: #eee; background: #222f3e; padding:5px 0;", "background: #989898; padding:5px 0;");

function dark() {
	window.requestAnimationFrame = window.requestAnimationFrame || window.mozRequestAnimationFrame || window.webkitRequestAnimationFrame || window.msRequestAnimationFrame;
	var n, e, i, h, t = .05,
		s = document.getElementById("universe"),
		o = !0,
		a = "180,184,240",
		r = "226,225,142",
		d = "226,225,224",
		c = [];

	function f() {
		n = window.innerWidth, e = window.innerHeight, i = .216 * n, s.setAttribute("width", n), s.setAttribute("height", e)
	}
	function u() {
		h.clearRect(0, 0, n, e);
		for (var t = c.length, i = 0; i < t; i++) {
			var s = c[i];
			s.move(), s.fadeIn(), s.fadeOut(), s.draw()
		}
	}
	function y() {
		this.reset = function() {
			this.giant = m(3), this.comet = !this.giant && !o && m(10), this.x = l(0, n - 10), this.y = l(0, e), this.r = l(1.1, 2.6), this.dx = l(t, 6 * t) + (this.comet + 1 - 1) * t * l(50, 120) + 2 * t, this.dy = -l(t, 6 * t) - (this.comet + 1 - 1) * t * l(50, 120), this.fadingOut = null, this.fadingIn = !0, this.opacity = 0, this.opacityTresh = l(.2, 1 - .4 * (this.comet + 1 - 1)), this.do = l(5e-4, .002) + .001 * (this.comet + 1 - 1)
		}, this.fadeIn = function() {
			this.fadingIn && (this.fadingIn = !(this.opacity > this.opacityTresh), this.opacity += this.do)
		}, this.fadeOut = function() {
			this.fadingOut && (this.fadingOut = !(this.opacity < 0), this.opacity -= this.do /2,(this.x>n||this.y<0)&&(this.fadingOut=!1,this.reset()))},this.draw=function(){if(h.beginPath(),this.giant)h.fillStyle="rgba("+a+","+this.opacity+")",h.arc(this.x,this.y,2,0,2*Math.PI,!1);else if(this.comet){h.fillStyle="rgba("+d+","+this.opacity+")",h.arc(this.x,this.y,1.5,0,2*Math.PI,!1);for(var t=0;t<30;t++)h.fillStyle="rgba("+d+","+(this.opacity-this.opacity/20 * t) + ")", h.rect(this.x - this.dx / 4 * t, this.y - this.dy / 4 * t - 2, 2, 2), h.fill()
		} else h.fillStyle = "rgba(" + r + "," + this.opacity + ")", h.rect(this.x, this.y, this.r, this.r);
		h.closePath(), h.fill()
	}, this.move = function() {
		this.x += this.dx, this.y += this.dy, !1 === this.fadingOut && this.reset(), (this.x > n - n / 4 || this.y < 0) && (this.fadingOut = !0)
	}, setTimeout(function() {
		o = !1
	}, 50)
}
function m(t) {
	return Math.floor(1e3 * Math.random()) + 1 < 10 * t
}
function l(t, i) {
	return Math.random() * (i - t) + t
}
f(), window.addEventListener("resize", f, !1), function() {
	h = s.getContext("2d");
	for (var t = 0; t < i; t++) c[t] = new y, c[t].reset();
	u()
}(), function t() {
	document.getElementsByTagName('body')[0].getAttribute('class') == 'bg-primary-300 theme-ocean' && u(), window.requestAnimationFrame(t)
}()
};
dark()

const OA_My = {
    GoTop: function () {
        $("#GoTop a").click(function () {
            var _this = $(this);
            $('html,body').animate({ scrollTop: 0 }, 500);
        });
        $(window).on("scroll", function () {
            var fromTop = $(window).scrollTop();
            if (fromTop > 100) {  //判断滚动后高度超过200px,就显示
                $('#GoTop').addClass('btt-visible');
            } else {
                $('#GoTop').removeClass('btt-visible');
            }
        });
    },
    switch_theme: function () {
        const e = document.getElementById("light"),
            s = document.getElementById("ocean"),
            t = document.getElementById("jade"),
            d = document.body,
            a = localStorage.getItem("theme");
        if (
            ("theme-jade" === a
                ? (d.classList.add("theme-jade"),
                    d.classList.remove("theme-light", "theme-ocean"),
                    $("iconpark-icon.iconpark").attr("fill","var(--primary-300)")
                )
                : "theme-ocean" === a
                    ? (d.classList.add("theme-ocean"),
                        d.classList.remove("theme-jade", "theme-light"),
                        $("iconpark-icon.iconpark").attr("fill","var(--primary-300)")
                    )
                    : (d.classList.add("theme-light"),
                        d.classList.remove("theme-ocean", "theme-jade")
                    ),
                null == s || null == e || null == t)
        )
            return !1;
        "theme-jade" === a
            ? (e.classList.remove("hidden"),
                t.classList.add("hidden"),
                s.classList.add("hidden"))
            : "theme-ocean" === a
                ? (t.classList.remove("hidden"),
                    s.classList.add("hidden"),
                    e.classList.add("hidden"))
                : (s.classList.remove("hidden"),
                    e.classList.add("hidden"),
                    t.classList.add("hidden")),
            (e.onclick = () => {
                d.classList.remove("theme-ocean", "theme-jade"),
                    d.classList.add("theme-light"),
                    localStorage.setItem("theme", "theme-light"),
                    s.classList.remove("hidden"),
                    e.classList.add("hidden"),
                    t.classList.add("hidden");
                    $("iconpark-icon.iconpark").removeAttr("fill","var(--primary-300)");
                    tip.open({
                        content: '<div class="flex items-center justify-center"><span class="mr-2 flex items-center justify-center"><iconpark-icon name="config" size="1rem" class="iconpark hover:text-orange-600" color="#fbd38d"></iconpark-icon></span><span>已切换为：日间模式</span></div>',
                        skin: "theme",
                        time: 3,
                        anim: "down",
                        shade: false
                    });
            }),
            (s.onclick = () => {
                d.classList.remove("theme-light", "theme-jade"),
                d.classList.add("theme-ocean"),
                localStorage.setItem("theme", "theme-ocean"),
                t.classList.remove("hidden"),
                s.classList.add("hidden"),
                e.classList.add("hidden");
                $("iconpark-icon.iconpark").attr("fill","var(--primary-300)");
                tip.open({
                    content: '<div class="flex items-center justify-center"><span class="mr-2 flex items-center justify-center"><iconpark-icon name="dark-mode" size="1rem" class="iconpark hover:text-orange-600" color="var(--primary-700)"></iconpark-icon></span><span>已切换为：夜晚模式</span></div>',
                    skin: "theme",
                    time: 3,
                    anim: "down",
                    shade: false
                });
            }),
            (t.onclick = () => {
                d.classList.remove("theme-ocean", "theme-light"),
                d.classList.add("theme-jade"),
                localStorage.setItem("theme", "theme-jade"),
                e.classList.remove("hidden"),
                t.classList.add("hidden"),
                s.classList.add("hidden");
                $("iconpark-icon.iconpark").attr("fill","var(--primary-300)");
                tip.open({
                    content: '<div class="flex items-center justify-center"><span class="mr-2 flex items-center justify-center"><iconpark-icon name="sleep" size="1rem" class="iconpark hover:text-orange-600" color="var(--primary-700)"></iconpark-icon></span><span>已切换为：深夜模式</span></div>',
                    skin: "theme",
                    time: 3,
                    anim: "down",
                    shade: false
                });
            });
    },
    LazyLoad: function () {
        var lazyLoadInstance = new LazyLoad({
          elements_selector: "div.lazy,img.lazy"
        });
    },
    stick_in_parent: function () {
        $('.sticky-header').stick_in_parent({
            parent: '.container'
        });
        $('.sticky-header')
        .on('sticky_kit:bottom', function(e) {
            $(this).parent().css('position', 'static');
        })
        .on('sticky_kit:unbottom', function(e) {
            $(this).parent().css('position', 'relative');
        });
    },
    get_post_support: function () {
        //点赞
        $('.post-suport').on('click', function () {
            let cid = $(this).data('cid');
            $.ajax({
            url: `/?action=support`,
            type: 'POST',
            data: {
                cid: cid
            },
            dataType: 'json',
            success: res => {
                if (res.success) {
                    $(this).html('<iconpark-icon class="iconpark mr-1" name="good-two" size="1em"></iconpark-icon> <span class="ml-1">' + res.count + ' ' + '赞</span>')
                    tip.open({
                        content: '<div class="flex justify-center items-center"><iconpark-icon name="check-one" class="mr-1" color="#2f855a"></iconpark-icon>感谢支持~</div>',
                        skin: "smsg",
                        time: 3,
                        anim: "down",
                        shade: false
                    });
                } else {
                    tip.open({
                        content: '<div class="flex justify-center items-center"><iconpark-icon name="info" class="mr-1" color="#2b6cb0"></iconpark-icon>请勿重复点赞~</div>',
                        skin: "msg",
                        time: 3,
                        anim: "down",
                        shade: false
                    });
                }
            }
            });
        });
    },
    page_next: function () {
        //点击下一页的链接(即那个a标签)
        $('.page_next .next').click(function() {
          $this = $(this);
          $this.addClass('loading').text('正在加载中...'); //给a标签加载一个loading的class属性，用来添加加载效果
          var href = $this.attr('href'); //获取下一页的链接地址
          if (href != undefined) { //如果地址存在
              $.ajax({ //发起ajax请求
                  url: href,
                  //请求的地址就是下一页的链接
                  type: 'get',
                  //请求类型是get
                  error: function(request) {
                    //如果发生错误怎么处理
                    tip.open({
                        content: '<div class="flex justify-center items-center"><iconpark-icon name="close-one" class="mr-1" color="#c53030"></iconpark-icon>加载失败</div>',
                        skin: "emsg",
                        time: 3,
                        anim: "down",
                        shade: false
                    });
                  },
                  success: function(data) { //请求成功
                      $this.removeClass('loading').text('加载更多'); //移除loading属性
                      var $res = $(data).find('.news-item'); //从数据中挑出文章数据，请根据实际情况更改
    
                      $('.post-list').append($res.fadeIn(500)); //将数据加载加进posts-loop的标签中。
    
                      $("html, body").animate({
                        scrollTop: $('.post-list .news-item:nth-last-child(' + Config.pageSize + ')').offset().top + -65 + "px"
                        }, {
                        duration: 600,
                        easing: "linear"
                    });
    
                      var newhref = $(data).find('.page_next .next').attr('href'); //找出新的下一页链接
                      if (newhref != undefined) {
                          $('.page_next .next').attr('href', newhref);
                            tip.open({
                                content: '<div class="flex justify-center items-center"><iconpark-icon name="check-one" class="mr-1" color="#2f855a"></iconpark-icon>加载成功~</div>',
                                skin: "smsg",
                                time: 3,
                                anim: "down",
                                shade: false
                            });
                      } else {
                          $('.page_next .next').remove(); //如果没有下一页了，隐藏
                          tip.open({
                                content: '<div class="flex justify-center items-center"><iconpark-icon name="info" class="mr-1" color="#2b6cb0"></iconpark-icon>最后一页啦~</div>',
                                skin: "msg",
                                time: 3,
                                anim: "down",
                                shade: false
                            });
                      }
    
                      OA_My.LazyLoad();
                      OA_My.switch_theme();
                      OA_My.get_post_support();
                      OA_My.viewImage();
                  }
              });
          }
          return false;
        });
    },
    InitOwO: function () {
        if ($(".OwO").length > 0) {
            new OwO({
            logo: '<iconpark-icon name="slightly-smiling-face-55da4po3" size="1.2rem"></iconpark-icon>',
            container: document.getElementsByClassName('OwO')[0],
            target: document.getElementsByClassName('OwO-textarea')[0],
            api: Config.owoJson,
            position: 'up',
            width: '450px',
            maxHeight: '150px'
            });
        }
    },
    ajaxComment: function () {
        $('.comment-form').submit(function(event){
            var commentdata=$(this).serializeArray();
            $.ajax({
                url:$(this).attr('action'),
                type:$(this).attr('method'),
                data:commentdata,
                beforeSend:function() {
                    tip.open({
                        content: '<div class="flex justify-center items-center"><iconpark-icon name="info" class="mr-1" color="#2b6cb0"></iconpark-icon>评论提交中请稍后~</div>',
                        skin: "msg",
                        time: 3,
                        anim: "down",
                        shade: false
                    });
                },
                error:function(request) {
                    tip.open({
                        content: request.responseText.split('<div class="container">')[1].split('</div>')[0],
                        skin: "emsg",
                        time: 3,
                        anim: "down",
                        shade: false
                    });
                },
                success:function(data){
                    $('#submitComment').addClass('submit').text('发表评论');
                    var error=/<title>Error<\/title>/;
                    if (error.test(data)){
                        var text=data.match(/<div(.*?)>(.*?)<\/div>/is);
                        var str='发生了未知错误';if (text!=null) str=text[2];
                        var text = $("#textarea").val();
                        var qq = $("#qqinfo").val();
                        var author = $("#author").val();
                        var mail = $("#mail").val();
                        var newUrl = str.replace(".html",".html/comment?text="+text+"&qqinfo="+qq+"&author="+author+"&mail="+mail+"&url=");
                        tip.open({
                            content: '<div class="flex justify-center items-center"><iconpark-icon name="close-one" class="mr-1" color="#c53030"></iconpark-icon>评论失败~'+ newUrl +'</div>',
                            skin: "emsg",
                            time: 3,
                            anim: "down",
                            shade: false
                        });
                    } else {
                        tip.open({
                            content: '<div class="flex justify-center items-center"><iconpark-icon name="check-one" class="mr-1" color="#2f855a"></iconpark-icon>评论成功！</div>',
                            skin: "smsg",
                            time: 3,
                            anim: "down",
                            shade: false
                        });
                        $('#comment-parent').remove();
                        $("#textarea").val('');
                        $(".comment-respond textarea").attr('placeholder', '评论成功！');
                        $('#cancelReply').text('').css('display', 'none');
                        if(Config.sidebar_switch == "true"){
                            document.querySelector('.comment-form').style.display = 'none';
                        }
                        $('.comment').html($('.comment',data).html()); 
                        $('.comments-title').html($('.comments-title',data).html()); 
                        $('.Comments-lists').html($('.Comments-lists',data).html());
                        /*  */
                        var biggestNum = 0; 
                        $('li[id^="li-comment-"]').each(function(){ 
                            var currentNum = parseInt($(this).attr('id').replace('li-comment-', ''), 0); 
                            if(currentNum > biggestNum) { 
                            biggestNum = currentNum; 
                            } 
                        });
                        $("html, body").animate({
                            scrollTop: $('#li-comment-' + biggestNum).offset().top + -60 + "px"
                            }, {
                            duration: 600,
                            easing: "linear"
                        });
                    }
                }
            });
            return false;
        });
    },
    viewImage: function () {
        window.ViewImage && ViewImage.init('.ViewImage');
    },
    Others: function () {
        if(Config.sidebar_switch == "true"){
            fetch('https://v1.hitokoto.cn')
            .then(response => response.json())
            .then(data => {
                const hitokoto = document.getElementById('hitokoto_text')
                hitokoto.innerText = data.hitokoto
            })
        }
        
        
        /* links随机排序 */
        var span=document.getElementById('links_list');
        var spanItem=document.getElementsByName('link_a');
        var random=function(){return Math.random()>0.5 ? -1 : 1};//为sort()传入的随机排列参数
        var spanArr=new Array();//用来存放元素的数组
        var k,m;
        for(var i=0; i<spanItem.length; i++){
        spanArr.push(spanItem[i]);//将元素存入元素数组
        }
        spanArr.sort(random);//打乱元素数组排列顺序
        for(k=0; k<spanArr.length; k++){
        span.appendChild(spanArr[k]);//将打乱后的元素重新插入到页面中
        }

        $('.wbb-info').on('click', function() {
            $('.wbb-info-body').slideToggle();
        })
        $('.OwO').on('click', function() {
            $('.OwO-body').slideToggle();
        })

        let holder = $('.comment-respond textarea').attr('placeholder');
        $('#secret-button').click(function () {
            let textareaDom = $('.comment-respond textarea');
            if ($(this).is(':checked')) {
                textareaDom.attr('placeholder', '开启悄悄话~')
                $(".comment-respond textarea").addClass("secret-textarea");
            } else {
                textareaDom.attr('placeholder', holder)
                $(".comment-respond textarea").removeClass("secret-textarea");
            }
        })
        $('#submitComment').on('click', function() {
            $('.wbb-info-body').slideToggle();
        })

        /*  */
        var offsetWidth = window.screen.width;
        var abc = $('.header-nav ul li').length;
        console.log(abc)
        if (offsetWidth < 996 && abc > 5) {
            $('.overflows').addClass('overflows-done');
        }
        else {
            $('.overflows').removeClass('overflows-done');
        }

        
		$("pre[class*=' language-']").each(function (index, item) {
			let text = $(item).find("code[class*=' language-']").text();
			let span = $(`<span class="copy">复制</span>`);
            new ClipboardJS(span[0], { text: () => text }).on('success', () => tip.open({content: '<div class="flex justify-center items-center"><iconpark-icon name="check-one" class="mr-1" color="#2f855a"></iconpark-icon>复制成功~</div>',skin: "smsg",time: 3,anim: "down",shade: false}) );
			$(item).append(span);
		});
        
    }
}

function PjaxLoad() {
    OA_My.GoTop();
    OA_My.switch_theme();
    OA_My.LazyLoad();
    OA_My.stick_in_parent();
    OA_My.get_post_support();
    OA_My.page_next();
    OA_My.InitOwO();
    OA_My.ajaxComment();
    OA_My.viewImage();
    OA_My.Others();
}


$(function () {
    PjaxLoad();
})


function insertAtCursor(t, e) {
    var n = t.scrollTop,
        o = document.documentElement.scrollTop;
    if (document.selection) {
        t.focus();
        var s = document.selection.createRange();
        s.text = e, s.select()
    } else if (t.selectionStart || "0" == t.selectionStart) {
        var l = t.selectionStart,
            c = t.selectionEnd;
        t.value = t.value.substring(0, l) + e + t.value.substring(c, t.value.length), t.focus(), t.selectionStart = l + e.length, t.selectionEnd = l + e.length
    } else t.value += e, t.focus();
    t.scrollTop = n, document.documentElement.scrollTop = o
}
$(function () {
    0 < $("#wmd-button-row").length && (
        $("#wmd-button-row").append('<li class="wmd-spacer wmd-spacer1"></li><li class="wmd-button" id="wmd-images-button" style="" title="插入图集">图集</li>'), 
        $("#wmd-button-row").append('<li class="wmd-spacer wmd-spacer1"></li><li class="wmd-button" id="wmd-photoset-button" style="" title="插入相册">相册</li>'), 
        $("#wmd-button-row").append('<li class="wmd-spacer wmd-spacer1"></li><li class="wmd-button" id="wmd-imgurl-button" style="" title="插入图片超链接">图片超链接</li>'), 
        $("#wmd-button-row").append('<li class="wmd-spacer wmd-spacer1"></li><li class="wmd-button" id="wmd-textColor-button" style="" title="插入多彩字体">多彩字体</li>'), 
        $("#wmd-button-row").append('<li class="wmd-spacer wmd-spacer1"></li><li class="wmd-button" id="wmd-Timeline-button" style="" title="插入时光轴">时光轴</li>'),
        $("#wmd-button-row").append('<li class="wmd-spacer wmd-spacer1"></li><li class="wmd-button" id="wmd-Messages-button" style="" title="插入消息对话">消息对话</li>'),
        $("#wmd-button-row").append('<li class="wmd-spacer wmd-spacer1"></li><li class="wmd-button" id="wmd-video-button" style="" title="插入视频">视频</li>'), 
        $("#wmd-button-row").append('<li class="wmd-spacer wmd-spacer1"></li><li class="wmd-button" id="wmd-biliVideo-button" style="" title="插入blibli">bilibli视频</li>'),
        $('#wmd-button-row').append('<li class="wmd-spacer wmd-spacer1"></li><li class="wmd-button" id="wmd-cid-button" style="" title="文章跳转">文章跳转</li>'),
        $('#wmd-button-row').append('<li class="wmd-spacer wmd-spacer1"></li><li class="wmd-button" id="wmd-collapse-button" style="" title="展开隐藏">展开隐藏</li>'),
        $('#wmd-button-row').append('<li class="wmd-spacer wmd-spacer1"></li><li class="wmd-button" id="wmd-tabs-button" style="" title="tabs标签">tabs标签</li>'),
        $("#wmd-button-row").append('<li class="wmd-spacer wmd-spacer1"></li><li class="wmd-button" id="wmd-Callout-button" style="" title="插入提示">提示</li>'), 
        $("#wmd-button-row").append('<li class="wmd-spacer wmd-spacer1"></li><li class="wmd-button" id="wmd-hide-button" style="" title="插入隐藏内容">隐藏内容</li>'), 
        $('#wmd-button-row').append('<li class="wmd-spacer wmd-spacer1"></li><li class="wmd-button" id="wmd-anniu-button" style="" title="插入按钮">插入按钮</li>'),
        $('#wmd-button-row').append('<li class="wmd-spacer wmd-spacer1"></li><li class="wmd-button" id="wmd-bkanniu-button" style="" title="插入边框按钮">插入边框按钮</li>'),
        $('#wmd-button-row').append('<li class="wmd-spacer wmd-spacer1"></li><li class="wmd-button" id="wmd-Iconbtn-button" style="" title="插入图标按钮">插入图标按钮</li>'),
        $('#wmd-button-row').append('<li class="wmd-spacer wmd-spacer1"></li><li class="wmd-button" id="wmd-Downloadbtn-button" style="" title="插入下载按钮">插入下载按钮</li>'),
        $("#wmd-button-row").append('<li class="wmd-spacer wmd-spacer1"></li><li class="wmd-button" id="wmd-owo-button" style="" title="插入表情"><div class="OwO"></div></li>'), 
        new OwO({
        logo: "OωO",
        container: document.getElementsByClassName("OwO")[0],
        target: document.getElementById("text"),
        api: "/usr/themes/A-My/libs/owo/OwO.json",
        position: "down",
        width: "400px",
        maxHeight: "250px"
    })), 
    $(document).on("click", "#wmd-images-button", function () {
        myField = document.getElementById("text"), 
        insertAtCursor(myField, '[images]\n\n[/images]\n')
    });
    $(document).on("click", "#wmd-photoset-button", function () {
        myField = document.getElementById("text"), 
        insertAtCursor(myField, '[photos]\n\n[/photos]\n')
    });
    $(document).on("click", "#wmd-imgurl-button", function () {
        myField = document.getElementById("text"), 
        insertAtCursor(myField, '[imgurl url="" src="" alt=""]')
    });
    $(document).on("click", "#wmd-textColor-button", function () {
        myField = document.getElementById("text"), 
        insertAtCursor(myField, '[textColor color=""][/textColor]\n')
    });

    $(document).on("click", "#wmd-Timeline-button", function () {
        myField = document.getElementById("text"), 
        insertAtCursor(myField, '[Timeline time="2021年"]\n[Timeline-item time="11-20" state="info"]\n内容\n[/Timeline-item]\n[Timeline-item time="11-20" state="yellow"]\n内容\n[/Timeline-item]\n[Timeline-item time="11-20" state="dark"]\n内容\n[/Timeline-item]\n[Timeline-item time="11-20" state="success"]\n内容\n[/Timeline-item]\n[/Timeline]\n')
    });
    $(document).on("click", "#wmd-Messages-button", function () {
        myField = document.getElementById("text"), 
        insertAtCursor(myField, '[Messages]\n[Messages-item by="user" avatar="https://q2.qlogo.cn/headimg_dl?dst_uin=80360650&spec=100"]\n内容\n[/Messages-item]\n[Messages-item by="author" avatar="https://q2.qlogo.cn/headimg_dl?dst_uin=80360650&spec=100"]\n内容\n[/Messages-item]\n[/Messages]\n')
    });
    $(document).on("click", "#wmd-video-button", function () {
        myField = document.getElementById("text"), 
        insertAtCursor(myField, '[video src=""]\n')
    });
    $(document).on("click", "#wmd-biliVideo-button", function () {
        myField = document.getElementById("text"), 
        insertAtCursor(myField, '[bilibili bv="" p="1"]\n')
    });
    $(document).on('click', '#wmd-cid-button', function () {
        myField = document.getElementById('text');
        insertAtCursor(myField, '[cid=""]\n');
    });

    /* 下拉手风琴 */
    $(document).on('click', '#wmd-collapse-button', function () {
        myField = document.getElementById('text');
        insertAtCursor(myField, '[collapse]\n[collapse-item label="标题"]\n内容\n[/collapse-item]\n[/collapse]\n');
    });

    /* Tab */
    $(document).on('click', '#wmd-tabs-button', function () {
        myField = document.getElementById('text');
        insertAtCursor(myField, '[tabs]\n[tab-pane label="标题"]\n内容\n[/tab-pane]\n[/tabs]\n');
    });

    /* 提示 */
    $(document).on('click', '#wmd-Callout-button', function() {//标签

        $('body').append(
            '<div id="Callout">'+//提示
            '<div class="wmd-prompt-background" style="position: fixed; top: 0px; z-index: 1000; opacity: 0.5; height: 100%; left: 0px; width: 100%;"></div>'+
            '<div class="wmd-prompt-dialog">'+
            '<div>'+
            '<p><b>插入提示</b></p>'+
            '<p><labe>样式</labe></p>'+
            '<p><select id="type" style="width: 100%"><option value="success">成功绿</option><option value="info">信息蓝</option><option value="warning">警告橙</option><option value="danger">错误红</option></select></p>'+
            '</div>'+
            '<form>'+
            '<button type="button" class="btn btn-s primary" id="Callout_ok">确定</button>'+//
            '<button type="button" class="btn btn-s" id="Callout_cancel">取消</button>'+//
            '</form>'+
            '</div>'+
            '</div>');
        $('.wmd-prompt-dialog input').select();

    });
    $(document).on('click','#Callout_ok',function() {

        var obj_ty = document.getElementById("type"); //定位id
        var index_ty = obj_ty.selectedIndex; // 选中索引
        var type = obj_ty.options[index_ty].value; // 选中值
        textContent = '[Callout type="' + type + '"]这里编辑提示内容[/Callout]';

        myField = document.getElementById('text');
        inserContentToTextArea(myField,textContent,'#textPanel');
    });
    $(document).on('click','#Callout_cancel',function() {
        $('#Callout').remove();
        $('textarea').focus();
    });


    /* 隐藏内容 */
    $(document).on('click','#wmd-hide-button',function() {
        myField = document.getElementById('text');
        insertAtCursor(myField, '[hide]\n隐藏内容\n[/hide]\n');
    });

    /* 基本按钮 */
    $(document).on('click', '#wmd-anniu-button', function() {
        $('body').append(
        '<div id="anniu">'+
        '<div class="wmd-prompt-background" style="position: fixed; top: 0px; z-index: 1000; opacity: 0.5; height: 100%; left: 0px; width: 100%;"></div>'+
        '<div class="wmd-prompt-dialog">'+
        '<div>'+
        '<p><b>插入按钮</b></p>'+
        '<p><labe>按钮类型</labe></p>'+
        '<p><select id="btn_type" style="width: 100%"><option value="anniu">基本按钮</option><option value="round">圆角按钮</option></select></p>'+
        '<p><labe>按钮样式</labe></p>'+
        '<p><select id="btn_state" style="width: 100%"><option value="default">默认</option><option value="success">绿色</option><option value="warning">橙色</option><option value="secondary">灰色</option><option value="purple">紫色</option><option value="cyan">青色</option><option value="brown">棕色</option><option value="info">蓝色</option><option value="danger">红色</option><option value="dark">黑色</option><option value="pink">粉红色</option><option value="yellow">黄色</option></select></p>'+
        '<p><labe>按钮链接</labe><input name="links"' +
        ' type="text" placeholder="请输入按钮链接"></input></p>' +
        '<p><labe>按钮文字</labe><input name="title"' +
        ' type="text" placeholder="请输入按钮文字"></input></p>' +
        '</div>'+
        '<form>'+
        '<button type="button" class="btn btn-s primary" id="anniu_ok">确定</button>'+
        '<button type="button" class="btn btn-s" id="anniu_cancel">取消</button>'+
        '</form>'+
        '</div>'+
        '</div>');
    });
    $(document).on('click','#anniu_ok',function() {
        myField = document.getElementById('text');
        var lianjie = $('.wmd-prompt-dialog input[name = "links"]').val();
        var name = $('.wmd-prompt-dialog input[name = "title"]').val();
        var obj_ty = document.getElementById("btn_type"); //定位id
        var index_ty = obj_ty.selectedIndex; // 选中索引
        var type = obj_ty.options[index_ty].value; // 选中值

        var obj_ty = document.getElementById("btn_state"); //定位id
        var index_ty = obj_ty.selectedIndex; // 选中索引
        var state = obj_ty.options[index_ty].value; // 选中值
        if (state!=""){
            state = ''+state+'';
        }
        var insertContent = "";
        if ($("#isCenter").is(':checked')){
            insertContent = '<p class="center"'+state+'>'+content+'</p>';
        }else{
            insertContent = '[button type="'+type+'" state="'+state+'" url="'+lianjie+'"]'+name+'[/button]';
        }

        inserContentToTextArea(myField,insertContent,'#anniu');

    });
    $(document).on('click','#anniu_cancel',function() {
        $('#anniu').remove();
        $('textarea').focus();
    });

    /* 边框按钮 */
    $(document).on('click', '#wmd-bkanniu-button', function() {
        $('body').append(
        '<div id="bkanniu">'+
        '<div class="wmd-prompt-background" style="position: fixed; top: 0px; z-index: 1000; opacity: 0.5; height: 100%; left: 0px; width: 100%;"></div>'+
        '<div class="wmd-prompt-dialog">'+
        '<div>'+
        '<p><b>插入按钮</b></p>'+
        '<p><labe>按钮颜色</labe></p>'+
        '<p><select id="btn_state" style="width: 100%"><option value="default">默认</option><option value="success">绿色</option><option value="warning">橙色</option><option value="secondary">灰色</option><option value="purple">紫色</option><option value="cyan">青色</option><option value="brown">棕色</option><option value="info">蓝色</option><option value="danger">红色</option><option value="dark">黑色</option><option value="pink">粉红色</option><option value="yellow">黄色</option></select></p>'+
        '<p><labe>按钮链接</labe><input name="links"' +
        ' type="text" placeholder="请输入按钮链接"></input></p>' +
        '<p><labe>按钮文字</labe><input name="title"' +
        ' type="text" placeholder="请输入按钮文字"></input></p>' +
        '</div>'+
        '<form>'+
        '<button type="button" class="btn btn-s primary" id="bkanniu_ok">确定</button>'+
        '<button type="button" class="btn btn-s" id="bkanniu_cancel">取消</button>'+
        '</form>'+
        '</div>'+
        '</div>');
    });
    $(document).on('click','#bkanniu_ok',function() {
        myField = document.getElementById('text');
        var lianjie = $('.wmd-prompt-dialog input[name = "links"]').val();
        var name = $('.wmd-prompt-dialog input[name = "title"]').val();
        var obj_ty = document.getElementById("btn_state"); //定位id
        var index_ty = obj_ty.selectedIndex; // 选中索引
        var state = obj_ty.options[index_ty].value; // 选中值
        if (state!=""){
            state = ''+state+'';
        }
        var insertContent = "";
        if ($("#isCenter").is(':checked')){
            insertContent = '<p class="center"'+state+'>'+content+'</p>';
        }else{
            insertContent = '[bkbutton state="'+state+'" url="'+lianjie+'"]'+name+'[/bkbutton]';
        }

        inserContentToTextArea(myField,insertContent,'#bkanniu');

    });
    $(document).on('click','#bkanniu_cancel',function() {
        $('#bkanniu').remove();
        $('textarea').focus();
    });

    /* 图标按钮 */
    $(document).on('click', '#wmd-Iconbtn-button', function() {
        $('body').append(
        '<div id="Iconbtn">'+
        '<div class="wmd-prompt-background" style="position: fixed; top: 0px; z-index: 1000; opacity: 0.5; height: 100%; left: 0px; width: 100%;"></div>'+
        '<div class="wmd-prompt-dialog">'+
        '<div>'+
        '<p><b>插入图标按钮</b></p>'+
        '<p><labe>按钮颜色</labe></p>'+
        '<p><select id="btn_state" style="width: 100%"><option value="default">默认</option><option value="success">绿色</option><option value="warning">橙色</option><option value="secondary">灰色</option><option value="purple">紫色</option><option value="cyan">青色</option><option value="brown">棕色</option><option value="info">蓝色</option><option value="danger">红色</option><option value="dark">黑色</option><option value="pink">粉红色</option><option value="yellow">黄色</option></select></p>'+
        '<p><labe>按钮链接</labe><input name="links"' +
        ' type="text" placeholder="请输入按钮链接"></input></p>' +
        '<p><labe>按钮图标 <a href="http://lyear.itshubao.com/iframe/v4/lyear_ui_icon.html" target="_blank">更多图标</a></labe><input name="mdi"' +
        ' type="text" placeholder="请输入按钮图标icon,例如mdi-emoticon-cool-outline"></input></p>' +
        '<p><labe>按钮文字</labe><input name="title"' +
        ' type="text" placeholder="请输入按钮文字"></input></p>' +
        '</div>'+
        '<form>'+
        '<button type="button" class="btn btn-s primary" id="Iconbtn_ok">确定</button>'+
        '<button type="button" class="btn btn-s" id="Iconbtn_cancel">取消</button>'+
        '</form>'+
        '</div>'+
        '</div>');
    });
    $(document).on('click','#Iconbtn_ok',function() {
        myField = document.getElementById('text');
        var lianjie = $('.wmd-prompt-dialog input[name = "links"]').val();
        var icon = $('.wmd-prompt-dialog input[name = "mdi"]').val();
        var name = $('.wmd-prompt-dialog input[name = "title"]').val();
        var obj_ty = document.getElementById("btn_state"); //定位id
        var index_ty = obj_ty.selectedIndex; // 选中索引
        var state = obj_ty.options[index_ty].value; // 选中值
        if (state!=""){
            state = ''+state+'';
        }
        var insertContent = "";
        if ($("#isCenter").is(':checked')){
            insertContent = '<p class="center"'+state+'>'+content+'</p>';
        }else{
            insertContent = '[Iconbtn state="'+state+'" url="'+lianjie+'" icon="'+icon+'"]'+name+'[/Iconbtn]';
        }

        inserContentToTextArea(myField,insertContent,'#Iconbtn');

    });
    $(document).on('click','#Iconbtn_cancel',function() {
        $('#Iconbtn').remove();
        $('textarea').focus();
    });

    /* 下载按钮 */
    $(document).on('click', '#wmd-Downloadbtn-button', function() {
        $('body').append(
        '<div id="Downloadbtn">'+
        '<div class="wmd-prompt-background" style="position: fixed; top: 0px; z-index: 1000; opacity: 0.5; height: 100%; left: 0px; width: 100%;"></div>'+
        '<div class="wmd-prompt-dialog">'+
        '<div>'+
        '<p><b>插入下载按钮</b></p>'+
        '<p><labe>按钮颜色</labe></p>'+
        '<p><select id="btn_state" style="width: 100%"><option value="default">默认</option><option value="success">绿色</option><option value="warning">橙色</option><option value="secondary">灰色</option><option value="purple">紫色</option><option value="cyan">青色</option><option value="brown">棕色</option><option value="info">蓝色</option><option value="danger">红色</option><option value="dark">黑色</option><option value="pink">粉红色</option><option value="yellow">黄色</option></select></p>'+
        '<p><labe>下载地址</labe><input name="links"' +
        ' type="text" placeholder="请输入下载链接"></input></p>' +
        '<p><labe>下载来源</labe><input name="title"' +
        ' type="text" placeholder="请输入下载来源"></input></p>' +
        '<p><labe>提取码</labe><input name="downpassword"' +
        ' type="text" placeholder="请输入提取码" value="| 提取码:"></input></p>' +
        '</div>'+
        '<form>'+
        '<button type="button" class="btn btn-s primary" id="Downloadbtn_ok">确定</button>'+
        '<button type="button" class="btn btn-s" id="Downloadbtn_cancel">取消</button>'+
        '</form>'+
        '</div>'+
        '</div>');
    });
    $(document).on('click','#Downloadbtn_ok',function() {
        myField = document.getElementById('text');
        var lianjie = $('.wmd-prompt-dialog input[name = "links"]').val();
        var name = $('.wmd-prompt-dialog input[name = "title"]').val();
        var downpassword = $('.wmd-prompt-dialog input[name = "downpassword"]').val();
        var obj_ty = document.getElementById("btn_state"); //定位id
        var index_ty = obj_ty.selectedIndex; // 选中索引
        var state = obj_ty.options[index_ty].value; // 选中值
        if (state!=""){
            state = ''+state+'';
        }
        var insertContent = "";
        if ($("#isCenter").is(':checked')){
            insertContent = '<p class="center"'+state+'>'+content+'</p>';
        }else{
            insertContent = '[Downloadbtn state="'+state+'" url="'+lianjie+'" downpassword="'+downpassword+'"]'+name+'[/Downloadbtn]';
        }

        inserContentToTextArea(myField,insertContent,'#Downloadbtn');

    });
    $(document).on('click','#Downloadbtn_cancel',function() {
        $('#Downloadbtn').remove();
        $('textarea').focus();
    });




});



//插入内容到编辑器
function inserContentToTextArea(myField,textContent,modelId) {
    $(modelId).remove();
    if (document.selection) {//IE浏览器
        myField.focus();
        var sel = document.selection.createRange();
        sel.text = textContent;
        myField.focus();
    } else if (myField.selectionStart || myField.selectionStart == '0') {
        //FireFox、Chrome
        var startPos = myField.selectionStart;
        var endPos = myField.selectionEnd;
        var cursorPos = startPos;
        myField.value = myField.value.substring(0, startPos)
            + textContent
            + myField.value.substring(endPos, myField.value.length);
        cursorPos += textContent.length;

        myField.selectionStart = cursorPos;
        myField.selectionEnd = cursorPos;
        myField.focus();
    }
    else{//其他环境
        myField.value += textContent;
        myField.focus();
    }

    //开启粘贴上传图片

}


$(document).ready(function(){
        
        var s = $("select[id*='article_type']").children('option:selected').val();
        
        $("input[id*='wymusic']").parent().parent().parent().hide();
        $("input[id*='video']").parent().parent().parent().hide();
        $("input[id*='photos_name']").parent().parent().parent().hide();
        $("input[id*='photos_excerpt']").parent().parent().parent().hide();
        $("input[id*='books_author']").parent().parent().parent().hide();
        $("input[id*='books_time']").parent().parent().parent().hide();
        $("input[id*='books_excerpt']").parent().parent().parent().hide();
        $("input[id*='books_reading']").parent().parent().parent().hide();
        $("input[id*='movies_author']").parent().parent().parent().hide();
        $("input[id*='movies_time']").parent().parent().parent().hide();
        $("input[id*='movies_excerpt']").parent().parent().parent().hide();
        $("input[id*='movies_score']").parent().parent().parent().hide();

        if(s == 'cross'){
            $("input[id*='wymusic']").parent().parent().parent().show();
            $("input[id*='video']").parent().parent().parent().show();
        }

        if(s == 'photos'){
            $("input[id*='photos_name']").parent().parent().parent().show();
            $("input[id*='photos_excerpt']").parent().parent().parent().show();
        }

        if(s == 'books'){
            $("input[id*='books_author']").parent().parent().parent().show();
            $("input[id*='books_time']").parent().parent().parent().show();
            $("input[id*='books_excerpt']").parent().parent().parent().show();
            $("input[id*='books_reading']").parent().parent().parent().show();
        }

        if(s == 'movies'){
            $("input[id*='movies_author']").parent().parent().parent().show();
            $("input[id*='movies_time']").parent().parent().parent().show();
            $("input[id*='movies_excerpt']").parent().parent().parent().show();
            $("input[id*='movies_score']").parent().parent().parent().show();
        }


        $("select[id*='article_type']").change(function(){
        var a=$(this).children('option:selected').val();

        if(a=='cross'){
            $("input[id*='wymusic']").parent().parent().parent().show();
            $("input[id*='video']").parent().parent().parent().show();
        }else{
            $("input[id*='wymusic']").parent().parent().parent().hide();
            $("input[id*='video']").parent().parent().parent().hide();
        }

        if(a=='photos'){
            $("input[id*='photos_name']").parent().parent().parent().show();
            $("input[id*='photos_excerpt']").parent().parent().parent().show();
        }else{
            $("input[id*='photos_name']").parent().parent().parent().hide();
            $("input[id*='photos_excerpt']").parent().parent().parent().hide();
        }

        if(a=='books'){
            $("input[id*='books_author']").parent().parent().parent().show();
            $("input[id*='books_time']").parent().parent().parent().show();
            $("input[id*='books_excerpt']").parent().parent().parent().show();
            $("input[id*='books_reading']").parent().parent().parent().show();
        }else{
            $("input[id*='books_author']").parent().parent().parent().hide();
            $("input[id*='books_time']").parent().parent().parent().hide();
            $("input[id*='books_excerpt']").parent().parent().parent().hide();
            $("input[id*='books_reading']").parent().parent().parent().hide();
        }

        if(a=='movies'){
            $("input[id*='movies_author']").parent().parent().parent().show();
            $("input[id*='movies_time']").parent().parent().parent().show();
            $("input[id*='movies_excerpt']").parent().parent().parent().show();
            $("input[id*='movies_score']").parent().parent().parent().show();
        }else{
            $("input[id*='movies_author']").parent().parent().parent().hide();
            $("input[id*='movies_time']").parent().parent().parent().hide();
            $("input[id*='movies_excerpt']").parent().parent().parent().hide();
            $("input[id*='movies_score']").parent().parent().parent().hide();
        }

    })
    
})
function playbtu(){
var oyd = document.getElementById('ydmc');
if (yaudio.paused) {
            yaudio.play();
           oyd.setAttribute("name","pause-one");
        } else {
            yaudio.pause();
            oyd.setAttribute("name","play-562moni6");
        }
}
function next() {
var oyd=document.getElementById('ydmc');
if (a == musicArr.length - 1) {
            a = 0
        } else {
            a = a + 1
        }
        var sj = musicArr[a];
        yaudio.src = sj.mp3;
        yaudio.play();var autopause=0;
       oyd.setAttribute("name","pause-one");
}

yaudio.addEventListener('ended',
function() {
    next();
},
false);

var wsUrl = "ws://127.0.0.1:9501";

var websocket = new WebSocket(wsUrl);

//实例对象的onopen属性
websocket.onopen = function(evt) {
    websocket.send("hello-Lichen");
    console.log("conected-swoole-success");
}

// 实例化 onmessage
websocket.onmessage = function(evt) {
    console.log("ws-server-return-data:" + evt.data)
    push(evt.data)
}

//onclose
websocket.onclose = function(evt) {
    console.log("close");
}
//onerror

websocket.onerror = function(evt, e) {
    console.log("error:" + evt.data);
}

function push(data){
    if(data){
        data = JSON.parse(data);
    }
    html = '<div class="frame">'
    html += '<h3 class="frame-header">'
    html += '<i class="icon iconfont icon-shijian"></i>第'+data.type+'节 '+data.time
    html += '</h3>'
    html += '<div class="frame-item">'
    html += '<span class="frame-dot"></span>'
    html += '<div class="frame-item-author">'
    if(data.logo){
        html += '<img src="'+data.logo+'" width="20px" height="20px" />'+data.title
    }
    html += '</div>'
    html += '<p>'+data.content+'</p>'
    html += '</div>'
    html += '</div>'

    $('#match-result').prepend(html)
}
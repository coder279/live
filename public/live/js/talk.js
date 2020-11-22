var wsUrl = "ws://127.0.0.1:9502";

var websocket = new WebSocket(wsUrl);

//实例对象的onopen属性
websocket.onopen = function(evt) {
    websocket.send("hello-Lichen");
    console.log("conected-swoole-success");
}

// 实例化 onmessage
websocket.onmessage = function(evt) {
//    console.log("ws-server-return-data:" + evt.data)
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

    data = JSON.parse(data);

    html = "<div class='comment'>"
    html+= "<span>"+data.user+": </span>"
    html+= "<span>"+data.content+"</span>"
    html+= "</div>"
    $('#comments').append(html)
}
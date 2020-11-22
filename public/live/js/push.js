$(function(){
    $('#discuss-box').keydown(function(event){
        console.log(event)
      if(event.keyCode == 13){
          var text = $(this).val();
          var url = "http://127.0.0.1:9501/?s=index/chart/index";
          var data = {'content':text,'game_id':1}
          $.post(url,data,function(){
            //todo
              $(this).val("")
          },'json')
      }
    })
})
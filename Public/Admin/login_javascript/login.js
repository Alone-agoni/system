$(function(){
    //得到焦点
    $("#password").focus(function(){
        $("#left_hand").animate({
            left: "150",
            top: " -38"
        },{step: function(){
            if(parseInt($("#left_hand").css("left"))>140){
                $("#left_hand").attr("class","left_hand");
            }
        }}, 2000);
        $("#right_hand").animate({
            right: "-64",
            top: "-38px"
        },{step: function(){
            if(parseInt($("#right_hand").css("right"))> -70){
                $("#right_hand").attr("class","right_hand");
            }
        }}, 2000);
    });
    //失去焦点
    $("#password").blur(function(){
        $("#left_hand").attr("class","initial_left_hand");
        $("#left_hand").attr("style","left:100px;top:-12px;");
        $("#right_hand").attr("class","initial_right_hand");
        $("#right_hand").attr("style","right:-112px;top:-12px");
    });
});

//ajax登录
function doLogin()
{
    var username = $("#username").val();
    var password = $("#password").val();
    if(username.length == 0)
    {
        alert('请输入用户名!!!');
        return false;
    }
    if(password.length == 0)
    {
        alert('请输入密码!!!');
        return false;
    }
    $.post(ajax_url,{u:username,p:password},function(data){
        alert(data.msg);
        if(data.status == 1)
        {
            location.href = jump_url;
        }else{
            $("#username").val("");
            $("#password").val("");
            $("#username").focus();
        }
    },'json');
}
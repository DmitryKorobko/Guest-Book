/**
 * Created by steinmann on 15.10.16.
 */
$(document).ready(function (){

    $("#button").click(function(){
        var user_name =$("#user_name").val();
        var email = $("#email").val();
        var home_page = $("#home_page").val();
        var message = $("#message").val();
        if(user_name==''){
            $("#user_name").attr("placeholder","Enter your name").addClass("input-error");
            return false;
        }else if(email==''){
            $("#email").attr("placeholder","Enter your email").addClass("input-error");
            return false;

        }else if(message==''){
            $("#message").attr("placeholder","Enter your message").addClass("input-error");
            return false;
        }

        //var myData = {user_name:user_name,email:email,home_page:home_page,message:message};
        //alert(user_name);
        //The post using ajax

        $.ajax({
            url:'http://guest-book.localhost/book/ajax',
            type:'POST',
            dataType: 'json',
            data:$("#book").serialize(),
            success: function(data){
                console.log("All right");
                console.debug(data);
                alert(data.message);
            },
            error: function(data) {
                console.log("Don't good");
                console.debug(data);
                alert(data.responseJSON.message);
            }

        });

    });
    $("input").click(function () {
        $(this).removeClass("input-error")
    })
});

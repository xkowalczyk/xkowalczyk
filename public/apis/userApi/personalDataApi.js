jQuery(document).ready(function() {
    $("#saveSettingsButton").click(function() {
        let user_name = $('input[name=user_name]').val();
        let user_lastname = $('input[name=user_lastname]').val();
        let user_login = $('input[name=user_login]').val();
        let user_id = $('input[name=user_id]').val();
        
        $.ajax({
            url:"http://xkowalczyk.pl/api",
            type: "POST",
            dataType: "JSON",
            data: {action: "editAccount", value: user_id , name: user_name, lastname: user_lastname, login: user_login},
            success:function(result){
                console.log(result);
            },
            error:function (result) { 
                console.log(result);
            }
            
        });
    });
});
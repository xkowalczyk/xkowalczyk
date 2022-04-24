function logout(){
    $.ajax({
        url:"http://xkowalczyk.pl/api",
        type: "POST",
        dataType: "JSON",
        data: {action: "userLogout", value: ''},
        success:function(result){
            console.log(result);
            location.reload();
        },
        error:function (result) { 
            console.log(result);
            location.reload();
        }
        
    });
}
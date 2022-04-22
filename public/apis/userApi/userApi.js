function logout(){
    $.ajax({
        url:"http://localhost/api",
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
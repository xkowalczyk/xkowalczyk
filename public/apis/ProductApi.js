function addToBin (itemid) {
    $.ajax({
        url:"http://localhost/api",
        type: "POST",
        dataType: "JSON",
        data: {action: "addItemToBin", value: itemid},
        success:function(result){
            console.log(result);
        }
    });
}
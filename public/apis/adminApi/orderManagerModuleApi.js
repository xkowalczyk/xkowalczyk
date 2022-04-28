function changeStatus(orderId, status){
    var status = $('#status-id').val();
    if (status == 0){
        return;
    }
    $.ajax({
        url:"http://xkowalczyk.pl/api/admin",
        type: "POST",
        dataType: "JSON",
        data: {action: "updateOrderStatus", value: orderId, status: status},
        success:function(result){
            console.log(result);
        },
        error:function (result) {
            console.log(result);
        }
    });
}

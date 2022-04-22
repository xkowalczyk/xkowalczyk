function addToBin (itemid) {
    $.ajax({
        url:"http://xkowalczyk.pl/api",
        type: "POST",
        dataType: "JSON",
        data: {action: "addItemToBin", value: itemid},
        success:function(result){
            if(result == "error-itemisset"){
                alert("Produkt jest już w koszyku");
            } else {
                alert("Dodano do koszyka");
            }
        },
        error:function (result) { 
            alert(result);
        }
        
    });
}

function dellBinItem (itemid) {
    $.ajax({
        url:"http://xkowalczyk.pl/api",
        type: "POST",
        dataType: "JSON",
        data: {action: "dellBinItem", value: itemid},
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



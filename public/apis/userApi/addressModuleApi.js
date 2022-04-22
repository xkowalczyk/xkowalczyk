jQuery(document).ready(function() {
    $("#saveSettingsButton").click(function() {
        let address_id = $('input[name=address_id]').val();
        let address_city = $('input[name=address_city]').val();
        let address_street = $('input[name=address_street]').val();
        let address_postcode = $('input[name=address_postcode]').val();
        let address_homenumber = $('input[name=address_homenumber]').val();
        
        $.ajax({
            url:"http://xkowalczyk.pl/api",
            type: "POST",
            dataType: "JSON",
            data: {action: "editAddress", value: address_id, city: address_city, street: address_street, homenumber: address_homenumber, postcode: address_postcode},
            success:function(result){
                console.log(result);
                location.href = "http://xkowalczyk.pl/account/address";
            },
            error:function (result) { 
                console.log(result);
                location.href = "http://xkowalczyk.pl/account/address";
            }  
        });
    });
    $("#addAddressButton").click(function() {
        let address_city = $('input[name=address_city]').val();
        let address_street = $('input[name=address_street]').val();
        let address_postcode = $('input[name=address_postcode]').val();
        let address_homenumber = $('input[name=address_homenumber]').val();
        let ordertoken = $('input[name=order_token]').val();
        let user_id = $('input[name=user_id]').val();
        
        $.ajax({
            url:"http://xkowalczyk.pl/api",
            type: "POST",
            dataType: "JSON",
            data: {action: "addAddress", value: user_id, city: address_city, street: address_street, homenumber: address_homenumber, postcode: address_postcode},
            success:function(result){
                console.log(result);
                if(ordertoken == null){
                    location.href = "http://xkowalczyk.pl/account/address";
                }
            },
            error:function (result) { 
                if(ordertoken == null){
                    location.href = "http://xkowalczyk.pl/account/address";
                }
            }  
        });
    });
});

function removeAddress (address_id) {
    $.ajax({
        url:"http://xkowalczyk.pl/api",
        type: "POST",
        dataType: "JSON",
        data: {action: "removeAddress", value: address_id},
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

jQuery(document).ready(function() {
    $("#saveUserPersonalSettingsButton").click(function() {
        let user_name = $('input[name=user_name]').val();
        let user_lastname = $('input[name=user_lastname]').val();
        let user_login = $('input[name=user_login]').val();
        let user_id = $('input[name=user_id]').val();
        let user_email = $('input[name=user_email]').val();

        $.ajax({
            url:"http://xkowalczyk.pl/api/admin",
            type: "POST",
            dataType: "JSON",
            data: {action: "editUserAccount", value: user_id , name: user_name, lastname: user_lastname, login: user_login, email: user_email},
            success:function(result){
                if (result == null)
                {
                    alert('Dane zostały zapisane');
                }
            },
            error:function (result) {
                console.log(result);
            }

        });
    });

    $("#saveUserAddressSettingsButton").click(function() {
        let address_id = $('input[name=address_id]').val();
        let address_city = $('input[name=address_city]').val();
        let address_street = $('input[name=address_street]').val();
        let address_postcode = $('input[name=address_postcode]').val();
        let address_homenumber = $('input[name=address_homenumber]').val();

        $.ajax({
            url:"http://xkowalczyk.pl/api",
            type: "POST",
            dataType: "JSON",
            data: {action: "editUserAddress", value: address_id, city: address_city, street: address_street, homenumber: address_homenumber, postcode: address_postcode},
            success:function(result){
                console.log(result);
                if (result == null)
                {
                    alert('Dany zostały zapisane');
                }
            },
            error:function (result) {
                console.log(result);
            }
        });
    });
});

function removeAddress (address_id) {
    $.ajax({
        url:"http://xkowalczyk.pl/api/admin",
        type: "POST",
        dataType: "JSON",
        data: {action: "removeUserAddress", value: address_id},
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

function addToBlackList(user_email)
{
    $.ajax({
        url:"http://xkowalczyk.pl/api/admin",
        type: "POST",
        dataType: "JSON",
        data: {action: "addUserToBlackList", value: user_email},
        success:function(result){
            if (result == 'user_isset'){
                alert('Użytkownik jest już na Black Liscie');
            } else {
                alert('Dodano do Black Listy');
            }
        },
        error:function (result) {
            console.log(result);
        }
    });
}

function removeUserBlackList(user_email)
{
    $.ajax({
        url:"http://xkowalczyk.pl/api/admin",
        type: "POST",
        dataType: "JSON",
        data: {action: "removeUserBlackList", value: user_email},
        success:function(result){
            console.log(result);
        },
        error:function (result) {
            console.log(result);
        }
    });
}

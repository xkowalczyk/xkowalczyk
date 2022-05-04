function removeCategory(category_id){
    $.ajax({
        url:"http://xkowalczyk.pl/api/admin",
        type: "POST",
        dataType: "JSON",
        data: {action: "removeCategory", value: category_id},
        success:function(result){
            console.log(result);
            location.reload();
        },
        error:function (result) {
            console.log(result);
        }
    });
}

function removeSubCategory(category_id){
    $.ajax({
        url:"http://xkowalczyk.pl/api/admin",
        type: "POST",
        dataType: "JSON",
        data: {action: "removeSubCategory", value: category_id},
        success:function(result){
            console.log(result);
            location.reload();
        },
        error:function (result) {
            console.log(result);
        }
    });
}

function addCategory()
{
    $.ajax({
        url:"http://xkowalczyk.pl/api/admin",
        type: "POST",
        dataType: "JSON",
        data: {action: "addCategory", value: ' ', category_name: $('input[name=addcategory_name]').val(), category_description: $('input[name=addcategory_description]').val()},
        success:function(result){
            console.log(result);
            location.reload();
        },
        error:function (result) {
            console.log(result);
        }
    });
}

function addSubCategory()
{
    $.ajax({
        url:"http://xkowalczyk.pl/api/admin",
        type: "POST",
        dataType: "JSON",
        data: {action: "addSubCategory", value: ' ', category_name: $('input[name=addsubcategory_name]').val(), category_description: $('input[name=addsubcategory_description]').val(), category_main: $('#maincategory').val()},
        success:function(result){
            console.log(result);
            location.reload();
        },
        error:function (result) {
            console.log(result);
        }
    });
}

function editCategory(category_id){
    $.ajax({
        url:"http://xkowalczyk.pl/api/admin",
        type: "POST",
        dataType: "JSON",
        data: {action: "removeCategory", value: category_id, category_name: $('#category_')},
        success:function(result){
            console.log(result);
            location.reload();
        },
        error:function (result) {
            console.log(result);
        }
    });
}



function saveStatute()
{
    var statute = $("textarea#statute").val();

    $.ajax({
        url:"http://xkowalczyk.pl/api/admin",
        type: "POST",
        dataType: "JSON",
        data: {action: "editStatute", value: statute},
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
}
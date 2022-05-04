function saveProductParameters(product_id)
{
    var formData = new FormData();
    var files = $('#product_photo')[0].files;

    if(files.length > 0 ) {
        formData.append('product_photo', files[0]);
    } else
    {
    }
    formData.append('action', 'editProductPhoto');
    formData.append('value', product_id);
    formData.append('product_name', $('input[name=product_name]').val());
    formData.append('product_description', $('#product_description').val());
    formData.append('product_price', $('input[name=product_price]').val());
    formData.append('product_category', $('#product_category').val());
    formData.append('product_subcategory', $('#product_subcategory').val());

    $.ajax({
        url: 'http://xkowalczyk.pl/api/admin',
        data: formData,
        type: 'POST',
        contentType: false,
        processData: false,
        success:function(result){
            console.log(result);
        },
        error:function (result) {
            console.log(result, "b");
        }
    })
}

function putNewProduct()
{
    var formData = new FormData();
    var files = $('#product_photo')[0].files;

    if(files.length <= 0 ) {
        alert("Dodaj plik .jpg")
    }

    formData.append('action', 'addProduct');
    formData.append('value', ' ');
    formData.append('product_photo', files[0]);
    formData.append('product_name', $('input[name=product_name]').val());
    formData.append('product_description', $('#product_description').val());
    formData.append('product_price', $('input[name=product_price]').val());
    formData.append('product_category', $('#product_category').val());
    formData.append('product_subcategory', $('#product_subcategory').val());

    $.ajax({
        url: 'http://xkowalczyk.pl/api/admin',
        data: formData,
        type: 'POST',
        contentType: false,
        processData: false,
        success:function(result){
            console.log(result);
        },
        error:function (result) {
            console.log(result, "b");
        }
    })
}
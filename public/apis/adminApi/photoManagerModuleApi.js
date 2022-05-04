function saveProductParameters(product_id)
{
    var formData = new FormData();
    var files = $('#product_photo')[0].files;

    if(files.length < 1 ) {
        alert("Zły plik");
        return;
    }
    formData.append('action', 'editProductPhoto');
    formData.append('value', 'testowy');
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
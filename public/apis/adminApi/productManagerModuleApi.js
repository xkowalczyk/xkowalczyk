function saveProductSetting(product_id)
{
    let product_name = $('input[name=product_name]').val();
    let product_description = $("#product_description").val();
    let product_price = $('input[name=product_price]').val();
    let product_category = $("#product_category").val();
    let product_subcategory = $("#product_subcategory").val();

    $.ajax({
        url:"http://xkowalczyk.pl/api/admin",
        type: "POST",
        dataType: "JSON",
        data: {action: "editProduct", value: product_id , name: product_name, description: product_description, price: product_price, category: product_category, subcategory: product_subcategory},
        success:function(result){
            console.log(result);
        },
        error:function (result) {
            console.log(result);
        }

    });
}

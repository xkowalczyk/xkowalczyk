<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script>
    function save()
    {
        var formData = new FormData();
        var files = $('#product_photo')[0].files;

        if(files.length < 1 ) {
            alert("Zły plik");
            return;
        }
        formData.append('action', 'editProductPhoto')
        formData.append('value', 'testowy')
        formData.append('file', files[0]);

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
</script>


    <input type="file" id="product_photo">
    <button class="submit" onclick="save()">z</button>



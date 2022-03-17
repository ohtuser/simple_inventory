<script>
    function setSubCategory(){
        $('.product_sub_category').html(`<option value="">Loading..</option>`);
        category = $('.product_category').val();
        let data = {category};
        customAjaxCall(function(res){
            console.log("sub category",res);
            subCatHtml = '';
            $.each(res.subcat, function(key,val){
                subCatHtml += `<option value="${val.id}">${val.name}</option>`;
            });
            $('.product_sub_category').html(subCatHtml).trigger('change');
        },'GET',"{{route('common.get_subcategory')}}", data);
    }
</script>

<script>
    async function setSubCategory(){
        $('.product_sub_category').html(`<option value="">Loading..</option>`);
        category = $('.product_category').val();
        let data = {category};
        await customAjaxCall(async function(res){
            console.log("sub category",res);
            subCatHtml = '';
            $.each(res.subcat, function(key,val){
                subCatHtml += `<option value="${val.id}">${val.name}</option>`;
            });
            $('.product_sub_category').html(subCatHtml).trigger('change');
            if(force_sub_category != undefined && force_sub_category != null){
                console.log("here");
                $('.product_sub_category').val(force_sub_category).change();
            }
        },'GET',"{{route('common.get_subcategory')}}", data);
    }


</script>

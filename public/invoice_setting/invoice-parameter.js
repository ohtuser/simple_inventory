$(document).ready(function(){
    $(".select2_tag").select2({
        tags: true,
        data: [],
        tokenSeparators: [','],
        closeOnSelect: false
    });
    $('.select_2').select2();
});


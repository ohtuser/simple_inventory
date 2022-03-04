<script>
    $(".form_submit").submit(function(e){
        // console.log("weewewe");
        e.preventDefault();
        var customConfig={
            enctype: 'multipart/form-data',
            processData: false,
            contentType: false,
        };
        var formData = new FormData(this);
        getLoadingStatus();
        customAjaxCall(function (res)
        {
            customSweetAlert(function(){
                if(res.redirectTo == 'close'){
                    closeSweetAlert();
                }
                else if(res.redirectTo == 'closeAndMOdalHide'){
                    closeSweetAlert();
                    $('.modal').modal('hide');
                }
                else if(res.redirectTo == 'reload'){
                    location.reload();
                }
                else{
                    window.location.href=res.redirectTo;
                }
            }, 'success',res.message,res.description,res.buttonShow,null,res.timer);
        },'POST',$(this).attr('action'),formData,customConfig);
    });

    function getLoadingStatus(title="Loading", html="Please Wait"){
        Swal.fire({
            title: title,
            html: html,
            didOpen: () => {
                Swal.showLoading()
            }
        })
    }

    function closeSweetAlert(){
        Swal.close();
    }

    function customSweetAlert(callback,icon='success', title='Added', html='Data Inserted Successfully',showConfirmButton=false,position='center',timer=null){
        Swal.fire({
            icon: icon,
            title: title,
            html: html,
            showConfirmButton: showConfirmButton,
            position: position,
            timer: timer,
        }).then(()=> {
            callback();
        });
    }

    async function customAjaxCall(callback, method, url, data,customConfig) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var defConfig={
            type: method,
            dataType: 'json',
            url: url,
            data: data,
            success: function (data) {
                callback(data);
            },
            error: function (jqXHR, textStatus, errorThrown) {
                callback(-1);
                if (jqXHR.status === 0) {
                    customSweetAlert(function(){
                        console.log(textStatus);
                    }, 'error', 'Oppps!', 'Not connect. Verify Network.',true,null,null);
                } else if (jqXHR.status == 404) {
                    customSweetAlert(function(){
                        console.log(textStatus);
                    }, 'error', 'Oppps!', 'Requested page not found.',true,null,null);
                } else if (jqXHR.status == 500) {
                    customSweetAlert(function(){
                        console.log(textStatus);
                    }, 'error', 'Oppps!', 'Internal Server Error.',true,null,null);
                }else if (jqXHR.status == 422) {
                    var object =  jqXHR.responseJSON.errors,
                    result = Object.keys(object).reduce(function (r, k) {
                        return r.concat(object[k]+'<br>');
                    }, []);
                    customSweetAlert(function(){
                        console.log(jqXHR);
                    }, 'error', 'Oppps!', result.join(""),true,null,null);

                } else if (jqXHR.status == 421) {
                    // console.log(jqXHR);
                    customSweetAlert(function(){
                        console.log(textStatus);
                    }, 'error', 'Oppps!', jqXHR.responseText,true,null,null);
                }else if (errorThrown === 'timeout') {
                    customSweetAlert(function(){
                        console.log(textStatus);
                    }, 'error', 'Oppps!', 'Time out error.',true,null,null);
                } else if (errorThrown === 'abort') {
                    customSweetAlert(function(){
                        console.log(textStatus);
                    }, 'error', 'Oppps!', 'Request aborted.',true,null,null);
                } else {
                    customSweetAlert(function(){
                        console.log(textStatus);
                        console.log(jqXHR);
                    }, 'error', 'Oppps!', 'Uncaught Error.',true,null,null);
                }
            }
        };
        if(typeof customConfig != 'undefined'){
            defConfig = Object.assign({}, defConfig, customConfig);
        }
        $.ajax(defConfig);
    }

    $(document).ready(function(){
        $('.select_2').select2();
    });
</script>

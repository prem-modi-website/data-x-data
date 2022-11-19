<script>
    
    function getProduct()
    {
        $.ajax({
       
            url : "{{ route('getProduct') }}",
            type : 'GET',
            dataType: "json",
            contentType: "application/json; charset=utf-8",
            success : function(result){
                $('#headerCart').html(result.html);
                
            },
            error : function(error)
            {
                console.log('error');
                console.log(error.responseJSON);
                console.log(error.status);
                if(error.status == 401){
                    Swal.fire({
                        title: 'You will need to login first',
                        showCancelButton: true,
                        confirmButtonColor: 'rgb(69 133 141)',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, login it!'
                        }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = "{{ route('customer-login') }}";
                        }
                    });
                }else
                {
                    Swal.fire({
                        title: error.responseJSON.message,
                        showCancelButton: true,
                        confirmButtonColor: 'rgb(69 133 141)',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Ok'
                    });
                }
                
            }
        });
    }
    $(document).on('click','.headCart',function(){
        getProduct();

    });

    $(document).on('click','.headercartRemove',function(){
        console.log($(this).attr('id'));
        var getId = $(this).attr('id').split('removeCart_')[1];
        var getQty = $('.parent_'+getId).remove();
        $.ajax({
       
            url : "{{ route('removeProduct') }}",
            data : {'id' : getId},
            type : 'GET',
            dataType: "json",
            contentType: "application/json; charset=utf-8",
            success : function(result){

                console.log("===== " + result.message + " =====");
                console.log(result.count);
                $('.cartTotal').html(`<i class="las la-rupee-sign"></i>`+result.count);

                getProduct();

            },
            error : function(error)
            {
                console.log('error');
                console.log(error.responseJSON);
                console.log(error.status);
                if(error.status == 401){
                    Swal.fire({
                        title: 'You will need to login first',
                        showCancelButton: true,
                        confirmButtonColor: 'rgb(69 133 141)',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, login it!'
                        }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = "{{ route('customer-login') }}";
                        }
                    });
                }else
                {
                    Swal.fire({
                        title: error.responseJSON.message,
                        showCancelButton: true,
                        confirmButtonColor: 'rgb(69 133 141)',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Ok'
                    });
                }
                
            }
        });
    });
</script>
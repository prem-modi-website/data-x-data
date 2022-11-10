@extends('master')
@section('content')
<div class="bg-dark">
                    <div class="container-fluid m-b-30">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-12 text-white p-t-40 p-b-90">
                                <h4 class="">
                                    Category List Dashboard
                                </h4>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 p-t-40 p-b-90">
                                <div class="row align-items-end justify-content-end">
                                    <div class="col-lg-3 col-md-4 col-sm-12">
                                        <button type="button" class="btn m-b-15 ml-2 mr-2 btn-dark w-75" data-toggle="modal" data-target=".add-category-list">Add Category</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="container-fluid pull-up">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="table-responsive p-t-10">
                                        <table id="example" class="table" style="width: 100%;">
                                            <thead>
                                                <tr>
                                                    <th>Sr.No.</th>
                                                    <th>Category Name</th>
                                                    <th>Category Image</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody id="catdata">
                                                
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
@endsection

@section('model')
        <!--Edit Conformation Modal Popup-->
            <div class="modal fade add-category-list" tabindex="-1" role="dialog" id="MyPopup" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="mySmallModalLabel">Add Data</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form method="post" id="submit_form">
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="inputcategory">Add Category</label>
                                    <input type="text" name="catName" class="form-control" id="catName" placeholder="Enter Category Name" />
                                    <p class="catNameError"></p>
                                </div>
                                <div class="form-group">
                                    <label for="inputcategory">Category Image</label>
                                    <input type="file" name="catImage" class="form-control" id="catImage" />
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                    Close
                                </button>
                                <input type="button" id="addCategory" class="btn btn-primary" value="Add Category">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        <!--Edit Conformation Modal Popup-->

        <div class="modal fade edit-category-list" tabindex="-1" role="dialog" id="MyPopupData" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="mySmallModalLabel">Edit Data</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form method="post" id="edit_form">
                            <div class="modal-body">
                                <div class="form-group">
                                    <input type="hidden" name="editcatid" class="form-control" id="editcatid">
                                    <label for="inputcategory">Add Category</label>
                                    <input type="text" name="editcatName" class="form-control" id="catNameEdit" placeholder="Enter Category Name" />
                                    <p class="catNameError"></p>
                                </div>
                                <div class="form-group">
                                    <label for="inputcategory">Category Image</label>
                                    <input type="file" name="editcatImage" class="form-control" id="catImageEdit"/>
                                </div>
                                <div class="form-group">
                                <p id="catImageshow"></p>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                    Close
                                </button>
                                <input type="button" id="editCategory" class="btn btn-primary" value="Edit Category">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
@endsection
@section('script')
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
        $(document).ready(function(){
            
            
            $('#editCategory').on('click',function(){
                var cateditForm = new FormData($('#edit_form')[0]);
                
                    $.ajaxSetup({
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                }
                    });
    
                    $.ajax({
                        url: "{{route('updatecategory')}}",
                        method:"post",
                        data:cateditForm,            
                        contentType:false,
                        processData:false,
                        success: function(result){
                            console.log(result);
                            if(result.status == 200)
                            {
                                $('#MyPopupData').modal("hide");
                                swal({
                                    title: "Category Update Successfully",
                                    icon: "success",
                                    button: "Ok"
                                });
                                getcategory();
                            }
                            else{
                                getcategory();
                                $('.catNameError').html(result.message);
                                $('.catNameError').css('color','red');
                            }
                        }
                    });
            });
            function getcategory()
            {
                $.ajax({
                    url: "{{route('getCategory')}}",
                    method:"get",
                    success: function(result){
                        if(result.status == 200)
                        {
                            $('#catdata').html("");
                            var count = 1;
                            $.each(result.data , function( key, value ) {
                               $('#catdata').append('<tr><td>'+count+'</td><td>'+value.name+'</td><td><img  width="80px"src="https://shop-site.online/demoxdata/public/images/'+value.image+'"></td><td><div class="btn-group"><button type="button" class="btn btn-sm ml-2 mr-2 p-1 pr-2 pl-2 btn-primary editcategory" id='+value.id+' data-toggle="modal" data-target=".edit-category-list"><i class="mdi mdi-pen"></i></button><button type="button" class="btn btn-sm ml-2 mr-2 p-1 pr-2 pl-2 btn-dark removeBtn" id='+value.id+' data-toggle="modal" data-target=".category-delete-conformation"><i class="mdi mdi-delete-forever"></i></button></div></td></tr>');
                                count++;
                            });
                        }
                        else{
                            $('#catdata').html('Data not found');
                        }
                    }
                });  
            }
            getcategory();

            $(document).on('click','.removeBtn',function(){
                 var deletebtn = $(this).attr('id');
                 deletedata(deletebtn);
            });

            $(document).on('click','.editcategory',function(){
                 var editbtn = $(this).attr('id');
                 editcategory(editbtn);
            });

            function editcategory(editbtn)
            {
                $.ajaxSetup({
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                }
                    });
                $.ajax({
                    url: "{{route('editCategory')}}",
                    method:"get",
                    data:{
                        "category_id":editbtn
                    }, 
                    success: function(result){
                        console.log(result.data);
                        $('#catNameEdit').val(result.data.name);
                        $('#editcatid').val(result.data.id);
                        $('#catImageshow').html('<img src="https://shop-site.online/demoxdata/public/images/'+result.data.image+'" width="120px">');
                    }
                });
            }

            $(document).on('change','#catImageEdit',function(){
                var main = $(this).files;
                console.log(main);
            })

            function deletedata(deletebtn)
            {
                $.ajaxSetup({
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                }
                    });
                $.ajax({
                    url: "{{route('deleteCategory')}}",
                    method:"post",
                    data:{
                        "category_id":deletebtn
                    }, 
                    success: function(result){
                        if(result.success == true)
                        {
                            swal({
                                title: "Category Deleted Successfully",
                                icon: "success",
                                button: "Ok"
                            });
                            getcategory();
                        }
                        else{
                            swal({
                                title: "Internal Server Error",
                                icon: "danger",
                                button: "Ok"
                            });
                            getcategory();
                        }
                    }
                }); 
            }

            $('#addCategory').on('click',function(){
                var name = $('#catName').val();

                if(name == "")
                {
                    $('.catNameError').html('category name is empty');
                    $('.catNameError').css('color','red');
                }
                else
                {
                    var main = new FormData($('#submit_form')[0]);
    
                    $.ajaxSetup({
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                }
                    });
    
                    $.ajax({
                        url: "{{route('storecategory')}}",
                        method:"post",
                        data:main,            
                        contentType:false,
                        processData:false,
                        success: function(result){
                            if(result.status == 200)
                            {
                                $('.catNameError').html("");
                                $('#MyPopup').modal("hide");
                                $('#catName').val("");
                                $('#catImage').val("");
                                swal({
                                    title: "Category Add Successfully",
                                    icon: "success",
                                    button: "Ok"
                                });
                                getcategory();
                            }
                            else{
                                $('.catNameError').html(result.message);
                                $('.catNameError').css('color','red');
                            }
                        }
                    });     
                }

            });
        });
    </script>
@endsection     
@extends('master')
@section('content')

                <div class="bg-dark">
                    <div class="container-fluid m-b-30">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-12 text-white p-t-40 p-b-90">
                                <h4 class="">
                                    Package List Dashboard
                                </h4>
                                <p class="opacity-75">
                                    Lorem ipsum dolor sit amet consectetur, adipisicing elit. Magnam aut officia voluptatum? Sed nihil
                                </p>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 p-t-40 p-b-90">
                                <div class="row align-items-end justify-content-end">
                                    <div class="col-lg-3 col-md-4 col-sm-12">
                                        <button type="button" class="btn m-b-15 ml-2 mr-2 btn-dark w-75" data-toggle="modal" data-target=".add-packge-list">Add Package</button>
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
                                                    <th>Package Amount</th>
                                                    <th>Package Count</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody class="tbody">
                                                
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
    <div class="modal fade add-packge-list" tabindex="-1" role="dialog" id="addmodalform" aria-labelledby="mySmallModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="mySmallModalLabel">Add Data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group category-list">
                            <label class="font-secondary">Category name</label>
                            <select class="form-control dataxdata-select2" name="packagename" id="packagename" disabled>
                              
                                    <option selected>All</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="inputcountdata">Package Count</label>
                            <input type="text" class="form-control" id="inputcountdata" placeholder="Enter Counte Number (10k)" />
                            <p class="counterror"></p>
                        </div>
                        <div class="form-group">
                            <label for="inputpackageamount">Package Amount</label>
                            <input type="text" class="form-control" id="inputpackageamount" placeholder="Enter Package Amount" />
                            <p class="amounterror"></p>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        Close
                    </button>
                    <button type="button" class="btn btn-primary addpackage">Add Package</button>
                </div>
            </div>
        </div>
    </div>
    <!--Edit Conformation Modal Popup-->


    <!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Edit Data</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form>
        <div class="form-group category-list">
            <label class="font-secondary">Category data</label>
            <select class="form-control dataxdata-select2" name="packagename" id="packagename1" disabled>
                
            </select>
        </div>
        <input type="hidden" class="form-control" id="inputpackageid" name="inputpackageid"/>
        <div class="form-group">
            <label for="inputcountdata">Package Count</label>
            <input type="text" class="form-control" id="inputcountdata1" placeholder="Enter Counte Number (10k)" />
            <p class="counterror"></p>
        </div>
        <div class="form-group">
            <label for="inputpackageamount">Package Amount</label>
            <input type="text" class="form-control" id="inputpackageamount1" placeholder="Enter Package Amount" />
            <p class="amounterror"></p>
        </div>
    </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="editpackage">Edit Package</button>
      </div>
    </div>
  </div>
</div>
    <!--Delete Conformation Modal Popup-->
    
    <!--Delete Conformation Modal Popup-->
@endsection
@section('script')
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
        $(document).ready(function(){

            $('#editpackage').on('click',function(){
                
                    var inputcountdata = $('#inputcountdata1').val();
                    var inputpackageamount = $('#inputpackageamount1').val();
                    var packagename = $('#packagename1').val();
                    var packageid = $('#inputpackageid').val();
                    console.log(packageid);
                    console.log(inputpackageamount);
                    console.log(inputcountdata);
                    $.ajaxSetup({
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                }
                    });
                    $.ajax({
                        url: "{{route('editpackagestore')}}",
                        method:"post",
                        data:{
                            "category":packagename,
                            "pacakge_count":inputcountdata,
                            "packge_amount":inputpackageamount,
                            "inputpackageid":packageid
                        }, 
                        success: function(result){
                            if(result.success == true)
                            {
                                swal({
                                    title: "Package updated Successfully",
                                    icon: "success",
                                    button: "Ok"
                                });
                                $('#exampleModalCenter').modal('hide');
                                data();
                               
                            }
                            else{
                                swal({
                                    title: "Package Not updated Successfully",
                                    icon: "success",
                                    button: "Ok"
                                });
                            }
                        }
                    });
            });
            function data()
            {
                $.ajax({
                    url: "{{route('getPackage')}}",
                    method:"get",
                    success: function(result){
                        if(result.success == true)
                        {
                            $('.tbody').html("");
                            var count = 1;
                            $.each(result.data, function( key, value ) {
                                $('.tbody').append('<tr><td>'+count+'</td><td>All</td><td>'+value.package_amount+'</td><td>'+value.package_count+'</td><td><div class="btn-group"><button type="button" class="btn btn-primary addpackagedata" id='+value.id+' data-toggle="modal" data-target="#exampleModalCenter"><i class="mdi mdi-pen"></i></button><button type="button" class="btn btn-sm ml-2 mr-2 p-1 pr-2 pl-2 btn-dark removepackagedata" id='+value.package_count+'_'+value.package_amount+' data-toggle="modal" data-target=".package-delete-conformation"><i class="mdi mdi-delete-forever"></i></button></div></td></tr>');
                                count++;
                            });
                        }
                        else{
                            $('.tbody').html("<p>Data Not Found</p>");
                        }
                    }
                }); 
            }
            data();
            $(document).on('click','.removepackagedata',function(){
                   var datadeleteid = $(this).attr('id');
                   
                  deletedata(datadeleteid);
            });
            $(document).on('click','.addpackagedata',function(){
                var dataaddid = $(this).attr('id');
                adddata(dataaddid); 
            });
            function adddata(dataaddid)
            {
                $.ajaxSetup({
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                }
                    });
                $.ajax({
                    url: "{{route('addsinglePackage')}}",
                    method:"post",
                    data:{
                        "package_id":dataaddid
                    }, 
                    success: function(result){
                        if(result.success == true)
                        {
                            console.log(result.data[0][0].name);
                            console.log(result.data[0][0].category_token);
                            $('#inputcountdata1').val(result.data[0][0].package_count);
                            $('#inputpackageamount1').val(result.data[0][0].package_amount);
                            $('#inputpackageid').val(result.data[0][0].category_token);
                            $('#packagename1').html("<option selected>All</option>");
                        }
                        else{
                        }
                    }
                }); 
            }
            function deletedata(datadeleteid)
            {
                console.log(datadeleteid);
                $.ajaxSetup({
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                }
                    });
                $.ajax({
                    url: "{{route('deletePackage')}}",
                    method:"post",
                    data:{
                        "package_id":datadeleteid
                    }, 
                    success: function(result){
                        if(result.success == true)
                        {
                            swal({
                                title: "Package Deleted Successfully",
                                icon: "success",
                                button: "Ok"
                            });
                            data();
                        }
                        else{
                            swal({
                                title: "Internal Server Error",
                                icon: "danger",
                                button: "Ok"
                            });
                            data();
                        }
                    }
                }); 
            }

            $('.addpackage').on('click',function(){
                var inputcountdata = $('#inputcountdata').val();
                var inputpackageamount = $('#inputpackageamount').val();
                var packagename = $('#packagename').val();

                var inputcountflag = true;
                var inputpackageflag = true;
                if(inputcountdata == "")
                {
                    inputcountflag = false;
                    $('.counterror').html('Package count is empty');
                    $('.counterror').css('color','red');
                }
                else
                {
                    $('.counterror').html("");
                }

                
                if(inputpackageamount == "")
                {
                    inputpackageflag = false;
                    $('.amounterror').html('Package amount is empty');
                    $('.amounterror').css('color','red');
                }
                else
                {
                    $('.amounterror').html("");
                }

                if(inputcountflag == true && inputpackageflag == true)
                {
                    $.ajaxSetup({
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                }
                    });
                    $.ajax({
                        url: "{{route('packageStore')}}",
                        method:"post",
                        data:{
                            "category":packagename,
                            "pacakge_count":inputcountdata,
                            "packge_amount":inputpackageamount
                        }, 
                        success: function(result){
                            if(result.success == true)
                            {
                                $('#inputcountdata').val("");
                                $('#inputpackageamount').val("");
                                swal({
                                    title: "Package Add Successfully",
                                    icon: "success",
                                    button: "Ok"
                                });
                                $('#addmodalform').modal('hide');
                                data();
                               
                            }
                            else{
                                alert("data not save");
                            }
                        }
                    });
                }
            });
        });
    </script>
@endsection
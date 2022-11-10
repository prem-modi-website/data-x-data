@extends('master')
@section('content')
<div class="bg-dark">
                    <div class="container-fluid m-b-30">
                        <div class="row">
                            <div class="col-lg-4 col-md-12 col-sm-12 text-white p-t-40 p-b-90">
                                <h4 class="">
                                    All Excel Data
                                </h4>
                            </div>
                            <form  method="post" action="{{route('excelexportdata')}}" enctype="multipart/form-data">
                                @csrf
                                <div class="col-lg-8 col-md-12 col-sm-12 text-white p-t-40 p-b-90">
                                <div class="row align-items-end justify-content-end">
                                    <div class="col-lg-3 col-md-4 col-sm-12">
                                        <div class="form-group category-list">
                                            <label class="font-secondary">Category </label>
                                            <select class="form-control dataxdata-select2" name="catname">
                                                @foreach($category as $singlecategory)
                                                    <option value="{{$singlecategory->id}}">{{$singlecategory->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-4 col-sm-12 pr-0">
                                        <p class="font-secondary mb-1">File Uploads</p>
                                        <div class="input-group mb-3">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" name="excelfile" id="inputGroupFile02" />
                                                <label class="custom-file-label" for="inputGroupFile02">Choose file</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-4 col-sm-12">
                                        <button type="submit" class="btn m-b-15 ml-2 mr-2 btn-dark w-75">Submit</button>
                                    </div>
                                </div>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="container-fluid pull-up">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="table-responsive p-t-10">
                                        <table id="datatableform" class="table" style="width: 100%;">
                                            <thead>
                                                <tr>
                                                    <th>Sr.No.</th>
                                                    <th>Mobile Number</th>
                                                    <th>Category</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $count=1; ?>
                                                @foreach($emptydata as $singledata)
                                                <tr>
                                                    <td>{{$count++}}</td>
                                                    <td>{{$singledata["contact_number"]}}</td>
                                                    <td>{{$singledata["name"]}}</td>
                                                    <td>
                                                        <div class="btn-group">
                                                            <button type="button" class="btn btn-sm ml-2 mr-2 p-1 pr-2 pl-2 btn-primary" data-toggle="modal" data-target=".data-edit-conformation"><i class="mdi mdi-pen"></i></button>
                                                            <button type="button" class="btn btn-sm ml-2 mr-2 p-1 pr-2 pl-2 btn-dark" data-toggle="modal" data-target=".data-delete-conformation">
                                                                <i class="mdi mdi-delete-forever"></i>
                                                            </button>
                                                        </div>
                                                    </td>
                                                </tr>
                                                @endforeach
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
        <div class="modal fade data-edit-conformation" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="mySmallModalLabel">Edit Data</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="form-group">
                                <label for="inputMobileNumber">Mobile Number</label>
                                <input type="text" class="form-control" id="inputMobileNumber" placeholder="Enter Mobile Number" />
                            </div>
                            <div class="form-group category-list">
                                <label class="font-secondary">Category </label>
                                <select class="form-control dataxdata-select2">
                                    @foreach($category as $singlecategory)
                                        <option value="{{$singlecategory->id}}">{{$singlecategory->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                            Close
                        </button>
                        <button type="button" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </div>
        </div>
        <!--Edit Conformation Modal Popup-->
        <!--Delete Conformation Modal Popup-->
        <div class="modal fade data-delete-conformation" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="mySmallModalLabel">Conformation</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- <h3>Conformation</h3> -->
                        <p>
                            Lorem ipsum dolor sit amet, consecte ure non perspiciatis qui veniam vitae!
                        </p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                            Close
                        </button>
                        <button type="button" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </div>
        </div>
        <!--Delete Conformation Modal Popup-->
@endsection
@section('script')
<script src="assets/js/DataTables/datatables.min.js"></script>
<!--page specific scripts for demo-->
<script src="assets/js/datatable-data.js"></script>
<!--Custom JS-->
<script src="assets/js/select2/js/select2.full.min.js"></script>
<!--page specific scripts for demo-->
<script src="assets/js/DataTables/dataTables.buttons.min.js"></script>
<script src="assets/js/DataTables/buttons.html5.min.js"></script>
<script src="assets/js/DataTables/jszip.min.js"></script>
<script>
    $(document).ready(function() {
        $('#datatableform').DataTable( {
            dom: 'Bfrtip',
            buttons: [
                'csv', 'excel',
            ]
        } );
    } );
</script>
@endsection
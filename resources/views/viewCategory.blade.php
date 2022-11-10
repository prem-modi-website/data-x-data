@extends('master')
@section('content')
<div class="bg-dark">
                    <div class="container-fluid m-b-30">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-12 text-white p-t-40 p-b-90">
                                <h4 class="">
                                    View Category
                                </h4>
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
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $count= 1 ?>
                                                @foreach($category as $singlecategory)
                                                     <tr>
                                                        <td>{{$count++}}</td>
                                                        <td>{{$singlecategory->name}}</td>
                                                        <td><img src="https://shop-site.online/demoxdata/public/images/{{$singlecategory->image}}" width="120px"></td>
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

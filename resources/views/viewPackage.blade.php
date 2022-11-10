@extends('master')
@section('content')

                <div class="bg-dark">
                    <div class="container-fluid m-b-30">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-12 text-white p-t-40 p-b-90">
                                <h4 class="">
                                    All Package List
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
                                                    <th>Package Amount</th>
                                                    <th>Package Count</th>
                                                </tr>
                                            </thead>
                                            <tbody class="tbody">
                                                <?php $count=1; ?>
                                                @foreach($packagedata as $singlepackage)
                                                     <tr>
                                                        <td>{{$count++}}</th>
                                                        <td>All</td>
                                                        <td>{{$singlepackage->package_amount}}</th>
                                                        <td>{{$singlepackage->package_count}}</th>
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
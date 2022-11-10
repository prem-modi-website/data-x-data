<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Hello, world!</title>
  </head>
  <body>
    <h3>Search Records</h3>
    <input type="text" name="vinnumber" id="vinnumber">
    <input type="submit" value="Search" id="search" class="btn btn-danger">
    <a href="{{route('excel',Request::get('vin'))}}"><input type="submit" value="Create Excel" class="btn btn-primary"></a>

<br><br>
    <table class="table">
    <thead>
        <tr>
        <th scope="col">Id</th>
        <th scope="col">Vin</th>
        <th scope="col">Reg No</th>
        <th scope="col">Phone No.</th>
        </tr>
    </thead>
    <tbody>
        @foreach($data as $singledata)
        <tr>
        <th scope="row">1</th>
        <td>{{$singledata->vin}}</td>
        <td>{{$singledata->regNo}}</td>
        <td>{{$singledata->phone}}</td>
        </tr>
        @endforeach
    </tbody>
</table>
<script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
    <script>
        $(document).ready(function(){
            $("#search").on('click',function(){
                var vinnumber = $('#vinnumber').val();
                
                var url = "{{route('data')}}?vin="+vinnumber;

                window.location.href = url;

            });        
        });
    </script>
</html>
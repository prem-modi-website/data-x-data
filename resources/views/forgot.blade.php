<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>forgot-password</title>
  </head>
  <body>
      
<form method="post" action="{{route('forgotstore')}}">
    @csrf
    <div class="container">
  <div class="row">
      
    <h5>Forgot-Password</h5>
    <br>
    <label for="inputEmail3">Email</label>
    </br>
    <div class="form-group col-4">
      <input type="email"  class="form-control col-md-4" id="inputEmail3" placeholder="enter your email" name="email">
    </div>
    <br>
    
  <button type="submit" class="btn btn-primary col-md-2">forgot-password</button>
  </div>
  </div>
</form>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

  </body>
</html>
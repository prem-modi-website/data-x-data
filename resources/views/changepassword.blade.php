<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Change-Password</title>
  </head>
  <body>
<form method="post" action="{{route('changepass',['token'=>Request::get('token')])}}">
    @csrf
    <div class="container">
  <div class="row">
      
    <h5>Change-Password</h5>
    <br>
    <label for="inputEmail3">password</label>
    <br>
    <div class="form-group col-12">
      <input type="password"  class="form-control col-md-4 inputEmail3" id="inputEmail3" placeholder="enter your password" name="password">
    </div>
    <p class="paerror"></p>
    <br>
    <label for="inputEmail3">confirm password</label>
    </br>
    <div class="form-group col-12">
      <input type="password"  class="form-control col-md-4 inputEmail4" id="inputEmail4" placeholder="enter your confirm password" name="confirmpassword">
    </div>
    <p class="conerror"></p>

    <br>
        <br>
  <button type="submit" class="btn btn-primary col-md-4 subbtn">Save</button>
  </div>
  </div>
</form>
      
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function(){
            var inputEmail3 = $('.inputEmail3').val();
            var inputEmail4 = $('.inputEmail4').val();
            
            var input1 = true;
            var input2 = true;
            var data = true;
            $('.inputEmail3').on('keyup',function(){
                                
                var regex = /\s*/g;
                    if($(this).val().match(regex)){
                console.log("KKKK");
                console.log($(this).val().replace(regex,''));
                $(this).val( $(this).val().replace(regex,'') );
                    }
                    if($('.inputEmail3').val() == "")
                    {
                        var input1 = false;
                        $('.paerror').html("password is empty");
                        $('.paerror').css("color","red");
                    }
                    else
                    {
                        $('.paerror').html("");
                        f1();         
                    }
            });
            
            $('.inputEmail4').on('keyup',function(){

                
                var regex = /\s*/g;
                if($(this).val().match(regex)){
                console.log("KKKK");
                console.log($(this).val().replace(regex,''));
                $(this).val( $(this).val().replace(regex,'') );
                }
                if($('.inputEmail4').val() == "")
                 {
                    var input2 = false;
                     $('.conerror').html("confirm password is empty");
                    $('.conerror').css("color","red");
                 }
                 else
                 {
                    $('.conerror').html("");
                     f1();         
                 }
            });
            function f1()
            {
                 if($('.inputEmail3').val().trim() == $('.inputEmail4').val().trim())      
                 {  
                     data = true;
                     $('.conerror').html("");                   
                     console.log("ssss");
                    }
                    else
                    {
                     data = false;
                    $('.conerror').html("password and confirm password not match");
                    $('.conerror').css("color","red");

                 }
            }
            
            $('.subbtn').on('click',function(){
                if($('.inputEmail3').val() == "" && $('.inputEmail4').val() == "")      
                {
                    $('.paerror').html("password is empty");
                    $('.conerror').html("confirm password is empty");
                    $('.conerror').css("color","red");
                    $('.paerror').css("color","red");
                        return false;
                }
                else if(input1 == true && input2 == true && data == true)
                {
                    return true;
                }
                else
                {
                    return false;
                }
            });
        });
    </script>
  </body>
</html>
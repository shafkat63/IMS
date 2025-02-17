@extends('layout.public')
@section('content')
<div class="container-xxl">
    <div class="authentication-wrapper authentication-basic container-p-y">
      <div class="authentication-inner">
        <!-- Register -->
        <div class="card UserLogin">
          <div class="card-body">
            <!-- Logo -->
            <div class="app-brand justify-content-center">
              <a href="index.html" class="app-brand-link gap-2">
                <span class="app-brand-text demo text-body">Indent Management System</span>
              </a>
            </div>
            <!-- /Logo -->
            <h4 class="mb-2">Welcome to IMS! 👋</h4>

            <form id="formAuthentication" class="mb-3" action="#" method="POST">@csrf
              <div class="mb-3">
                <label for="email" class="form-label">Email or Username</label>
                <input type="text" class="form-control" id="email" name="email" placeholder="Enter your email or username" autofocus/>
              </div>
              <div class="mb-3 form-password-toggle">
                <div class="d-flex justify-content-between">
                  <label class="form-label" for="password">Password</label>
                </div>
                <div class="input-group input-group-merge">
                  <input type="password" id="password" class="form-control" name="password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="password"/>
                  <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                </div>
              </div>
              {{--<div class="mb-3">
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" id="remember-me" />
                  <label class="form-check-label" for="remember-me"> Remember Me </label>
                </div>
              </div>--}}
              <div class="mb-3">
                <button class="btn btn-primary d-grid w-100" type="button" onclick="checkLogin()">Sign in</button>
              </div>
            </form>

          </div>
        </div>
        <!-- /Register -->
      </div>
    </div>
  </div>
@endsection

<script>
  $(document).ready(function () {
    $("#email, #password").keypress(function (event) {
        if (event.which == 13) { // 13 is the Enter key
            checkLogin();
        }
    });
});

    function checkLogin() {
        var UseId  = $("#email").val();
        var UseUser  = $("#password").val();
        if (UseId!=''){
            if (UseUser!=''){
                loginNow();
            } else{
                swal({
                    text: "Enter Your Password Here !!",
                    icon: "error",
                    timer: '3000'
                });
            }
        } else{
            swal({
                text: "Enter Your Email Here !!",
                icon: "error",
                timer: '3000'
            });
        }

    }

    function loginNow() {
        url = "{{ url('requestLogin') }}";
        $.ajax({
            url: url,
            type: "POST",
            data: new FormData($(".UserLogin form")[0]),
            contentType: false,
            processData: false,
            success: function (data) {
                console.log(data);
                var dataResult = JSON.parse(data);
                if (dataResult.statusCode == 200) {
                    window.location.href = dataResult.route;
                    $('.UserLogin form')[0].reset();
                } else if (dataResult.statusCode == 201) {
                    swal({
                        text: "Login Failed",
                        icon: "error",
                        timer: '1500'
                    });
                }
            }, error: function (data) {
                swal({
                    title: "Oops",
                    text: "Error occured",
                    icon: "error",
                    timer: '1500'
                });
            }
        });
        return false;


    };
</script>

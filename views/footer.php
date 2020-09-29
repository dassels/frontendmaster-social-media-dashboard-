<footer class="footer mt-auto py-3">
  <div class="container">
    <span class="text-muted">Copyright 2020</span>
  </div>
</footer>
  
  
  
  
  
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
  


        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="loginTitle">Login Form</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger" id="loginAlert"></div>
                <form>
                    <input type="hidden" id="loginActive" name="loginActive" value="1">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Email address</label>
                        <input type="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="email">
                        <small id="emailHelp" class="form-text text-muted">Enter your email</small>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Password</label>
                        <input type="password" class="form-control" id="password">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <a id="toggleLogin">Sign Up</a>
                <button type="button" id="loginSignupButton"class="btn btn-primary">Login</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
            </div>
        </div>
        </div>

        <script>

            // This script toggles login and signup versions of form via Jquery then sends as ajax call. Make sure button type is 'button'

            $("#toggleLogin").click(function() {

                if ($("#loginActive").val() == "1") {

                    $("#loginActive").val("0");
                    $("#loginTitle").html("Sign Up Form");
                    $("#loginSignupButton").html("Sign Up");
                    $("#toggleLogin").html("Login");

                } else {

                    $("#loginActive").val("1");
                    $("#loginTitle").html("Login Form");
                    $("#loginSignupButton").html("Login");
                    $("#toggleLogin").html("Sign Up");

                }



            })

            $("#loginSignupButton").click(function() {

                $.ajax({
                    type: "POST",
                    //dataType : "html",
                    //contentType: "application/json; charset=utf-8",
                    url: "actions.php?action=loginSignup",
                    data: "email=" + $("#email").val()+ "&password=" + $("#password").val() + "&loginActive=" + $("#loginActive").val(),
                    success: function(result) {

                        if (result == "") {
                            //alert(result);
                            //alert("EMPTY");
                            window.location.assign("index.php");

                        } else if (result != "") {

                            console.log(result);
                            $("#loginAlert").html(result).show();
                            //window.location.assign("index.php");
                        }

                    }

                })

            })

        </script>


    </body>
</html>
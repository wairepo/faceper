@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard<i class="fas fa-ad"></i></div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                </div>
            </div>
        </div>
    </div>
</div>
<fb:login-button class="fb-login-button" data-size="medium" data-button-type="continue_with" data-layout="default" data-auto-logout-link="true" data-use-continue-as="true" data-width="" scope="public_profile,email"
                     onlogin="checkLoginState();">
    </fb:login-button>

<div id="status"></div>
<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_GB/sdk.js#xfbml=1&autoLogAppEvents=1&version=v7.0&appId=716571212447026"></script>
@endsection


<script>

  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "https://connect.facebook.net/en_US/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));


  window.fbAsyncInit = function() {
    FB.init({
      appId      : '{{$_ENV["FB_APP_ID"]}}',
      cookie     : true,
      xfbml      : true,
      version    : 'v7.0'
    });
      
    FB.AppEvents.logPageView();   

    FB.getLoginStatus(function(response) {
        console.log(response)
        statusChangeCallback(response);
    });

    function statusChangeCallback(response) {
        console.log('statusChangeCallback');
        console.log(response);
        // The response object is returned with a status field that lets the
        // app know the current login status of the person.
        // Full docs on the response object can be found in the documentation
        // for FB.getLoginStatus().
        if (response.status === 'connected') {
            // Logged into your app and Facebook.
            console.log('Welcome!  Fetching your information.... ');
            FB.api('/me', function (response) {
                console.log(response)
                console.log('Successful login for: ' + response.name);
                document.getElementById('status').innerHTML =
                  'Thanks for logging in, ' + response.name + '!';
            });
        } else {
            // The person is not logged into your app or we are unable to tell.
            document.getElementById('status').innerHTML = 'Please log ' +
              'into this app.';
        }
    }

  };


function checkLoginState() {
        FB.getLoginStatus(function(response) {
            statusChangeCallback(response);
        });
    }

</script>

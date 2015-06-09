// Facebook
// This is called with the results from from FB.getLoginStatus().
function statusChangeCallback(response) {
    if (response.status === 'connected') {
      // Logged into your app and Facebook.
      enviarDatos();
    }
}

// This function is called when someone finishes with the Login
// Button.  See the onlogin handler attached to it in the sample
// code below.
function checkLoginState() {
    FB.getLoginStatus(function(response) {
      statusChangeCallback(response);
    });
}

window.fbAsyncInit = function() {
    FB.init({
    appId      : '1114829315199633',
    cookie     : true,  // enable cookies to allow the server to access 
                        // the session
    xfbml      : true,  // parse social plugins on this page
    version    : 'v2.2' // use version 2.2
});
};

// Load the SDK asynchronously
(function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = "//connect.facebook.net/en_US/sdk.js";
    fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));

// Here we run a very simple test of the Graph API after login is
// successful.  See statusChangeCallback() for when this call is made.
function enviarDatos() {
    FB.api('/me', function(response) {
        // Colocar los datos del usuario en el formulario y enviar el formulario
        $('#socialNombre').val(response.first_name);
        $('#socialApellidos').val(response.last_name);
        $('#socialId').val(response.id);
        if(response.email){
            $('#socialEmail').val(response.email);
        }
        $('#formularioRedes').submit();
    });
}
// Google

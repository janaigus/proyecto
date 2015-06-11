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
    js.src = "//connect.facebook.net/es_LA/sdk.js";
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

(function() {
   var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
   po.src = 'https://apis.google.com/js/client:plusone.js';
   var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
 })();

// Gestionar la llamada de callback al intentar iniciar sesion con google+
function signinCallback(authResult) {
    if (authResult['access_token']) {
        // Evitar el inicio de sesion automatico con el valor(PROMPT) de la propiedad "METHOD"
        if(authResult['status']['method'] == "PROMPT"){
            gapi.auth.setToken(authResult);
            gapi.client.load('oauth2', 'v2', function() {
              var request = gapi.client.oauth2.userinfo.get();
              request.execute(enviarDatosGoogle);
            });
        }
    }
}

function enviarDatosGoogle(response){
    // Colocar los datos del usuario en el formulario y enviar el formulario
        $('#socialNombre').val(response.given_name);
        $('#socialApellidos').val(response.family_name);
        $('#socialId').val(response.id);
        if(response.email){
            $('#socialEmail').val(response.email);
        }
        $('#formularioRedes').submit();
}
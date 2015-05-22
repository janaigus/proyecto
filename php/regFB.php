<?php
	//INCLUIMOS LAS LIBRERIAS DE FB
	require_once( 'lib/Facebook/FacebookSession.php');
	require_once( 'lib/Facebook/FacebookRequest.php' );
	require_once( 'lib/Facebook/FacebookResponse.php' );
	require_once( 'lib/Facebook/FacebookSDKException.php' );
	require_once( 'lib/Facebook/FacebookRequestException.php' );
	require_once( 'lib/Facebook/FacebookRedirectLoginHelper.php');
	require_once( 'lib/Facebook/FacebookAuthorizationException.php' );
	require_once( 'lib/Facebook/GraphObject.php' );
	require_once( 'lib/Facebook/GraphUser.php' );
	require_once( 'lib/Facebook/GraphSessionInfo.php' );
	require_once( 'lib/Facebook/Entities/AccessToken.php');
	require_once( 'lib/Facebook/HttpClients/FacebookCurl.php' );
	require_once( 'lib/Facebook/HttpClients/FacebookHttpable.php');
	require_once( 'lib/Facebook/HttpClients/FacebookCurlHttpClient.php');

	use Facebook\FacebookSession;
	use Facebook\FacebookRedirectLoginHelper;
	use Facebook\FacebookRequest;
	use Facebook\FacebookResponse;
	use Facebook\FacebookSDKException;
	use Facebook\FacebookRequestException;
	use Facebook\FacebookAuthorizationException;
	use Facebook\GraphObject;
	use Facebook\GraphUser;
	use Facebook\GraphSessionInfo;
	use Facebook\FacebookHttpable;
	use Facebook\FacebookCurlHttpClient;
	use Facebook\FacebookCurl;

	
	//INICIAMOS LA SESSION
	 session_start();

	//COMPROBAMOS SI EL USUARIO QUIERE CERRAR
	 if(isset($_REQUEST['logout'])){
	 	session_start();
	 	$_SESSION=array();
	 	session_destroy();
	 	header('Location: ./index.php');
	 }
	
	//CREAMOS LAS VARIABLES CON LOS DATOS QUE NOS DA LA WEB DE FB DEVELOPERS
	$app_id = '619275001551926';
	$app_secret = 'b6ff9dc1c622a8834a26bafaa1550f4a';
	$redirect_url='http://rmwebconsulting.com/apps/loginFB/';

	//INICIALIZAMOS LA APLICACION, PARA ELLO CREAMOS EL OBJ HELPER Y OBTENEMOS LA VARIABLE SESSION
	 FacebookSession::setDefaultApplication($app_id,$app_secret);
	 $helper = new FacebookRedirectLoginHelper($redirect_url);
	 $sess = $helper->getSessionFromRedirect();

	 //COMPROBAMOS SI NO EXISTE LA VARIABLE SESSION
	if(isset($_SESSION['fb_token'])){
		$sess = new FacebookSession($_SESSION['fb_token']);
		try{
			$sess->Validate($app_id, $app_secret);
		}catch(FacebookAuthorizationException $e){
			print_r($e);
		}
	}

	$loggedin = false;
	$login_url = $helper->getLoginUrl(array('email'));

	//lCERRAMOS SESION
	$logout = 'http://rmwebconsulting.com/apps/loginFB/index.php?logout=true';

	//SI LA VARIABLE SESSION EXISTE MOSTRAMOS EL NOMBRE
 	if(isset($sess)){
 		$_SESSION['fb_token']=$sess->getToken();
 		$request = new FacebookRequest($sess,'GET','/me');
		$response = $request->execute();
		$graph = $response->getGraphObject(GraphUser::classname());
		// USAMOS EL OBJ GRAPH PA MOSTRAR EL NOMBRE EL EMAIL Y LA FOTOD EL USUARIO
		$id = $graph->getId();
		$name= $graph->getName();
		$image = 'https://graph.facebook.com/'.$id.'/picture?width=300';
		$loggedin  = true;
	}
	
?>
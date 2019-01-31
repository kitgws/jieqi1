<?php

require_once ("OpenSDK/OAuth2/Client.php");
require_once ("OpenSDK/OAuth/Interface.php");

class OpenSDK_Weixin_SNS2 extends OpenSDK_OAuth_Interface
{
	const ACCESS_TOKEN = "tensns2_access_token";
	const REFRESH_TOKEN = "tensns2_refresh_token";
	const EXPIRES_IN = "tensns2_expires_in";
	const SCOPE = "tensns2_scope";
	const OPENID = "tensns2_openid";

	/**
     * app key
     * @var string
     */
	static 	protected $client_id = "";
	/**
     * app secret
     * @var string
     */
	static 	protected $client_secret = "";
	/**
     * OAuth ¶ÔÏó
     * @var OpenSDK_OAuth_Client
     */
	static 	private $oauth;
	static 	private $accessTokenURL = "https://api.weixin.qq.com/sns/oauth2/access_token";
	static 	private $authorizeURL = "https://open.weixin.qq.com/connect/qrconnect";
	static 	private $openidURL = "https://api.weixin.qq.com/sns/userinfo";
	/**
     * OAuth °æ±¾
     * @var string
     */
	static 	protected $version = "2.0";
	static 	protected $_debug = false;

	static public function init($appkey, $appsecret)
	{
		self::$client_id = $appkey;
		self::$client_secret = $appsecret;
	}

	static public function getAuthorizeURL($url, $response_type, $state, $display = "default", $scope = "")
	{
		$params = array();
		$params["appid"] = self::$client_id;
		$params["redirect_uri"] = $url;
		$params["response_type"] = $response_type;
		$params["scope"] = $display;
		$params["state"] = $state;
		$scope && ($params["scope"] = $scope);
		return self::$authorizeURL . "?" . http_build_query($params)."#wechat_redirect";
	}

	static public function getAccessToken($type, $keys)
	{
		$params = array();
		$params["client_id"] = self::$client_id;
		$params["client_secret"] = self::$client_secret;

		if ($type === "token") {
			$params["grant_type"] = "refresh_token";
			$params["refresh_token"] = $keys["refresh_token"];
		}
		else if ($type === "code") {
			$params["grant_type"] = "authorization_code";
			$params["code"] = $keys["code"];
			$params["redirect_uri"] = $keys["redirect_uri"];
		}
		else if ($type === "password") {
			$params["grant_type"] = "password";
			$params["username"] = $keys["username"];
			$params["password"] = $keys["password"];
		}
		else {
			exit("wrong auth type");
		}

		$response = self::request(self::$accessTokenURL, "POST", $params);

		if (substr($response, 0, 9) == "callback(") {
			$json = substr($response, 10, -3);
			$token = OpenSDK_Util::json_decode($json, true);
		}
		else {
			parse_str($response, $token);
		}

		if (is_array($token) && !isset($token["error"])) {
			self::setParam(self::ACCESS_TOKEN, $token["access_token"]);
			self::setParam(self::REFRESH_TOKEN, $token["refresh_token"]);
			self::setParam(self::EXPIRES_IN, $token["expires_in"]);
			self::getOpenID();
		}
		else {
			exit("get access token failed." . $token["error"]);
		}

		return $token;
	}

	static protected function getOpenID()
	{
		$response = self::request(self::$openidURL, "GET", array("access_token" => self::getParam(self::ACCESS_TOKEN)));
		$json = substr($response, 10, -3);
		$token = OpenSDK_Util::json_decode($json, true);

		if ($token["openid"]) {
			self::setParam(self::OPENID, $token["openid"]);
		}
	}

	static public function call($command, $params = array(), $method = "GET", $multi = false, $decode = true, $format = "json")
	{
		if ($format == self::RETURN_XML) {
		}
		else {
			$format == self::RETURN_JSON;
		}

		foreach ($params as $key => $val ) {
			if (strlen($val) == 0) {
				unset($params[$key]);
			}
		}

		$params["access_token"] = self::getParam(self::ACCESS_TOKEN);
		$params["oauth_consumer_key"] = self::$client_id;
		$params["openid"] = self::getParam(self::OPENID);
		$params["format"] = $format;
		$response = self::request("https://graph.qq.com/" . ltrim($command, "/"), $method, $params, $multi);

		if ($decode) {
			if ($format == self::RETURN_JSON) {
				return OpenSDK_Util::json_decode($response, true);
			}
			else {
				return $response;
			}
		}
		else {
			return $response;
		}
	}

	static public function debug($debug = false)
	{
		self::$_debug = $debug;
	}

	static protected function getOAuth()
	{
		if (NULL === self::$oauth) {
			self::$oauth = new OpenSDK_OAuth2_Client(self::$_debug);
		}

		return self::$oauth;
	}

	static protected function request($url, $method, $params, $multi = false)
	{
		if (!self::$client_id || !self::$client_secret) {
			exit("app key or app secret not init");
		}

		return self::getOAuth()->request($url, $method, $params, $multi);
	}
}



?>

<?php
namespace SteamApi;

use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ServerException;
use SteamApi\Exceptions\ApiArgumentRequiredException;
use SteamApi\Exceptions\ApiCallFailedException;

class Client {
	protected $url = "http://api.steampowered.com/";
	protected $interface;
	protected $method;
	protected $version      = 'v0002';
	protected $apiKey;
	protected $apiFormat    = 'json';
	protected $steamId;
	protected $isService    = false;

	public    $validFormats = array('json', 'xml', 'vdf');

	public function __construct($steamApiKey = null){
		if(!$steamApiKey){
			throw new \InvalidArgumentException("A SteamAPI Key is required");
		}
		$this->client = new GuzzleClient();
		$this->apiKey = $steamApiKey;
	}

	public function getApiKey(){
		return $this->apiKey;
	}

	public function buildUrl($version = false)
	{
		$url = $this->url;
		if ($this->interface) {
			$url .= $this->interface . '/';
		}

		if ($this->method){
			$url .= $this->method . '/';
		} 

		if ($version) {
			return $url . $this->version . '/';
		}

		return $url;
	}

	 public function setUpService($arguments = null){
		if ($arguments == null) {
			throw new ApiArgumentRequiredException();
		}

		$parameters = [
			'key'        => $this->apiKey,
			'format'     => $this->apiFormat,
			'input_json' => $arguments,
		];

		$steamUrl = $this->buildUrl(true);

		$parameters = http_build_query($parameters);

		try{
			$response  = $this->client->get($steamUrl . '?' . $parameters);
			$response = $this->prepareResponse($response);
		} catch (ClientException $e) {
			throw new ApiCallFailedException($e->getMessage(), $e->getResponse()->getStatusCode(), $e);
		}
		catch (ServerException $e) {
			throw new ApiCallFailedException('Api call failed to complete due to a server error.', $e->getResponse()->getStatusCode(), $e);

		} catch (Exception $e) {
			throw new ApiCallFailedException($e->getMessage(), $e->getCode(), $e);
		}

		return $response->body;
	}

	public function setUpClient(array $arguments = array()){
		$versionFlag = ! is_null($this->version);
		$steamUrl    = $this->buildUrl($versionFlag);

		$parameters = [
			'key'    => $this->apiKey,
			'format' => $this->apiFormat
		];

		if (! empty($arguments)) {
			$parameters = array_merge($parameters, $arguments);
		}

		$parameters = http_build_query($parameters);

		try {
			$response  = $this->client->get($steamUrl . '?' . $parameters);
			$response = $this->prepareResponse($response);
		} catch (ClientException $e) {
			throw new ApiCallFailedException($e->getMessage(), $e->getResponse()->getStatusCode(), $e);
		}
		catch (ServerException $e) {
			throw new ApiCallFailedException('Api call failed to complete due to a server error.', $e->getResponse()->getStatusCode(), $e);

		} catch (Exception $e) {
			throw new ApiCallFailedException($e->getMessage(), $e->getCode(), $e);
		}

		return $response->body;
	}

	public function prepareResponse($response)
	{
		try {
			$result       = new \stdClass();
			$result->code = $response->getStatusCode();
			$result->body = json_decode($response->getBody());

		} catch (ClientException $e) {
			throw new ApiCallFailedException($e->getMessage(), $e->getResponse()->getStatusCode(), $e);

		} catch (ServerException $e) {
			throw new ApiCallFailedException('Api call failed to complete due to a server error.', $e->getResponse()->getStatusCode(), $e);

		} catch (Exception $e) {
			throw new ApiCallFailedException($e->getMessage(), $e->getCode(), $e);
		}

		return $result;
	}
}
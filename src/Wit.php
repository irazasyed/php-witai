<?php

namespace Irazasyed\Wit;

use GuzzleHttp\Client;
use GuzzleHttp\Promise;
use GuzzleHttp\Promise\PromiseInterface;
use GuzzleHttp\RequestOptions as GuzzleRequestOptions;

/**
 * Class Wit.
 */
class Wit
{
    /**
     * Version number of the Library.
     */
    const VERSION = '0.1.0';

    /**
     * Wit.ai API Base URI.
     */
    const WIT_API_BASE_URI = 'https://api.wit.ai/';

    /**
     * Text Intent API Endpoint.
     */
    const TEXT_INTENT_API = 'message';

    /**
     * Speech Intent API Endpoint.
     */
    const SPEECH_INTENT_API = 'speech';

    /**
     * Entities API Endpoint.
     */
    const ENTITIES_API = 'entities';

    /*
     * Wit.ai API Version
     */
    const WIT_API_VERSION = '20160215';

    /**
     * HTTP Request Default Timeout.
     */
    const DEFAULT_TIMEOUT = 5;

    /**
     * @var HTTP Client
     */
    protected $client;

    /**
     * @var string Access Token of your App from Wit.ai
     */
    protected $access_token;

    /**
     * @var bool Indicates if the request to Telegram will be asynchronous (non-blocking).
     */
    protected $isAsyncRequest = false;

    /**
     * @var array HTTP Request Headers.
     */
    protected $headers = [];

    /**
     * @var PromiseInterface[]
     */
    protected $promises = [];

    /**
     * @var Get Last Response for promises.
     */
    protected $lastResponse;

    /**
     * Wit constructor.
     *
     * @param      $access_token
     * @param bool $isAsyncRequest
     * @param null $httpClient
     */
    public function __construct($access_token, $isAsyncRequest = false, $httpClient = null)
    {
        $this->access_token = $access_token;
        $this->isAsyncRequest = $isAsyncRequest;
        $this->client = $httpClient ?: new Client([
            'base_uri'        => self::WIT_API_BASE_URI,
            'timeout'         => self::DEFAULT_TIMEOUT,
            'connect_timeout' => self::DEFAULT_TIMEOUT,
        ]);
    }

    /**
     * Check if this is an asynchronous request (non-blocking).
     *
     * @return bool
     */
    public function isAsyncRequests()
    {
        return $this->isAsyncRequest;
    }

    /**
     * Make HTTP Requests Non-Blocking (Async).
     *
     * @param $isAsyncRequest
     *
     * @return $this
     */
    public function setAsyncRequests($isAsyncRequest)
    {
        $this->isAsyncRequest = $isAsyncRequest;

        return $this;
    }

    /**
     * Get HTTP Headers.
     *
     * @return array
     */
    public function getHeaders()
    {
        return $this->headers;
    }

    /**
     * Set HTTP Headers.
     *
     * @param array $headers
     *
     * @return $this
     */
    public function setHeaders($headers = [])
    {
        $this->headers = $headers;

        return $this;
    }

    /**
     * Get Last HTTP Request Response.
     *
     * @return object
     */
    public function getLastResponse()
    {
        return $this->lastResponse;
    }

    /**
     * Get Intent from Text Query!
     *
     * @param       $q
     * @param array $params
     *
     * @return \GuzzleHttp\Promise\PromiseInterface|mixed
     */
    public function getIntentByText($q, $params = [])
    {
        $query = array_merge(compact('q'), $params);

        return $this->makeRequest('GET', self::TEXT_INTENT_API, $query);
    }

    /**
     * Get Intent from Speech (Audio).
     *
     * @param       $q
     * @param array $params
     *
     * @return \GuzzleHttp\Promise\PromiseInterface|mixed
     */
    public function getIntentBySpeech($q, $params = [])
    {
        //        $this->setHeaders(['Content-type' => 'audio/wav']);
//
//        $query = array_merge(compact('q'), $params);
//
//        return $this->makeRequest('POST', self::SPEECH_INTENT_API, $query);
    }

    /**
     * Make HTTP Request.
     *
     * @param       $method
     * @param       $uri
     * @param array $query
     *
     * @return \GuzzleHttp\Promise\PromiseInterface|mixed
     */
    protected function makeRequest($method, $uri, $query = [])
    {
        $options[GuzzleRequestOptions::QUERY] = $query;
        $options[GuzzleRequestOptions::HEADERS] = $this->getDefaultHeaders();

        if ($this->isAsyncRequest) {
            return $this->promises[] = $this->client->requestAsync($method, $uri, $options);
        }

        $this->lastResponse = $this->client->request($method, $uri, $options);

        return json_decode($this->lastResponse->getBody(), true);
    }

    /**
     * Get Default Headers for HTTP Requests.
     *
     * @return array
     */
    protected function getDefaultHeaders()
    {
        return array_merge([
            'User-Agent'    => 'php-witai-'.self::VERSION,
            'Authorization' => 'Bearer '.$this->access_token,
            'Accept'        => 'application/vnd.wit.'.self::WIT_API_VERSION.'+json',
        ], $this->headers);
    }

    /**
     * Unwrap Promises.
     */
    public function __destruct()
    {
        Promise\unwrap($this->promises);
    }
}

<?php

namespace App\Libraries;

use Cache;
use Exception;
use GuzzleHttp\Client;
use Illuminate\Pagination\LengthAwarePaginator;

class JsonPlaceholderApi
{

    /**
     * Store last items fetched from api.
     *
     * @var array
     */
    protected $items;

    /**
     * Store http client.
     *
     * @var GuzzleHttp\Client
     */
    protected $client;

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => 'http://jsonplaceholder.typicode.com/'
        ]);
    }

    /**
     * Fetch a resource.
     *
     * @param  string  $resource
     * @return JsonPlaceholderApi
     */
    public function get($resource)
    {
        $response = $this->apiRequest($resource, 'GET');
        $this->items = $response;
        return $this;
    }

   /**
    * Fetch a resource by id.
    *
    * @param  string  $resource
    * @param  int     $id
    * @return array
    */
    public function getById($resource, $id)
    {
        return $this->apiRequest("$resource/$id", 'GET');
    }


   /**
    * Make an API request.
    *
    * @param  string  $resource
    * @param  string  $method
    * @return array
    */
    protected function apiRequest($resource, $method = 'GET')
    {
        if (Cache::has($resource)) {
            return Cache::get($resource);
        }
        // Make a GET request to fetch the requested resource.
        $response = $this->client->request($method, $resource);
        if ($response->getStatusCode() !== 200) {
            throw new Exception('Http request has failed.');
        }
        // Decode json response.
        $result = json_decode($response->getBody(), true);
        // Cache it!
        Cache::put($resource, $result, 1);
        return $result;
    }

   /**
    * A getter for the items property.
    *
    * @return array
    */
    public function getItems()
    {
        return $this->items;
    }

    /**
     * Create a length aware custom paginator instance.
     *
     * @param  Collection  $items
     * @param  int         $perPage
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function paginate($perPage = 10)
    {
        // Make sure we have items to paginate.
        if (!$this->items) {
            throw new Exception('No items to paginate.');
        }

        // Get current page form url e.g. &page=1
        $currentPage = LengthAwarePaginator::resolveCurrentPage();

        // Slice the collection to get the items to display in current page
        $currentPageItems = array_slice($this->items, ($currentPage - 1) * $perPage, $perPage);
        
        // Create our paginator and pass it to the view
        return new LengthAwarePaginator($currentPageItems, count($this->items), $perPage);
    }
}

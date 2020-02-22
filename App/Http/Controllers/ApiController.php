<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class ApiController extends Controller
{
    // This API Controller is to consume Third-Party APIs
    public function index(Request $request)
    {
        $client = new Client();
        $user = $request->user();
    	$response = $client->request('GET', 'https://jsonplaceholder.typicode.com/todos/1');
    	$statusCode = $response->getStatusCode();
    	$body = $response->getBody()->getContents();

        echo highlight_string("<?php\n\$user =\n" . var_export($user, true) . ";\n?>");
    }
    /**
     * What we did here is:
     * use GuzzleHttp\Client: import Guzzle Client. 
     * new Client();  Create a new instance of guzzle client
     * Next, call request() method. I have passed two parameters. First is GET for making get request and the second parameter is URL.
     * getStatusCode(): Get the HTTP status code.
     * getBody()->getContents() is used to return the contents.
     */

}

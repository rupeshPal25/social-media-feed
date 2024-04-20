<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class SocialMediaFeedController extends Controller
{
    //
    public function index()
    {
        try {
            // Fetch posts
            $client = new Client();
            $response = $client->request('GET', 'https://jsonplaceholder.typicode.com/posts?_limit=10');
            $posts = json_decode($response->getBody(), true);

            // Fetch comments for each post
            foreach ($posts as &$post) {
                try {
                    $response = $client->request('GET', 'https://jsonplaceholder.typicode.com/comments?postId=' . $post['id']);
                    $post['comments'] = json_decode($response->getBody(), true);
                } catch (RequestException $e) {
                    // Handle API request error
                    $post['comments'] = []; // Assign an empty array for comments
                }
            }

            return view('social-media-feed', compact('posts'));
        } catch (RequestException $e) {
            // Handle API request error
            $posts = []; // Assign an empty array for posts
            return view('social-media-feed', compact('posts'));
        }
    }
}

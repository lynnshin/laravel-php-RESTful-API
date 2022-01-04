<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function welcome(){
        $json = json_decode(file_get_contents('https://api.quotable.io/random'), true);
        $content = (string)$json['content'];
        $author = ' — ' . (string)$json['author'];

        return view('welcome', ['content'=> $content, 'author'=> $author]);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    public function store(Post $post)
    {
        $post->users()->syncWithoutDetaching(Auth::id());
        
        return redirect()->route('post.index');
    }



    public function destroy(Post $post)
    {
        $post->users()->detach(Auth::id());

        return redirect()->route('post.index');
    }
}

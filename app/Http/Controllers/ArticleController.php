<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function index()
    {
        $users = User::all();
        $articles = Article::all();
        return view('articles.index', compact('articles'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('articles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'image' => 'required|image',
            'body' => 'required',



        ]);
//        $path = $request->file('image')->store('articles', 'public_uploads');


        Article::create([
            'title' => $request->title,
            'description' => $request->description,
            'image' => $request->file('image')->store('articles', 'public_uploads'),
            'body' => $request->body,
            'user_id' => auth()->user()->id,


        ]);


        return redirect()->route('article.index');

    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $article = Article::findOrFail($id);


        return view('articles.view', compact('article'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Article $article)
    {
        if (auth()->user()->id == $article->user_id) {

            return view('articles.edit', compact('article'));
        } else {
            return redirect()->route('article.index')->withErrors('you don\'t have permission to access that');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Article $article)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'body' => 'required',
            'image' => 'image',

        ]);

        if ($request->image) {

            Storage::disk('public_uploads')->delete($article->image);
            $article->image = $request->file('image')->store('articles', 'public_uploads');

        }



        $article->title = $request->title;
        $article->description = $request->description;
        $article->body = $request->body;
        $article->save();


        return redirect()->route('article.index');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article)
    {


        if (auth()->user()->id == $article->user_id) {
            if(file_exists(public_path() . '/uploads/' . $article->image)) {
                Storage::disk('public_uploads')->delete($article->image);
            }
            $article->delete();
            return redirect()->route('article.index');
        } else {
            return redirect()->route('article.index')->withErrors('you don\'t have permission to access that');
        }
    }
}

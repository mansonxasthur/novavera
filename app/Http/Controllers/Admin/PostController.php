<?php

namespace App\Http\Controllers\Admin;

use App\Facades\Logger;
use App\Http\Controllers\Controller;
use App\Post;
use App\Tag;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        return view('admin.post.index')->with(['posts' => Post::all()]);
    }

    public function create()
    {
        return view('admin.post.create')->with([
            'tags' => Tag::all(),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'tags' => 'required',
            'body' => 'required',
            'translation.title' => 'required',
            'translation.body' => 'required',
            'featured_image' => 'required|image|mimes:png,jpg,jpeg,webp,svg|max:5000'
        ]);

        try {
            $post = Post::installation($request);

            $post->addTranslation([
                'title' => $request->translation['title'],
                'body' => $request->translation['body'],
            ]);

            $tags = json_decode($request->tags);
            if (!empty($tags)){
                if (is_object($tags[0])) {
                    $tags = collect($tags)->map(function($type) {
                        return $type->id;
                    });
                }

                $post->tags()->sync($tags);
            }

            return response()->json(['message' => 'Success'], 201);
        } catch (\Exception $e) {
            Logger::error($e);
            return response()->json(['message' => 'Failure'], 500);
        }

    }

    public function edit(Post $post)
    {
        return view('admin.post.edit')->with([
            'tags' => Tag::all(),
            'post' => $post
        ]);
    }

    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title' => 'required',
            'tags' => 'required',
            'body' => 'required',
            'translation.title' => 'required',
            'translation.body' => 'required',
        ]);

        try {
            if ($post->updateInstallation($request)) {
                $post->updateTranslation([
                    'title' => $request->arabicTitle,
                    'body' => $request->arabicBody,
                ]);

                $tags = json_decode($request->tags);
                if (!empty($tags)){
                    if (is_object($tags[0])) {
                        $tags = collect($tags)->map(function($type) {
                            return $type->id;
                        });
                    }

                    $post->tags()->sync($tags);
                }
            }

            return response()->json(['message' => 'Success', 'slug' => $post->slug], 200);
        } catch (\Exception $e) {
            Logger::error($e);
            return response()->json(['message' => 'Failure'], 500);
        }

    }

    public function togglePublish(Post $post, Request $request)
    {
        $request->validate(['publish' => 'required']);

        try {
            $post->update(['published' => $request->publish]);

            $message = $request->publish ? 'Published successfully!' : 'Post unpublished!';
            return response()->json(['message' => $message], 200);
        } catch (\Exception $e) {
            Logger::error($e);
            return response()->json(['message' => 'Failure'], 500);
        }
    }

    public function destroy(Post $post)
    {
        try {
            $post->delete();
            return response()->json([], 204);
        } catch (\Exception $e) {
            Logger::error($e);
            return response()->json(['message' => 'Failure'], 500);
        }
    }
}

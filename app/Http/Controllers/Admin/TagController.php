<?php

namespace App\Http\Controllers\Admin;

use App\Facades\Logger;
use App\Http\Controllers\Controller;
use App\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function index() {
        return view('admin.tag.index', ['tags' => Tag::all()]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'translation.name' => 'required',
        ]);

        try {
            $tag = Tag::create(['name' => $request->name]);

            $tag->addTranslation([
                'name' => $request->translation['name'],
            ]);

            return response()->json(['message' => 'Success', 'data' => $tag->load('translation')], 201);
        } catch (\Exception $e) {
            Logger::error($e);
            return response()->json(['message' => 'Failure'], 500);
        }
    }

    public function update(Request $request, Tag $tag)
    {
        $request->validate([
            'name' => 'required',
            'translation.name' => 'required',
        ]);

        try {
            $tag->update(['name' => $request->name]);
            $tag->updateTranslation([
                'name' => $request->translation['name'],
            ]);

            return response()->json(['message' => 'Success', 'data' => $tag->load('translation')], 200);
        } catch (\Exception $e) {
            Logger::error($e);
            return response()->json(['message' => 'Failure'], 500);
        }
    }

    public function destroy(Tag $tag)
    {
        try {
            $tag->delete();
            return response()->json([], 204);
        } catch (\Exception $e) {
            Logger::error($e);
            return response()->json(['message' => 'Failure'], 500);
        }
    }
}

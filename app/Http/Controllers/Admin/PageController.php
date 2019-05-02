<?php

namespace App\Http\Controllers\Admin;

use App\Facades\Logger;
use App\Http\Controllers\Controller;
use App\Page;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index()
    {
        return view('admin.page.index')->with(['pages' => Page::all()]);
    }

    public function create()
    {
        return view('admin.page.create');
    }

    public function store(Request $request, Page $page)
    {
        $request->validate([
            'title' => 'required',
            'arabicTitle' => 'required',
            'body' => 'required',
            'arabicBody' => 'required',
            'header' => 'required|image|mimes:png,jpg,jpeg,webp,svg|max:5000'
        ]);

        try {
            $page->title = $request->title;
            $page->slug = $request->title;
            $page->body = $request->body;
            $page->meta = $request->meta;
            $page->keywords = $request->keywords;
            $page->style = $request->style;
            if ($request->hasFile('header')) {
                $page->header = $page->uploadImage($request->header);
            }
            $page->save();

            $page->addTranslation([
                'title' => $request->arabicTitle,
                'body' => $request->arabicBody,
            ]);

            return response()->json(['message' => 'Success'], 201);
        } catch (\Exception $e) {
            Logger::error($e);
            return response()->json(['message' => 'Failure'], 500);
        }

    }

    public function edit(Page $page)
    {
        return view('admin.page.edit')->with([
            'page' => $page
        ]);
    }

    public function update(Request $request, Page $page)
    {
        $request->validate([
            'title' => 'required',
            'arabicTitle' => 'required',
            'body' => 'required',
            'arabicBody' => 'required',
        ]);

        try {
            $page->title = $request->title;
            $page->slug = $request->title;
            $page->body = $request->body;
            $page->meta = $request->meta;
            $page->keywords = $request->keywords;
            $page->style = $request->style;
            if ($request->hasFile('header')) {
                $page->header = $page->updateImage($request->header, $page->header);
            }
            $page->save();
            $page->updateTranslation([
                'title' => $request->arabicTitle,
                'body' => $request->arabicBody,
            ]);

            return response()->json(['message' => 'Success'], 200);
        } catch (\Exception $e) {
            Logger::error($e);
            return response()->json(['message' => 'Failure'], 500);
        }

    }

    public function togglePublish(Page $page, Request $request)
    {
        $request->validate(['publish' => 'required']);

        try {
            $page->update(['published' => $request->publish]);

            $message = $request->publish ? 'Published successfully!' : 'Page unpublished!';

            return response()->json(['message' => $message], 200);
        } catch (\Exception $e) {
            Logger::error($e);
            return response()->json(['message' => 'Failure'], 500);
        }
    }

    public function destroy(Page $page)
    {
        try {
            $page->delete();
            return response()->json([], 204);
        } catch (\Exception $e) {
            Logger::error($e);
            return response()->json(['message' => 'Failure'], 500);
        }
    }
}

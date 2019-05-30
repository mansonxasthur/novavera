<?php

namespace App\Http\Controllers\Admin;

use App\Citizenship;
use App\CitizenshipBenefit;
use App\CitizenshipSection;
use App\CitizenshipSupply;
use App\Facades\Logger;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CitizenshipController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.citizenship.index')->with([
            'citizenships' => Citizenship::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.citizenship.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'country_name'             => 'required | string',
            'title'                    => 'required | string',
            'description'              => 'required | string',
            'snippet'                  => 'required | string',
            'type'                     => 'required | string',
            'translation.country_name' => 'required | string',
            'translation.title'        => 'required | string',
            'translation.description'  => 'required | string',
            'header'                   => 'required | image | mimes:jpg,jpeg,png,webp,svg',
            'dropdown_flag'            => 'required | image | mimes:jpg,jpeg,png,webp,svg',
            'body_flag'                => 'required | image | mimes:jpg,jpeg,png,webp,svg',
        ]);

        try {
            $citizenship = new Citizenship();
            $citizenship->country_name = $request->country_name;
            $citizenship->slug = $request->country_name;
            $citizenship->title = $request->title;
            $citizenship->description = $request->description;
            $citizenship->snippet = $request->snippet;
            $citizenship->type = $request->type;
            $citizenship->header = $citizenship->uploadImage($request->header, 'webp');
            $citizenship->dropdown_flag = $citizenship->uploadImage($request->dropdown_flag, 'webp');
            $citizenship->body_flag = $citizenship->uploadImage($request->body_flag, 'webp');

            if ($request->has('meta')) {
                $citizenship->meta = $request->meta;
            }

            if ($request->has('keywords')) {
                $citizenship->keywords = $request->keywords;
            }

            $citizenship->save();

            $citizenship->addTranslation([
                'country_name' => $request->translation['country_name'],
                'title'        => $request->translation['title'],
                'description'  => $request->translation['description'],
                'snippet'      => $request->translation['snippet'],
            ]);

            if ($request->has('benefits') && !empty($benefits = json_decode($request->benefits))) {
                $citizenship->addBenefits($benefits);
            }

            if ($request->has('supplies') && !empty($supplies = json_decode($request->supplies))) {
                $citizenship->addSupplies($supplies);
            }

            if ($request->has('customSections') && !empty($customSections = json_decode($request->customSections))) {
                $citizenship->addSections($customSections);
            }

            return response()->json(['message' => 'Success'], 201);
        } catch (\Exception $e) {
            Logger::error($e);
            return response()->json(['message' => 'Failure'], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Citizenship $citizenship
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Citizenship $citizenship)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Citizenship $citizenship
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Citizenship $citizenship)
    {
        return view('admin.citizenship.edit', compact('citizenship'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Citizenship $citizenship
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Citizenship $citizenship)
    {
        $request->validate([
            'country_name'             => 'required | string',
            'title'                    => 'required | string',
            'description'              => 'required | string',
            'snippet'                  => 'required | string',
            'type'                     => 'required | string',
            'translation.country_name' => 'required | string',
            'translation.title'        => 'required | string',
            'translation.description'  => 'required | string',
        ]);

        try {
            $citizenship->country_name  = $request->country_name;
            $citizenship->slug = $request->country_name;
            $citizenship->title = $request->title;
            $citizenship->description = $request->description;
            $citizenship->snippet = $request->snippet;
            $citizenship->type = $request->type;

            if ($request->hasFile('header'))
                $citizenship->header = $citizenship->updateImage($request->header, $citizenship->header);

            if ($request->hasFile('dropdown_flag'))
                $citizenship->dropdown_flag = $citizenship->updateImage($request->dropdown_flag, $citizenship->dropdown_flag);

            if ($request->hasFile('body_flag'))
                $citizenship->body_flag = $citizenship->updateImage($request->body_flag, $citizenship->body_flag);

            if ($request->has('meta'))
                $citizenship->meta = $request->meta;

            if ($request->has('keywords'))
                $citizenship->keywords = $request->keywords;

            $citizenship->save();

            $citizenship->updateTranslation([
                'country_name' => $request->translation['country_name'],
                'title'        => $request->translation['title'],
                'description'  => $request->translation['description'],
                'snippet'      => $request->translation['snippet'],
            ]);

            if ($request->has('benefits') && !empty($benefits = json_decode($request->benefits))) {
                $citizenship->addBenefits($benefits);
            }

            if ($request->has('deletedBenefits') && !empty($deletedBenefits = json_decode($request->deletedBenefits))) {
                CitizenshipBenefit::destroy($deletedBenefits);
            }

            if ($request->has('supplies') && !empty($supplies = json_decode($request->supplies))) {
                $citizenship->addSupplies($supplies);
            }

            if ($request->has('deletedSupplies') && !empty($deletedSupplies = json_decode($request->deletedSupplies))) {
                CitizenshipSupply::destroy($deletedSupplies);
            }

            if (!empty($sections = json_decode($request->sections))) {

                $citizenship->updateSections($sections);
            }

            if ($request->has('customSections') && !empty($customSections = json_decode($request->customSections))) {
                $citizenship->addSections($customSections);
            }

            if ($request->has('deletedSections') && !empty($deletedSections = json_decode($request->deletedSections))) {
                CitizenshipSection::destroy($deletedSections);
            }

            return response()->json(['message' => 'Success', 'slug' => $citizenship->slug], 200);
        } catch (\Exception $e) {
            Logger::error($e);
            return response()->json(['message' => 'Failure'], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Citizenship $citizenship
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Citizenship $citizenship)
    {
        try {
            $citizenship->delete();
            return response()->json([], 204);
        } catch (\Exception $e) {
            Logger::error($e);
            return response()->json(['message' => 'Failure'], 500);
        }
    }
}

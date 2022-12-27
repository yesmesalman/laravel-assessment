<?php

namespace App\Http\Controllers\Resource;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Film;
use App\Models\Genre;
use Exception;
use Validator;

class FilmController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $response = [
                'status' => true,
                'message' => 'all films',
                'data' => Film::with('genres')->get()
            ];
            return response()->json($response, 200);
        }

        return view('app.films.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('app.films.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->ajax()) {
            try {
                $validator = Validator::make($request->all(), [
                    'name' => 'required|max:255',
                    'ticket_price' => 'required|numeric|min:1',
                    'description' => 'required',
                    'release_date' => 'required',
                    'rating' => 'required',
                    'genre' => 'required|array',
                    'photo' => 'required|image|mimes:jpeg,png,jpg|max:2048',
                ]);

                if ($validator->fails()) {
                    $response = [
                        'status' => false,
                        'message' => $validator->errors()->first()
                    ];
                    return response()->json($response, 200);
                }

                $photo = '';
                if ($request->hasFile('photo')) {
                    $img = $request->file('photo');
                    $dest = 'assets/banners/';
                    $obj = time() . "." . $img->getClientOriginalExtension();
                    $img->move($dest, $obj);
                    $photo = $dest . $obj;
                }

                $model = new Film();
                $model->name = $request->name;
                $model->slug = Str::slug($request->name, '-') .'-'. time();
                $model->ticket_price = $request->ticket_price;
                $model->description = $request->description;
                $model->release_date = $request->release_date;
                $model->rating = $request->rating;
                $model->photo = $photo;

                if ($model->save()) {
                    $arr = [];

                    foreach ($request->genre as $e) {
                        array_push($arr, [
                            'film_id' => $model->id,
                            'genre' => $e,
                            'created_at' => date('Y-m-d H:i:s'),
                            'updated_at' => date('Y-m-d H:i:s'),
                        ]);
                    }

                    Genre::insert($arr);

                    $response = [
                        'status' => true,
                        'message' => 'Congratulations, Film has been added.'
                    ];
                    return response()->json($response, 200);
                }

                throw new Exception('Something went wrong.');
            } catch (\Exception $e) {
                $response = [
                    'status' => false,
                    'message' => $e->getMessage(),
                ];
                return response()->json($response, 200);
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $film = Film::where('slug', $slug)->with('genres')->first();

        if ($film == null) {
            return redirect()->route("films.index");
        }

        return view('app.films.show', [
            'film' => $film
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

<?php

namespace App\Http\Controllers\Resource;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Comment;
use Auth;
use Exception;
use Validator;

class CommentController extends Controller
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
                'message' => 'all comments',
                'data' => Comment::where('film_id', $request->film_id)->get()
            ];
            return response()->json($response, 200);
        }
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
                    'comment' => 'required',
                    'film_id' => 'required',
                ]);

                if ($validator->fails()) {
                    $response = [
                        'status' => false,
                        'message' => $validator->errors()->first()
                    ];
                    return response()->json($response, 200);
                }


                $model = new Comment();
                $model->user_id = Auth::id();
                $model->name = $request->name;
                $model->comment = $request->comment;
                $model->film_id = $request->film_id;

                if ($model->save()) {
                    $response = [
                        'status' => true,
                        'message' => 'Congratulations, Your Comment has been posted.'
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
    public function show($id)
    {
        //
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

<?php

namespace App\Http\Controllers\V1;

use App\Models\Board;
use App\Http\Requests\StoreBoardRequest;
use App\Http\Requests\UpdateBoardRequest;
use App\Http\Resources\V1\BoardResource;
use App\Http\Controllers\Controller;

class BoardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return BoardResource::collection(Board::paginate());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreBoardRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBoardRequest $request)
    {
        $board = Board::create($request->all());

        return new BoardResource($board);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Board  $board
     * @return \Illuminate\Http\Response
     */
    public function show(Board $board)
    {
        return new BoardResource($board);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateBoardRequest  $request
     * @param  \App\Models\Board  $board
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBoardRequest $request, Board $board)
    {
        $board->update($request->all());

        return new BoardResource($board);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Board  $board
     * @return \Illuminate\Http\Response
     */
    public function destroy(Board $board)
    {
        $board->delete();

        return response('', 204);
    }
}

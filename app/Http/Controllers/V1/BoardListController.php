<?php

namespace App\Http\Controllers\V1;

use App\Models\{Board, BoardList};
use App\Http\Requests\StoreBoardListRequest;
use App\Http\Requests\UpdateBoardListRequest;
use App\Http\Controllers\Controller;
use App\Http\Resources\V1\{BoardListResource, BoardResource};

class BoardListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Board $board)
    {
        // $where = [
        //     'board_id' => 1
        // ];

        return BoardListResource::collection(BoardList::where('board_id', $board->id)->paginate());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreBoardListRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBoardListRequest $request)
    {
        $boardList = BoardList::create($request->all());

        return new BoardListResource($boardList);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BoardList  $boardList
     * @return \Illuminate\Http\Response
     */
    public function show(Board $board, BoardList $list)
    {
        return BoardResource::collection($list->where);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateBoardListRequest  $request
     * @param  \App\Models\BoardList  $boardList
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBoardListRequest $request, Board $board, BoardList $list)
    {
        $list->update($request->all());

        return new BoardListResource($list);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BoardList  $boardList
     * @return \Illuminate\Http\Response
     */
    public function destroy(Board $board, BoardList $list)
    {
        $list = BoardList::where('board_id', $board->id)->firstOrFail();
        $list->delete();

        return response('', 204);
    }
}

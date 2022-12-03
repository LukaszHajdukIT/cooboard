<?php

namespace App\Http\Controllers\V1;

use App\Models\{ListCard, BoardList};
use App\Http\Requests\{StoreListCardRequest, UpdateListCardRequest};
use App\Http\Controllers\Controller;
use App\Http\Resources\V1\ListCardResource;

class ListCardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ListCardResource::collection(ListCard::paginate());
    }

    public function byBoardList(BoardList $list)
    {
        return ListCardResource::collection(ListCard::where('list_id', $list->id)->paginate());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreListCardRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreListCardRequest $request)
    {
        $card = ListCard::create($request->all());

        return new ListCardResource($card);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ListCard  $listCard
     * @return \Illuminate\Http\Response
     */
    public function show(ListCard $listCard)
    {
        return new ListCardResource(ListCard::firstOrFail($listCard->id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateListCardRequest  $request
     * @param  \App\Models\ListCard  $listCard
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateListCardRequest $request, ListCard $listCard)
    {   
        $listCard->update($request->all());

        return new ListCardResource($listCard);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ListCard  $listCard
     * @return \Illuminate\Http\Response
     */
    public function destroy(ListCard $listCard)
    {
        //
    }
}

<?php


namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Subscribers\StoreRequest;
use App\Http\Requests\Subscribers\UpdateRequest;
use App\Http\Resources\SubscriberResource;
use App\Models\Subscriber;
use Illuminate\Http\Request;

class SubscribersController extends Controller
{
    public function index()
    {
        return SubscriberResource::collection(Subscriber::with('fields')->get());
    }

    public function show(Subscriber $subscriber)
    {
        return new SubscriberResource($subscriber->load('fields'));
    }

    public function store(StoreRequest $request)
    {
        $subscriber = Subscriber::create($request->only([
            'email',
            'address',
            'name',
            'state',
        ]));

        return (new SubscriberResource($subscriber))
            ->response()
            ->setStatusCode(201);
    }

    public function update(UpdateRequest $request, Subscriber $subscriber)
    {
        $subscriber->update($request->only([
            'email',
            'address',
            'name',
            'state',
        ]));

        return new SubscriberResource($subscriber);
    }

    public function destroy(Subscriber $subscriber)
    {
        $subscriber->delete();

        return response()->json(null, 204);
    }

}

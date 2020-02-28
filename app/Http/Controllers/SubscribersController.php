<?php


namespace App\Http\Controllers;

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
        return view('subscribers.index');
    }

    public function create()
    {
        return view('subscribers.create');
    }

    public function store(StoreRequest $request)
    {
        Subscriber::create($request->only([
            'email',
            'address',
            'name',
            'state',
        ]));

        return redirect()->route('subscribers.index');
    }
}

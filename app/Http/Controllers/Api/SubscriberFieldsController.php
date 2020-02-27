<?php


namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\FieldResource;
use App\Http\Resources\SubscriberResource;
use App\Models\Field;
use App\Models\Subscriber;
use Illuminate\Http\Request;

class SubscriberFieldsController extends Controller
{
    public function index(Subscriber $subscriber)
    {
        return FieldResource::collection($subscriber->fields);
    }

    public function store(Subscriber $subscriber, Request $request)
    {
        $field = $subscriber->fields()->create($request->only([
            'title',
            'type',
        ]));

        return (new FieldResource($field))
            ->response()
            ->setStatusCode(201);
    }


}

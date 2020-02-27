<?php


namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\FieldResource;
use App\Http\Resources\SubscriberResource;
use App\Models\Field;
use App\Models\Subscriber;
use Illuminate\Http\Request;

class FieldsController extends Controller
{
    public function show(Field $field)
    {
        return new FieldResource($field);
    }


    public function update(Field $field, Request $request)
    {
        $field->update($request->only([
            'title',
            'type',
        ]));

        return new FieldResource($field);
    }

    public function destroy(Field $field)
    {
        $field->delete();

        return response()->json(null, 204);
    }

}

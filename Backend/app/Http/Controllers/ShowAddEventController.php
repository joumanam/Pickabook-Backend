<?php

namespace App\Http\Controllers;

use App\Models\AddEvent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;


class ShowAddEventController extends Controller
{

    public function addEvent(Request $request)
    {
        $validated = Validator::make($request->all(), [
            'name' => 'required|string|between:1,100',
            'location' => 'required|string|between:1,200',
            'image_url' => 'required|string|between:1,200',
            'date' => 'required|date|between:1,100',
            'time' => 'required|string|between:1,200',
            'coordinates' => 'required|string|between:1,200',
            'comments' => 'string|between:1,150',

        ]);

        if ($validated->fails()) {
            return response()->json($validated->errors()->toJson(), 400);
        }

        $add_event = AddEvent::create(array_merge($validated->validated(), ["user_id" => auth()->user()->id]));

        return response()->json([
            'message' => 'New event added!',
            'event' => $add_event], 201);

    }

    function showEvent(Request $request) {
        $show_event = AddEvent::all()->where("user_id", "=", $request->id);

        return json_encode($show_event);
    }

    function showAllEvents() {

        $show_all_events = AddEvent::all();
        return json_encode($show_all_events);
    }

    public function removeEvent($id)
    {

        $remove_event = AddEvent::find($id);


        if ($remove_event->user_id == auth()->user()->id) {
            $remove_event->delete();

            return response()->json([
                'message' => 'Event successfully removed!',
                'event' => $remove_event,
            ], 201);

        } else {
            return response()->json([
                'message' => "You cannot remove an event not related to your profile!",
            ], 401);
        }
    }

}

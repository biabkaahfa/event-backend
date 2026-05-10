<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Http\Requests\StoreEventRequest;
use App\Http\Requests\UpdateEventRequest;
class EventController extends Controller
{
    public function index(Request $request)
    {
        $query = Event::withCount('registrations');

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        if ($request->has('date')) {
            $query->whereDate('date', $request->input('date'));
        }

        $perPage = $request->input('per_page', 10);
        $events = $query->paginate($perPage);
        return $this->successResponse($events);
    }

    public function store(StoreEventRequest $request)
    {
        $event = Event::create($request->validated());
        return $this->successResponse($event, 'Événement créé avec succès', 201);
    }

    public function show($id)
    {
        $event = Event::with('registrations')->findOrFail($id);
        $event->remaining_capacity = $event->capacity - $event->registrations->count();
        return $this->successResponse($event);
    }

    public function update(UpdateEventRequest $request, $id)
    {
        $event = Event::findOrFail($id);
        $event->update($request->validated());
        return $this->successResponse($event, 'Événement mis à jour avec succès');
    }

    public function destroy($id)
    {
        $event = Event::findOrFail($id);
        $event->delete();
        return $this->successResponse(null, 'Événement supprimé avec succès');
    }
}

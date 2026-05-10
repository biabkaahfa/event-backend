<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Registration;
use App\Http\Requests\RegisterRequest;
use Illuminate\Validation\Rule;

class RegistrationController extends Controller
{
    public function register(RegisterRequest $request, $eventId)
    {
        $event = Event::findOrFail($eventId);

        // Vérification capacité
        if ($event->registrations()->count() >= $event->capacity) {
            return $this->errorResponse('Cet evenement est complet.', 422, ['error' => 'CAPACITY_REACHED']);
        }

        // Vérification email déjà inscrit
        $exists = Registration::where('event_id', $event->id)
            ->where('email', $request->email)
            ->exists();

        if ($exists) {
            return $this->errorResponse('Cette adresse email est deja enregistree pour cet evenement.', 409, ['error' => 'DUPLICATE_EMAIL']);
        }

        $registration = $event->registrations()->create($request->validated());
        
        $responseData = [
            'id' => $registration->id,
            'eventId' => $registration->event_id,
            'firstName' => $registration->first_name,
            'lastName' => $registration->last_name,
            'email' => $registration->email,
            'registeredAt' => $registration->registered_at->format('Y-m-d\TH:i:s\Z'),
        ];

        return $this->successResponse($responseData, 'Inscription réussie', 201);
    }

    public function index($eventId)
    {
        $event = Event::findOrFail($eventId);
        return $this->successResponse($event->registrations);
    }

    public function destroy($id)
    {
        $registration = Registration::findOrFail($id);
        $registration->delete();
        return $this->successResponse(null, 'Inscription annulée avec succès');
    }
}

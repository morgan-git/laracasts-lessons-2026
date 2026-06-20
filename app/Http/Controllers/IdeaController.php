<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Enums\IdeaState;
use App\Http\Requests\IdeaRequest;
use App\Models\Idea;
use App\Notifications\IdeaPublished;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rules\Enum;

class IdeaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $state = in_array($request->state, IdeaState::values()) ? $request->state : null;

        $ideas = Auth::user()
            ->ideas()
            ->when($state, fn ($query, $stateValue) => $query->where('state', $stateValue))
            ->get();

        return view('ideas.index', [
            'ideas' => $ideas,
            'statusCounts' => Idea::getStateCounts(Auth::user()),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('ideas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(IdeaRequest $request)
    {
        $idea = Auth::user()->ideas()->create([
            'description' => request()->description,
            'state' => IdeaState::PENDING,
        ]);

        // notify user
        Auth::user()->notify(new IdeaPublished($idea));

        return redirect('/ideas');

    }

    /**
     * Display the specified resource.
     */
    public function show(Idea $idea)
    {
        Gate::authorize('update', $idea);
        // Auth::user()_>can('update', $idea);

        return view('ideas.show', [
            'idea' => $idea,
            'states' => IdeaState::cases(),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Idea $idea)
    {
        Gate::authorize('update', $idea);

        return view('ideas.edit', [
            'idea' => $idea,
            'states' => IdeaState::cases(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(IdeaRequest $request, Idea $idea)
    {
        Gate::authorize('update', $idea);

        $request->validate([
            'state' => ['nullable', new Enum(IdeaState::class)],
        ]);

        $idea->update([
            'description' => request('description'),
            'state' => IdeaState::tryFrom($request->state)?->value ?? IdeaState::PENDING->value,
            'title' => request('title'),
        ]);

        return redirect("/ideas/$idea->id");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Idea $idea)
    {
        Gate::authorize('update', $idea);

        $idea->delete();

        return redirect('/ideas');
    }
}

<?php


use Illuminate\Support\Facades\Route;
use App\Models\Idea;

Route::get("/ideas", function(){
    $ideas = Idea::all();
   //dd($ideas);
    return view('ideas.index', [
        'ideas' => $ideas,
    ]);
});

//show
Route::get("/ideas/{idea}", function(Idea $idea){

    return view('ideas.show', ['idea' => $idea]);
});

Route::get("/ideas/{idea}/edit", function(Idea $idea){
    return view('ideas.edit', ['idea' => $idea]);
});

//update
Route::patch("/ideas/{idea}", function(Idea $idea){

    $idea->update([
        "description" => request('idea'),
    ]); //needs validation

    return redirect("/ideas/$idea->id");
});

//store
Route::post("/ideas", function(){
    $idea = request()->idea; //needs validation

    Idea::create([
        'description' => $idea,
        'state' => "pending",
    ]);

    return redirect('/ideas');


    //dd("Jabreakit Jubawdit");
    //request()->all
});

//destroy
Route::delete("/ideas/{idea}", function(Idea $idea){

    $idea->delete();
    return redirect('/ideas');

});

Route::view('/larry', 'larry', [
    "greeting" => "Hey mustache, what's up?",
    "person" => request('person') ?? 'Larry',
    "tasks" => ["Dadood Frumcheers", "Count Ravioli", "Disfatt Bidge", "Diddy Doodat"],
])
;
Route::view('/contact', 'contact');
Route::view('/about', 'about');


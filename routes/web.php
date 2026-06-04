<?php

use Illuminate\Support\Facades\Route;

Route::get("/", function(){
    $ideas = session()->get('ideas') ?? [];
    //dd($ideas);
    return view('ideas', [
        'ideas' => $ideas,
    ]);
});

Route::post("/", function(){
    $idea = request()->idea;
    session()->push('ideas', $idea);

    return redirect('/');


    //dd("Jabreakit Jubawdit");
    //request()->all
});

Route::view('/larry', 'larry', [
    "greeting" => "Hey mustache, what's up?",
    "person" => request('person') ?? 'Larry',
    "tasks" => ["Dadood Frumcheers", "Count Ravioli", "Disfatt Bidge", "Diddy Doodat"],
]);
Route::view('/contact', 'contact');
Route::view('/about', 'about');

//Temporary for the scope of the demo lesson
Route::get('/delete-ideas', function(){
    session()->forget("ideas");
    return redirect('/');

});

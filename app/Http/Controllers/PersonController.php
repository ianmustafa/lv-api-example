<?php

namespace App\Http\Controllers;

use App\Http\Resources\Person as PersonResource;
use App\Person;
use Illuminate\Http\Request;

class PersonController extends Controller
{
    /**
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $people = Person::all();

        return response()->json(PersonResource::collection($people));
    }

    /**
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $person = Person::create($request->only('name', 'gender', 'address'));

        return response()->json(new PersonResource($person), 201);
    }

    /**
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Person  $person
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Person $person)
    {
        $person->update($request->only('name', 'gender', 'address'));

        return response()->json(new PersonResource($person));
    }

    /**
     * @param  \App\Person  $person
     * @return \Illuminate\Http\Response
     */
    public function destroy(Person $person)
    {
        $person->delete();

        return response()->json(null, 204);
    }
}

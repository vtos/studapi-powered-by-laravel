<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Http\Response as IlluminateHttpResponse;
use Symfony\Component\HttpFoundation\Response as HttpFoundationResponse;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function store(Request $request): IlluminateHttpResponse
    {

        $fromRequest = $request->only([
            'sin',
            'active',
            'first_name',
            'last_name',
        ]);

        $student = new Student();
        $student->sin = $fromRequest['sin'];
        $student->active = $fromRequest['active'];
        $student->first_name = $fromRequest['first_name'];
        $student->last_name = $fromRequest['last_name'];
        $student->save();

        return response($student->toArray(), HttpFoundationResponse::HTTP_CREATED);
    }

    public function show(int $id): IlluminateHttpResponse
    {
        $students = Student::where('sin', $id)->project(
            [
                '_id' => 0,
            ]
        );

        if ($students->count() > 1) {
            // Return an error here.
        }

        return response($students->first()->toArray(), HttpFoundationResponse::HTTP_OK);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response as IlluminateHttpResponse;
use Symfony\Component\HttpFoundation\Response as HttpFoundationResponse;
use App\Models\Student;
use App\Domain\Value\SIN;
use App\Domain\Value\GroupName;
use App\Domain\Value\StudentName;

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
            'group_name',
        ]);

        $student = new Student();
        $student->sin = SIN::fromInt($fromRequest['sin']);
        $student->group_name = GroupName::fromString($fromRequest['group_name']);
        $student->active = $fromRequest['active'];
        $student->name = StudentName::fromStringsWithNoSecondName(
            $fromRequest['first_name'],
            $fromRequest['last_name']
        );

        $student->save();

        return response($student->toJson(), HttpFoundationResponse::HTTP_CREATED);
    }

    public function show(int $id): IlluminateHttpResponse
    {
        $students = Student::where('sin', $id)->project(
            [
                '_id' => 0,
            ]
        );

        return response($students->first()->toJson(), HttpFoundationResponse::HTTP_OK);
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

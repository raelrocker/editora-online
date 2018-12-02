<?php

namespace CodeEduUser\Http\Controllers;

use CodeEduUser\Http\Controllers\Controller as UserController;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use CodeEduUser\Annotations\Mapping\Controller as ControllerAnnotation;
use CodeEduUser\Annotations\Mapping\Action as ActionAnnotation;

/**
 * @ControllerAnnotation(name="user-admin", description="Administração de usuário")
 */
class CodeEduUserController extends UserController
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('codeeduuser::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('codeeduuser::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit()
    {
        return view('codeeduuser::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(Request $request)
    {
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy()
    {
    }
}

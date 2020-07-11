<?php

namespace App\Http\Controllers;

use App\Services\Message\Send as SendMessageService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class MessageController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  SendMessageService  $service
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, SendMessageService $service)
    {
        // User input validation
        $this->validate($request, [
            'name' => ['required', 'min:1', 'max:100'],
            'email' => ['required', 'email', 'min:1', 'max:100'],
            'message' => ['required', 'min:1', 'max:3000'],
        ]);

        $service->execute($request->only('name', 'email', 'message'));

        // Everything OK
        return response()->json([
            'message' => 'Your message was sent successfully.',
            'status_code' => Response::HTTP_OK
        ], Response::HTTP_OK);
    }
}

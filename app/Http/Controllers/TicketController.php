<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTicketRequest;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;
use App\Models\Ticket;
use App\Services\TicketsService;

class TicketController extends Controller
{
    protected $ticketsService;
    public function __construct(TicketsService $ticketsService) {
        $this->ticketsService = $ticketsService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        $tickets = $this->ticketsService->getIndexData();
        // return response()->json($tickets);

        return view('pages.tickets.index', ['tickets' => $tickets]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateTicketRequest $request)
    {
        $this->ticketsService->store($request);
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFundrasingWidrawalsRequest;
use App\Models\Fundraising;
use App\Models\FundraisingWithdrawal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class FundraisingWithdrawalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function store(StoreFundrasingWidrawalsRequest $request, Fundraising $fundraising)
    {
        $hasRequestWithdrawal = $fundraising->widrawals()->exists(); //cek apakah sudah pernah melakukan withdrawals

        if($hasRequestWithdrawal){
            return redirect()->route('admin.fundraisings.show', $fundraising);
        }

        DB::transaction(function() use ($request, $fundraising){

            $validated= $request->validated();

            $validated['fundraiser_id'] = Auth::user()->fundraiser->id;
            $validated['has_received'] = false;
            $validated['has_set'] = false;
            $validated['amount_requested'] = $fundraising->totalReachedAmount();
            $validated['amount_received'] = 0;
            $validated['proof'] = 'proofs/bukitransfertapipalsu.png';

            $fundraising->widrawals()->create($validated);
        });
        return redirect()->route('admin.my_withdrawals');
    }

    /**
     * Display the specified resource.
     */
    public function show(FundraisingWithdrawal $fundraisingWithdrawal)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(FundraisingWithdrawal $fundraisingWithdrawal)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, FundraisingWithdrawal $fundraisingWithdrawal)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(FundraisingWithdrawal $fundraisingWithdrawal)
    {
        //
    }
}

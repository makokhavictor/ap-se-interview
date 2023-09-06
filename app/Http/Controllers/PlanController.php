<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use Illuminate\Http\Request;
use App\DataTables\PlansDataTable;
use Illuminate\Support\Facades\Validator;

class PlanController extends Controller
{
    
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'price' => ['required', 'numeric'],
        ]);
    }
    public function index(PlansDataTable $dataTable) {
        return $dataTable->render('plans.index');
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'price' => 'required|numeric',
            'duration_in_days' => 'required|numeric',
        ]);
        Plan::create($request->except('_token'));
        return redirect('/plans');

    }

    public function create() {
        return view('plans.create');
    }

    public function show() {

    }

    public function edit($id) {
        $plan = Plan::find($id);
        return view('plans.edit', ['plan' => $plan]);
    }

    public function update(Request $request, $id) {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'price' => 'required|numeric',
            'duration_in_days' => 'required|numeric',
        ]);
        $plan = Plan::find($id);
        $plan->update($request->except('_token'));
        return redirect('/plans'); 
    }

    public function destroy($id)
    {
        $plan = Plan::findOrFail($id);
        $plan->delete();
        return redirect('/plans'); 
    }

}

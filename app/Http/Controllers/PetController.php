<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Pet;

class PetController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $pet = Pet::all();
        return response()->json($pet);
    }

    public function create(Request $request)
    {
        $this->validate($request, [
            "checkup_id" => "required|unique:pet",
            "pet_name" => "required",
            "pet_age" => "required",
            "pet_disease" => "required",
            "pet_gender" => "required",
            "owner_name" => "required",
            "doctor_name" => "required"
        ]);

        $data = $request->all();
        $pet = Pet::create($data);

        return response()->json($pet);
    }

    public function show($id)
    {
        $pet = Pet::find($id);
        if (!$pet) {
            return response()->json(['message' => 'Data not found, Please check the ID!'], 404);
        }
        return response()->json($pet);
    }

    public function update(Request $request, $id)
    {
        $pet = Pet::find($id);
        
        if (!$pet) {
            return response()->json(['message' => 'Data not found, Please check the ID!'], 404);
        }
        
        $this->validate($request, [
            "checkup_id" => "required",
            "pet_name" => "required",
            "pet_age" => "required",
            "pet_disease" => "required",
            "pet_gender" => "required",
            "owner_name" => "required",
            "doctor_name" => "required"
        ]);

        $data = $request->all();
        $pet->fill($data);
        $pet->save();

        return response()->json($pet);
    }

    public function destroy($id)
    {
        $pet = Pet::find($id);
        
        if (!$pet) {
            return response()->json(['message' => 'Data not found , Please check the ID'], 404);
        }

        $pet->delete();

        return response()->json(['message' => 'Data has been DELETED'], 200);
    }
} 
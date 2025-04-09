<?php

namespace App\Http\Controllers\Client;

use App\Models\Client;
use Illuminate\Http\Request;
use GuzzleHttp\Psr7\Response;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Symfony\Contracts\Service\Attribute\Required;

class ClientController extends Controller
{
    public function index()
    {
        $clients = Client::all();
        return Response()->json(
            [
                'status' => true,
                'message' => 'Retrieved all clients successfully',
                'data' => $clients,
            ]
        );
    }

    public function store(Request $request)
    {
        $trim_data = array_map('trim', $request->all());
        $validate_data = Validator::make($trim_data, [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'gender' => 'required|string|max:10',
            'address' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:client',
            'password' => 'required|string|min:8',
        ]);

        if ($validate_data->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation failed',
                'errors' => $validate_data->errors(),
            ], 422);
        }

        $client_id = random_int(100000, 999999);

        $client = Client::create([
            'client_id' => $client_id,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'gender' => $request->gender,
            'address' => $request->address,
            'username' => $request->username,
            'password' => Hash::make($request->password),
        ]);

        return Response()->json(
            [
                'status' => true,
                'message' => 'Client created successfully',
                'data' => $client,
                'token' => $client->createToken('ClientToken')->plainTextToken,
            ]
        );
    }

    public function LoginClient(Request $request)
    {
        $trim_data = array_map('trim', $request->all());
        $validate_data = Validator::make($trim_data, [
            'username' => 'required|string|max:255',
            'password' => 'required|string|min:8',
        ]);

        if ($validate_data->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation failed',
                'errors' => $validate_data->errors(),
            ], 422);
        }

        $client = Client::where('username', $request->username)->first();

        if (!$client || !Hash::check($request->password, $client->password)) {
            return response()->json([
                'status' => false,
                'message' => 'Invalid credentials',
            ], 401);
        }

        return response()->json([
            'status' => true,
            'message' => 'Login successful',
            'data' => $client,
            'token' => $client->createToken('ClientToken')->plainTextToken,
        ]);
    }

    public function logoutClient(Request $request)
    {
        
        $request->user()->currentAccessToken()->delete();
        return response()->json([
            'message' => 'Successfully logged out'
        ]);
 
    }


    public function show($id)
    {
        $client = Client::find($id);

        if (!$client) {
            return response()->json([
                'status' => false,
                'message' => 'Client not found',
            ], 404);
        }

        return response()->json([
            'status' => true,
            'message' => 'Client retrieved successfully',
            'data' => $client,
        ]);
    }

    public function update(Request $request, $id)
    {
        $client = Client::find($id);
        if (!$client) {
            return response()->json([
                'status' => false,
                'message' => 'Client not found',
            ], 404);
        }

        $trim_data = array_map('trim', $request->all());
        $validate_data = Validator::make($trim_data, [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'gender' => 'required|string|max:10',
            'address' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:client',
            'password' => 'required|string|min:8',
        ]);

        if ($validate_data->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation failed',
                'errors' => $validate_data->errors(),
            ], 422);
        }

        $client->update($validate_data);

        return response()->json([
            'status' => true,
            'message' => 'Client updated successfully',
            'data' => $client,
        ]);


    }
    public function destroy($id)
    {
        $client = Client::find($id);
        if (!$client) {
            return response()->json([
                'status' => false,
                'message' => 'Client not found',
            ], 404);
        }

        $client->delete();

        return response()->json([
            'status' => true,
            'message' => 'Client deleted successfully',
        ]);
    }
}

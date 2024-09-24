<?php

namespace App\Http\Controllers;

use App\Models\Connections;
use App\Models\Servers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;


class ConnectionsController extends Controller
{

    public function connect_whatsapp()
{
    $connection = $this->get_server();

    if ($connection) {
        $response = Http::get("http://{$connection['ip']}:{$connection['port']}/connected");

        if ($response->successful()) {
            $connected = $response->json()['connected'] ?? false;

            if ($connected) {
                return response()->json([
                    'message' => 'Your WhatsApp Account is connected.'
                ]);
            } else {
                $qrResponse = Http::get("http://{$connection['ip']}:{$connection['port']}/qr");

                if ($qrResponse->successful()) {
                    return response()->json($qrResponse->json());
                } else {
                    return response()->json([
                        'message' => 'Failed to retrieve QR code from the server.'
                    ], 500);
                }
            }
        } else {
            return $this->assign_and_connect();
        }
    }
    return $this->assign_and_connect();
}

    private function assign_and_connect()
    {
    $user_id = auth()->id();

    $server = $this->suggest_server();
    $port = $this->suggest_port($server);

    if (!$server || !$port) {
        return response()->json([
            'message' => 'No available servers or ports.'
        ], 400);
    }

    $response = Http::post("http://{$server->ip}:63000/new", [
        'id' => $user_id,
        'port' => $port,
        'ip' => $server->ip,
    ]);

    if ($response->successful()) {
        return response()->json([
            'message' => 'Connecting to server.'
        ], 200);
    } else {
        return response()->json([
            'message' => 'Failed to communicate with the server for a new connection.'
        ], 500);
    }
}


    // Retrieve the connection of a user
    private function get_server()
{
    $user_id = auth()->id();
    $connection = Connections::where('user_id', $user_id)
                    ->with('server') 
                    ->first();

    if (!empty($connection)) {
        return [
            'ip' => $connection->server->ip, 
            'port' => $connection->port       
        ];
    }
    return false;
}


    // Assign a server to a user based on available connection limit
    // public function assign_server($user_id = false)
    // {
    //     if (!$user_id) {
    //         $user_id = auth()->id();
    //     }
    //     $server = $this->suggest_server();
    //     $port = $this->suggest_port($server);

    //     if (!$server || !$port) {
    //         return response()->json([
    //             'message' => 'No available servers. All servers have reached their limits.'
    //         ], 400);
    //     }

    //     // send a request to the launcher NodeJS script on the suggested server
    //     $response = Http::post('', [
    //         'server_id' => $server->ip,
    //         'port' => $port,
    //         'user_id' => $user_id,
    //     ]);

    //     if ($response->failed()) {
    //         return response()->json([
    //             'message' => 'Failed to assign server. Please try again later.',
    //         ], 500);
    //     }
    //     else if ($response->json()['success']) {
    //         return response()->json([
    //             'message' => 'Assigning server. Please wait.',
    //         ], 200);
    //     }

    // }

    private function suggest_server() {
        $servers = Servers::all();
        $server_connections = $this->all_servers_connection_count();
        foreach ($servers as $server) {
            $connection_count = $server_connections[$server->id] ?? 0;
            if ($connection_count < $server->limit) {
                return $server;
            }
        }
        return false;
    }

    private function suggest_port($server) {

        $server = $this->suggest_server();
        if (!$server) return false;

        $ports = [64000, 64001, 64002, 64003, 64004, 64005, 64006, 64007, 64008, 64009, 64010];
        foreach ($ports as $port) {
            $port_used = Connections::where('server_id', $server->id)->where('port', $port)->exists();
            if (!$port_used) return $port;
        }
        return false;
    }
//convert to post and make route for this function

    public function insert_entry(Request $request)
    {
        $args = $request->validate([
            'user_id' =>'required|integer',
            'server_ip' =>'required',
            'port' =>'required|integer|between:64000,64010'
        ]);
        $user_id = $args['user_id'];
        $server_ip = $args['server_ip'];
        $port = $args['port'];

        $server = Servers::where('ip', $server_ip)->first();
        if (!$server) {
            return response()->json([
                'message' => 'Failed to insert entry. Server not found.',
            ], 400);
        }
        $insertion = Connections::create([
            'user_id' => $user_id,
            'server_id' => $server->id,
            'port' => $port,
        ]);

        if ($insertion) {
            return response()->json([
                'message' => 'Server entry successful!'
            ]);
    }
        return response()->json([
            'message' => 'Failed to insert entry. Something went wrong.',
        ], 400);
    }


    // Count all connections for all servers and return an associative array
    private function all_servers_connection_count()
    {
        $connections = Connections::selectRaw('server_id, COUNT(*) as count')
                                   ->groupBy('server_id')
                                   ->get();

        $server_connection_count = [];
        foreach ($connections as $connection) {
            $server_connection_count[$connection->server_id] = $connection->count;
        }

        return $server_connection_count;
    }

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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Connections $connections)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Connections $connections)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Connections $connections)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Connections $connections)
    {
        //
    }
}

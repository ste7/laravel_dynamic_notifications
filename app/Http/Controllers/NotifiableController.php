<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateNotifiableRequest;
use App\Notifiable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NotifiableController extends Controller
{
    public function index() {
        return response([
            'notifiables' => Notifiable::all()
        ], 200);
    }

    public function store(CreateNotifiableRequest $request) {
        $notifiable = Notifiable::create($request->all());
        return response([
            'notifiable' => $notifiable
        ], 200);
    }

    public function show(Notifiable $notifiable){
        return response([
            'notifiable' => $notifiable
        ], 200);
    }

    public function update(Request $request, Notifiable $notifiable){
        return response([
            'notifiable' => tap($notifiable)->update($request->all())
        ], 200);
    }

    public function destroy(Notifiable $notifiable){
        $notifiable->delete();
    }

    public function getModels() {
        $tables = DB::select('SHOW TABLES');
        $models = collect();

        foreach ($tables as $item) {
            $separate = str_singular(str_replace('_', ' ', $item->Tables_in_notydb)); // Tables_in_'db_name'
            $models->push('App\\' . str_replace(' ', '', ucwords($separate)));
        }

        return response([
            'models' => $models
        ], 200);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Request as ModelsRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RequestController extends Controller
{

    public $queryName = [
        'stipendia' => 'Справка о размере стипендии',
        'study' => 'Cправка об обучении',
    ];

    function index() {
        $requests=[];
        $user = Auth()->user();
        
        if (!$user) {
            return redirect('login');
        }
        if ($user['role'] == 'secretary') {
            $requests=ModelsRequest::all();
        }
        else {
            $requestsUser=$user->requests;
            if ($requestsUser) {
                $requests = $requestsUser;
            }
        }
        foreach ($requests as $key => $value) {
            $requests[$key]['data'] = json_decode($value['data'], true);
        }
        return view('request', ['requests'=>$requests]);
    }

    function show() {
        return view('request.create');
    }

    function queryShow ($queryType) {
        $query = [
            "stipendia" => [
                ["type" => "input", 'variant' => 'text', 'name' => "name", 'title' => 'ФИО'], 
                ["type" => "input", 'variant' => 'date',  'name' => "birthday", 'title' => 'Дата рождения'], 
                ["type" => "input", 'variant' => 'text',  'name' => "group", 'title' => 'Группа'], 
                ["type" => "select", "options" => ['бюджет', 'договор'], 'name' => "styde", 'title' => 'Основа обучения'], 
                ["type" => "select", "options" => ['Соц. защита', 'Пенсионный фонд', 'Налоговая инспекция', 'По месту требования'],
                 'name' => "sent", 'title' => 'Куда направляется справка'], 
                ["type" => "input", 'variant' => 'number',  'name' => "count", 'title' => 'Количество справок:'], 
                ["type" => "input", 'variant' => 'date',  'name' => "count", 'title' => 'Дата заказа справки'], 

            ],
            "study" => [
                ["type" => "input", 'variant' => 'text', 'name' => "name", 'title' => 'ФИО'], 
                ["type" => "input", 'variant' => 'date',  'name' => "birthday", 'title' => 'Дата рождения'], 
                ["type" => "input", 'variant' => 'text',  'name' => "group", 'title' => 'Группа'], 
                ["type" => "select", "options" => ['бюджет', 'договор'], 'name' => "styde", 'title' => 'Основа обучения'], 
                ["type" => "select", "options" => ['Соц. защита', 'Пенсионный фонд', 'Налоговая инспекция', 'По месту требования', 'Военный комиссариат'],
                 'name' => "sent", 'title' => 'Куда направляется справка'], 
                ["type" => "input", 'variant' => 'number',  'name' => "count", 'title' => 'Количество справок:'], 
                ["type" => "input", 'variant' => 'date',  'name' => "count", 'title' => 'Дата заказа справки'],
            ],
        ];
        return view('request.query', ["query" => $query[$queryType], 'name' => $queryType]);
    }
    function store(Request $request) {
        $name = $this->queryName[$request->input('nameQuery')];
        $datas = $request->input();
        array_splice($datas, 0, 1);

        $data = json_encode($datas);
        $req = ModelsRequest::create([
            'name' => $name,
            'data' => $data,
            'user_id' => Auth::id()
        ]);

        return redirect('/');
    }

    function query($query) {
        $queryData = ModelsRequest::where('id', $query)->first();

        $queryData['data'] = json_decode($queryData['data'], true);

        return view('query.show', ['query' => $queryData]);
    }

    function changeStatus(Request $request) {
        $status = $request->status;
        $id = $request->input('query_id');

        ModelsRequest::where('id', $id)
        ->update(['status' => $status]);

        return redirect('/');
    }
}

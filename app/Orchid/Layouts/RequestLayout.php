<?php

namespace App\Orchid\Layouts;

use App\Models\Request;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\DropDown;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class RequestLayout extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'request';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): iterable
    {
        return [
            // способ вывода данных из связей 
            TD::make('пользователь')->render(function(Request $request){
                return $request->user->name;
            }),
            TD::make('name', 'Имя'),
            TD::make('status', 'Статус'),
            TD::make('сведения о справке')->render(function (Request $req) {
                $data = json_decode($req['data']);
                $res = '<ul style="list-style: circle inside;">';
                foreach ($data as $key => $value) {
                    $res .= '<li style="display: flex; justify-content: space-between;list-style: circle inside;">' . '<div style="width: 45%;"><span style="font-size: 4px;text-align: center; vertical-align: middle; margin: 0 8px 0 0;">⚫</span>'. $key.'</div>'. '<div style="width: 10%;">-</div>' . '<div style="width: 45%;">'.$value .'</div>'.'</li>';
                }
                $res .= '</ul>';
                return $res;
            }),
            TD::make('Действия')->render(function (Request $req) {
                $id = $req['id'];
                return DropDown::make()->icon('three-dots-vertical')->list([
                    Button::make('В процессе')->method('process', [
                        'id' => $id
                    ]),
                    Button::make('Готово')->method('complete', [
                        'id' => $id
                    ]),
                ]);
            })
        ];
    }
}

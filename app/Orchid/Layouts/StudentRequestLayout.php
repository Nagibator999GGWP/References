<?php

namespace App\Orchid\Layouts;

use App\Models\Request;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class StudentRequestLayout extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'student';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): iterable
    {
        return [
            TD::make('name', 'Тип справки'),
            TD::make('status', 'статус'),
            TD::make('данные')->render(function (Request $req) {
                $data = json_decode($req['data']);
                $res = '<ul style="list-style: circle inside;">';
                foreach ($data as $key => $value) {
                    $res .= '<li style="display: flex; justify-content: space-between;list-style: circle inside;">' . '<div style="width: 45%;"><span style="font-size: 4px;text-align: center; vertical-align: middle; margin: 0 8px 0 0;">⚫</span>'. $key.'</div>'. '<div style="width: 10%;">-</div>' . '<div style="width: 45%;">'.$value .'</div>'.'</li>';
                }
                $res .= '</ul>';
                return $res;
            }),
        ];
    }
}

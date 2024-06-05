<?php

namespace App\Orchid\Screens;
use Illuminate\Http\Request;

use App\Models\Request as ModalRequest;
use Illuminate\Support\Facades\Auth;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\DateTimer;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;

class StudyScreen extends Screen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'StudyScreen';
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [];
    }

    /**
     * The screen's layout elements.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): iterable
    {
        return [
            Layout::rows([
                Input::make('styde.имя')
                    ->title('ФИО')
                    ->placeholder('Введите ваше ФИО'),

                DateTimer::make('styde.дата рождения')
                    ->title('Дата рождения')
                    ->format('Y-m-d')
                    ->allowInput(),
                    

                Input::make('styde.группа')
                    ->title('Группа')
                    ->placeholder('Введите вашу группы'),

                Select::make('styde.основа обучения')->title('Основа обучения')
                ->options([
                    'бюджет' => 'бюджет',
                    'договор' => 'договор'
                ]),

                Select::make('styde.направление справки')->title('Куда направляется справка')
                ->options([
                    'Соц. защита' => 'Соц. защита',
                    'Пенсионный фонд' => 'Пенсионный фонд',
                    'Налоговая инспекция' => 'Налоговая инспекция',
                    'По месту требования' => 'По месту требования',
                    'Военный комиссариат' => 'Военный комиссариат',
                ]),

                Input::make('styde.количество справок')
                    ->title('Количество справок:')
                    ->placeholder('Введите ваше ФИО'),

                Input::make('styde.дата')
                    ->title('Дата заказа справки')
                    ->placeholder('Введите ваше ФИО'),
                Button::make('Заказать')->method('CreateRequest')
            ])
        ];
    }
    public function CreateRequest(Request $request) {
        $req = $request['styde'];
        $data = json_encode($req);
        $req = ModalRequest::create([
            'name' => 'Справка о обучении',
            'data' => $data,
            'user_id' => Auth::id()
        ]);
        return redirect('/student');

    }
}

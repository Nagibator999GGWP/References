<?php

namespace App\Orchid\Screens;

use App\Models\Request;
use App\Orchid\Layouts\StudentRequestLayout;
use Illuminate\Support\Facades\Auth;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Actions\ModalToggle;
use Orchid\Screen\Fields\Relation;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;

class StudentScreen extends Screen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {
        $auth = Auth::user();

        return [
            'student' => $auth->requests
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Заказать справку';
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            ModalToggle::make('Заказать справку')
            ->modal('CreateRequest')
            ->icon('note')
            ->method('update'),
            Link::make('Стипендия')->href('/stipendia'),
            Link::make('Обучение')->href('/styde'),
        ];
    }

    /**
     * The screen's layout elements.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): iterable
    {
        return [
            StudentRequestLayout::class,
            Layout::modal('CreateRequest', Layout::rows([
            Select::make('request')->title('Справка')
            ->options([
                'stipend' => 'Справка о стипендии',
                'study' => 'Справка о обучении',
            ]),
            ])),
        ];
    }
}

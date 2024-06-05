<?php

namespace App\Orchid\Screens;

use App\Models\Request;
use App\Orchid\Layouts\StudentRequestLayout;
use Illuminate\Support\Facades\Auth;
use Orchid\Screen\Screen;

class ReadyScreen extends Screen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {
        $id = Auth::user()->id;
        return [
            'student' => Request::where('id', $id)->where('status', 'готова')->get()
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Готовые справки';
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
            StudentRequestLayout::class
        ];
    }
}

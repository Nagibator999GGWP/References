<?php

namespace App\Orchid\Screens;

use App\Models\Request;
use App\Orchid\Layouts\RequestLayout;
use Illuminate\Http\Request as Req;
use Orchid\Screen\Actions\ModalToggle;
use Orchid\Screen\Screen;

class SecretaryScreen extends Screen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [
            'request' => Request::all()
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Справки';
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
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
            RequestLayout::class
            

        ];
    }

    
    public function process(Req $request) {
        $id = $request['id'];
        Request::where('id', $id)->update([
            'status' => 'в процессе'
        ]);
        }
    public function complete(Req $request) {
            $id = $request['id'];
            Request::where('id', $id)->update([
                'status' => 'готова'
            ]);
    }
}

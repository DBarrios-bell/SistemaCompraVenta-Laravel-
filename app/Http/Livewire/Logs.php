<?php

namespace App\Http\Livewire;

use App\Models\Log;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Logs extends Component
{
    public function render()
    {
        return view('livewire.logs');
    }

    public static function logs($action,$message,$categories)
    {

        $log = Log::create([
        'action' => $action,
        'message' => $message,
        'categories' => $categories,
        'user_id' => Auth::user()->id
        ]);
        $log->save();
    }
}

<?php

namespace App\Http\Livewire;

use App\Models\Log;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class Logs extends Component
{
    use WithPagination;

    public $userid, $toDate, $fromDate, $search;
    private $pagination = 50;

    public function mount()
    {
        $this->userid = 0;
    }

    //paginacion
    public function paginationView(){
        return 'vendor.livewire.bootstrap';
    }

    public function render()
    {
        if (strlen($this->search) > 0) {
            $logs = Log::join('users as u' , 'u.id', 'logs.user_id')
                    ->select('logs.*', 'u.name as user')
                    ->where('logs.action','like','%'. $this->search . '%')
                    ->orwhere('logs.categories','like','%'. $this->search . '%')
                    ->orwhere('logs.message','like','%'. $this->search . '%')
                    ->orwhere('u.name','like','%'. $this->search . '%')
                    ->paginate($this->pagination);
        }else{
            $logs = Log::join('users as u' , 'u.id', 'logs.user_id')
                    ->select('logs.*', 'u.name as user')
                    ->paginate($this->pagination);
        }

        return view('livewire.logs.component', [
        'logs' => $logs,
        'users' => User::orderBy('name', 'asc')->get()
        ])
        ->extends('layouts.theme.app')
        ->section('content');
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

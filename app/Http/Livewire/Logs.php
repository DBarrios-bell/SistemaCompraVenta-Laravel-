<?php

namespace App\Http\Livewire;

use App\Models\Log;
use App\Models\SalePoints;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class Logs extends Component
{
    use WithPagination;

    public $userid, $toDate, $fromDate, $search, $ptventa;
    private $pagination = 10;

    public function mount()
    {
        $this->userid = 0;
        $this->ptventa = 0;
    }

    //paginacion
    public function paginationView(){
        return 'vendor.livewire.bootstrap';
    }

    public function render()
    {
        $this->Consultar();
        $this->paginationView();
        return view('livewire.logs.component', [
            // 'logs' => $logs,
            'users' => User::orderBy('name', 'asc')->get(),
            'salepoints' => SalePoints::orderBy('id', 'desc')->get(),
        ])
        ->extends('layouts.theme.app')
        ->section('content');
    }

    public function Consultar()
    {
        $fi= Carbon::parse($this->fromDate)->format('Y-m-d').' 00:00:00';
        $ff= Carbon::parse($this->toDate)->format('Y-m-d').' 23:59:59';

        if (strlen($this->search) > 0) {
            $this->logs = Log::join('users as u' , 'u.id', 'logs.user_id')
            ->select('logs.*', 'u.name as user')
            ->orwhere('logs.action','like','%'. $this->search . '%')
            ->orwhere('logs.categories','like','%'. $this->search . '%')
            ->orwhere('logs.message','like','%'. $this->search . '%')
            ->orwhere('u.name','like','%'. $this->search . '%')
            ->get();
        }else{
            $this->logs = Log::join('users as u' , 'u.id', 'logs.user_id')
            ->select('logs.*', 'u.name as user')
            ->whereBetween('logs.created_at', [$fi, $ff])
            ->where('user_id', $this->userid)
            ->where('salepoint', $this->ptventa)
            ->get();
        }
    }

    public static function logs($action,$message,$categories)
    {
        $log = Log::create([
        'action' => $action,
        'message' => $message,
        'categories' => $categories,
        'user_id' => Auth::user()->id,
        'salepoint' => session('ptventa'),
        ]);
        $log->save();
    }
}

<?php

namespace App\Http\Livewire;

use App\Models\SalePoints;
use App\Models\UserSalePoints;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class SalePoint extends Component
{
    // public $ptventa;

    // select sp.name, u.name
    // from user_sale_points
    // join users as u on u.id = user_sale_points.user_id
    // join sale_points as sp on sp.id = user_sale_points.salepoint_id
    // where salepoint_id = '1'

    public function render()
    {
        // $pventa = Auth::user('name');
        return view('livewire.salePoints.point-sale',[
            // 'pventa' => SalePoints::where('user_id', Auth::user()->id)->get()
            // join('categories as c' , 'c.id', 'products.category_id')
            // ->select('products.*','c.name as category')
            'pventa' => UserSalePoints::join('sale_points as sp','sp.id','user_sale_points.salepoint_id')
                    ->select('sp.id','sp.name')
                    ->where('user_sale_points.user_id', Auth::user()->id)->get()
        ])->extends('layouts.theme.app')
        ->section('content');
    }

    public function SelectPTVenta($id)
    {
        if($id >0){
            session(['ptventa'=>$id]);
            // $this->emit('point-added',session('ptventa'));
            return redirect()->to('/categories');
        }
    }

}

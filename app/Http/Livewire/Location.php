<?php

namespace App\Http\Livewire;

use App\Models\City;
use App\Models\State;
use Livewire\Component;

class Location extends Component
{
    public $state;
    public $city;
    public $states;
    public $cities;

    public function mount()
    {
        $this->states = State::all()->pluck('name', 'id');
        $this->cities = City::all()->pluck('name', 'id');
    }

    public function updatedState($value)
    {
//        dd('hi');
        $this->cities = State::findorfail($value)->cities->pluck('name', 'id');
    }

    public function render()
    {
        return view('livewire.location');
    }
}

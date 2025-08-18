<?php

namespace App\Livewire\Leads;

use Livewire\Component;
use Illuminate\Support\Facades\Http;

class CiudadesComponent extends Component
{
    // Models
    public $departamentos = [], $ciudades = [], $departamento;

    public function render()
    {
        return view('livewire.leads.ciudades-component');
    }

    public function mount(){
        $this->getDepartamentos();
    }

    public function getDepartamentos(){
        $departamentos = Http::get('https://app-poli-back.ilumno.com/api/app-cms/catalog?entityType=app-state')->json();
        $this->departamentos = $departamentos;
    }

    public function updatedDepartamento()
    {
        $ciudades = Http::get('https://app-poli-back.ilumno.com/api/app-cms/catalog?entityType=app-city&filters[app_state][code]='.$this->departamento)->json();
        $this->ciudades = $ciudades;
    }
}

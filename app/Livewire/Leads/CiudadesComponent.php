<?php

namespace App\Livewire\Leads;

use Livewire\Component;
use Illuminate\Support\Facades\Http;

class CiudadesComponent extends Component
{
    // Models
    public $departamentos = [], $ciudades = [], $departamento, $Tprograma, $tipos_programa = [], $modalidad, $modalidades = [], $programa, $programas = [];

    public function render()
    {
        $this->getProgramas();
        return view('livewire.leads.ciudades-component');
    }

    public function mount(){
        $this->getDepartamentos();
        $this->getTiposPrograma();
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

    public function getTiposPrograma(){
        $tipos = Http::get('https://app-poli-back.ilumno.com/api/app-cms/catalog?entityType=app-program-type&populate[0]=app_opportunity_type')->json();
        $this->tipos_programa = $tipos;
    }

    public function updatedTprograma()
    {
        $modalidades = Http::get('https://app-poli-back.ilumno.com/api/app-cms/catalog?entityType=app-modality&filters[app_program_type][code]='.$this->Tprograma)->json();
        $this->modalidades = $modalidades;
    }


    public function getProgramas()
    {
        $programas = Http::get('https://app-poli-back.ilumno.com/api/app-cms/catalog?entityType=app-program&filters[app_program_type][code]='.$this->Tprograma.'&filters[app_modality][code]='.$this->modalidad)->json();
        $this->programas = $programas;
    }
}

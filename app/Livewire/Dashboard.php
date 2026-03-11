<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Proyecto;
use App\Models\Cliente;
use App\Models\Presupuesto;

class Dashboard extends Component
{
    public $activeProjects = 0;
    public $totalBudget = 0;
    public $averageProgress = 0;
    public $totalClientes = 0;

    public function mount()
    {
        $this->activeProjects = Proyecto::where('estado', 'en_progreso')->count();
        $this->totalBudget = Proyecto::sum('presupuesto');
        $this->totalClientes = Cliente::count();
        
        $proyectos = Proyecto::with('etapas')->get();
        $this->averageProgress = $proyectos->avg(function ($p) {
            return $p->etapas->avg('progreso') ?? 0;
        });
    }

    public function render()
    {
        return view('livewire.dashboard');
    }
}

<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Etapa;
use App\Models\Proyecto;

class Etapas extends Component
{
    use WithPagination;

    public $search = '';
    public $showModal = false;
    public $etapaId = null;
    public $proyecto_id = '';
    public $nombre = '';
    public $estado = 'pendiente';
    public $fecha_inicio = '';
    public $fecha_fin = '';
    public $progreso = 0;

    public function render()
    {
        $proyectos = Proyecto::all();
        $etapas = Etapa::with('proyecto')
            ->where('nombre', 'like', '%' . $this->search . '%')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('livewire.etapas', compact('etapas', 'proyectos'));
    }

    public function openModal()
    {
        $this->resetFields();
        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->resetFields();
    }

    public function resetFields()
    {
        $this->etapaId = null;
        $this->proyecto_id = '';
        $this->nombre = '';
        $this->estado = 'pendiente';
        $this->fecha_inicio = '';
        $this->fecha_fin = '';
        $this->progreso = 0;
    }

    public function store()
    {
        $this->validate([
            'proyecto_id' => 'required|exists:proyectos,id',
            'nombre' => 'required|string|max:255',
            'estado' => 'required|in:pendiente,en_progreso,completado',
            'progreso' => 'required|integer|min:0|max:100',
        ]);

        Etapa::create([
            'proyecto_id' => $this->proyecto_id,
            'nombre' => $this->nombre,
            'estado' => $this->estado,
            'fecha_inicio' => $this->fecha_inicio,
            'fecha_fin' => $this->fecha_fin,
            'progreso' => $this->progreso,
        ]);

        session()->flash('success', 'Etapa creada exitosamente.');
        $this->closeModal();
    }

    public function edit($id)
    {
        $etapa = Etapa::findOrFail($id);
        $this->etapaId = $id;
        $this->proyecto_id = $etapa->proyecto_id;
        $this->nombre = $etapa->nombre;
        $this->estado = $etapa->estado;
        $this->fecha_inicio = $etapa->fecha_inicio;
        $this->fecha_fin = $etapa->fecha_fin;
        $this->progreso = $etapa->progreso;
        $this->showModal = true;
    }

    public function update()
    {
        $this->validate([
            'proyecto_id' => 'required|exists:proyectos,id',
            'nombre' => 'required|string|max:255',
            'estado' => 'required|in:pendiente,en_progreso,completado',
            'progreso' => 'required|integer|min:0|max:100',
        ]);

        $etapa = Etapa::findOrFail($this->etapaId);
        $etapa->update([
            'proyecto_id' => $this->proyecto_id,
            'nombre' => $this->nombre,
            'estado' => $this->estado,
            'fecha_inicio' => $this->fecha_inicio,
            'fecha_fin' => $this->fecha_fin,
            'progreso' => $this->progreso,
        ]);

        session()->flash('success', 'Etapa actualizada exitosamente.');
        $this->closeModal();
    }

    public function updateProgress($id, $progress)
    {
        $etapa = Etapa::findOrFail($id);
        $etapa->update(['progreso' => $progress]);
        
        if ($progress == 100) {
            $etapa->update(['estado' => 'completado']);
        } elseif ($progress > 0) {
            $etapa->update(['estado' => 'en_progreso']);
        }
        
        session()->flash('success', 'Progreso actualizado.');
    }

    public function destroy($id)
    {
        Etapa::findOrFail($id)->delete();
        session()->flash('success', 'Etapa eliminada exitosamente.');
    }
}

<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Proyecto;
use App\Models\Cliente;

class Proyectos extends Component
{
    use WithPagination;

    public $search = '';
    public $showModal = false;
    public $proyectoId = null;
    public $cliente_id = '';
    public $nombre = '';
    public $descripcion = '';
    public $presupuesto = '';
    public $fecha_inicio = '';
    public $fecha_fin = '';
    public $estado = 'pendiente';
    public $ubicacion = '';

    public function render()
    {
        $clientes = Cliente::all();
        $proyectos = Proyecto::with('cliente')
            ->where('nombre', 'like', '%' . $this->search . '%')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('livewire.proyectos', compact('proyectos', 'clientes'));
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
        $this->proyectoId = null;
        $this->cliente_id = '';
        $this->nombre = '';
        $this->descripcion = '';
        $this->presupuesto = '';
        $this->fecha_inicio = '';
        $this->fecha_fin = '';
        $this->estado = 'pendiente';
        $this->ubicacion = '';
    }

    public function store()
    {
        $this->validate([
            'cliente_id' => 'required|exists:clientes,id',
            'nombre' => 'required|string|max:255',
            'presupuesto' => 'required|numeric',
            'fecha_inicio' => 'required|date',
            'estado' => 'required|in:pendiente,en_progreso,completado,cancelado',
        ]);

        Proyecto::create([
            'cliente_id' => $this->cliente_id,
            'nombre' => $this->nombre,
            'descripcion' => $this->descripcion,
            'presupuesto' => $this->presupuesto,
            'fecha_inicio' => $this->fecha_inicio,
            'fecha_fin' => $this->fecha_fin,
            'estado' => $this->estado,
            'ubicacion' => $this->ubicacion,
        ]);

        session()->flash('success', 'Proyecto creado exitosamente.');
        $this->closeModal();
    }

    public function edit($id)
    {
        $proyecto = Proyecto::findOrFail($id);
        $this->proyectoId = $id;
        $this->cliente_id = $proyecto->cliente_id;
        $this->nombre = $proyecto->nombre;
        $this->descripcion = $proyecto->descripcion;
        $this->presupuesto = $proyecto->presupuesto;
        $this->fecha_inicio = $proyecto->fecha_inicio;
        $this->fecha_fin = $proyecto->fecha_fin;
        $this->estado = $proyecto->estado;
        $this->ubicacion = $proyecto->ubicacion;
        $this->showModal = true;
    }

    public function update()
    {
        $this->validate([
            'cliente_id' => 'required|exists:clientes,id',
            'nombre' => 'required|string|max:255',
            'presupuesto' => 'required|numeric',
            'fecha_inicio' => 'required|date',
            'estado' => 'required|in:pendiente,en_progreso,completado,cancelado',
        ]);

        $proyecto = Proyecto::findOrFail($this->proyectoId);
        $proyecto->update([
            'cliente_id' => $this->cliente_id,
            'nombre' => $this->nombre,
            'descripcion' => $this->descripcion,
            'presupuesto' => $this->presupuesto,
            'fecha_inicio' => $this->fecha_inicio,
            'fecha_fin' => $this->fecha_fin,
            'estado' => $this->estado,
            'ubicacion' => $this->ubicacion,
        ]);

        session()->flash('success', 'Proyecto actualizado exitosamente.');
        $this->closeModal();
    }

    public function updateStatus($id, $status)
    {
        $proyecto = Proyecto::findOrFail($id);
        $proyecto->update(['estado' => $status]);
        session()->flash('success', 'Estado actualizado exitosamente.');
    }

    public function destroy($id)
    {
        Proyecto::findOrFail($id)->delete();
        session()->flash('success', 'Proyecto eliminado exitosamente.');
    }
}

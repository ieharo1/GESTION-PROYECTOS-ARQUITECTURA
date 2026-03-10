<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Presupuesto;
use App\Models\Proyecto;

class Presupuestos extends Component
{
    use WithPagination;

    public $search = '';
    public $showModal = false;
    public $presupuestoId = null;
    public $proyecto_id = '';
    public $descripcion = '';
    public $monto = '';
    public $fecha = '';

    public function render()
    {
        $proyectos = Proyecto::all();
        $presupuestos = Presupuesto::with('proyecto')
            ->where('descripcion', 'like', '%' . $this->search . '%')
            ->orderBy('fecha', 'desc')
            ->paginate(10);

        return view('livewire.presupuestos', compact('presupuestos', 'proyectos'));
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
        $this->presupuestoId = null;
        $this->proyecto_id = '';
        $this->descripcion = '';
        $this->monto = '';
        $this->fecha = '';
    }

    public function store()
    {
        $this->validate([
            'proyecto_id' => 'required|exists:proyectos,id',
            'monto' => 'required|numeric',
            'fecha' => 'required|date',
        ]);

        Presupuesto::create([
            'proyecto_id' => $this->proyecto_id,
            'descripcion' => $this->descripcion,
            'monto' => $this->monto,
            'fecha' => $this->fecha,
        ]);

        session()->flash('success', 'Presupuesto creado exitosamente.');
        $this->closeModal();
    }

    public function edit($id)
    {
        $presupuesto = Presupuesto::findOrFail($id);
        $this->presupuestoId = $id;
        $this->proyecto_id = $presupuesto->proyecto_id;
        $this->descripcion = $presupuesto->descripcion;
        $this->monto = $presupuesto->monto;
        $this->fecha = $presupuesto->fecha;
        $this->showModal = true;
    }

    public function update()
    {
        $this->validate([
            'proyecto_id' => 'required|exists:proyectos,id',
            'monto' => 'required|numeric',
            'fecha' => 'required|date',
        ]);

        $presupuesto = Presupuesto::findOrFail($this->presupuestoId);
        $presupuesto->update([
            'proyecto_id' => $this->proyecto_id,
            'descripcion' => $this->descripcion,
            'monto' => $this->monto,
            'fecha' => $this->fecha,
        ]);

        session()->flash('success', 'Presupuesto actualizado exitosamente.');
        $this->closeModal();
    }

    public function destroy($id)
    {
        Presupuesto::findOrFail($id)->delete();
        session()->flash('success', 'Presupuesto eliminado exitosamente.');
    }
}

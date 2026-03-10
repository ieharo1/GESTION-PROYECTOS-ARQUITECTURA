<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Material;

class Materiales extends Component
{
    use WithPagination;

    public $search = '';
    public $showModal = false;
    public $materialId = null;
    public $nombre = '';
    public $unidad = '';
    public $costo_unitario = '';

    public function render()
    {
        $materiales = Material::where('nombre', 'like', '%' . $this->search . '%')
            ->orderBy('nombre')
            ->paginate(10);

        return view('livewire.materiales', compact('materiales'));
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
        $this->materialId = null;
        $this->nombre = '';
        $this->unidad = '';
        $this->costo_unitario = '';
    }

    public function store()
    {
        $this->validate([
            'nombre' => 'required|string|max:255',
            'unidad' => 'required|string|max:50',
            'costo_unitario' => 'required|numeric',
        ]);

        Material::create([
            'nombre' => $this->nombre,
            'unidad' => $this->unidad,
            'costo_unitario' => $this->costo_unitario,
        ]);

        session()->flash('success', 'Material creado exitosamente.');
        $this->closeModal();
    }

    public function edit($id)
    {
        $material = Material::findOrFail($id);
        $this->materialId = $id;
        $this->nombre = $material->nombre;
        $this->unidad = $material->unidad;
        $this->costo_unitario = $material->costo_unitario;
        $this->showModal = true;
    }

    public function update()
    {
        $this->validate([
            'nombre' => 'required|string|max:255',
            'unidad' => 'required|string|max:50',
            'costo_unitario' => 'required|numeric',
        ]);

        $material = Material::findOrFail($this->materialId);
        $material->update([
            'nombre' => $this->nombre,
            'unidad' => $this->unidad,
            'costo_unitario' => $this->costo_unitario,
        ]);

        session()->flash('success', 'Material actualizado exitosamente.');
        $this->closeModal();
    }

    public function destroy($id)
    {
        Material::findOrFail($id)->delete();
        session()->flash('success', 'Material eliminado exitosamente.');
    }
}

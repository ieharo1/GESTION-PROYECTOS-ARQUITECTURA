<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Plano;
use App\Models\Proyecto;
use Illuminate\Support\Facades\Storage;

class Planos extends Component
{
    use WithPagination;

    public $search = '';
    public $showModal = false;
    public $planoId = null;
    public $proyecto_id = '';
    public $nombre = '';
    public $archivo = null;
    public $tipo = 'otro';

    public function render()
    {
        $proyectos = Proyecto::all();
        $planos = Plano::with('proyecto')
            ->where('nombre', 'like', '%' . $this->search . '%')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('livewire.planos', compact('planos', 'proyectos'));
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
        $this->planoId = null;
        $this->proyecto_id = '';
        $this->nombre = '';
        $this->archivo = null;
        $this->tipo = 'otro';
    }

    public function store()
    {
        $this->validate([
            'proyecto_id' => 'required|exists:proyectos,id',
            'nombre' => 'required|string|max:255',
            'archivo' => 'required|file|mimes:pdf,dwg,jpg,jpeg,png|max:20480',
            'tipo' => 'required|in:planta,elevacion,corte,fachada,otro',
        ]);

        $path = $this->archivo->store('planos', 'public');

        Plano::create([
            'proyecto_id' => $this->proyecto_id,
            'nombre' => $this->nombre,
            'archivo' => $path,
            'tipo' => $this->tipo,
        ]);

        session()->flash('success', 'Plano creado exitosamente.');
        $this->closeModal();
    }

    public function edit($id)
    {
        $plano = Plano::findOrFail($id);
        $this->planoId = $id;
        $this->proyecto_id = $plano->proyecto_id;
        $this->nombre = $plano->nombre;
        $this->tipo = $plano->tipo;
        $this->showModal = true;
    }

    public function update()
    {
        $rules = [
            'proyecto_id' => 'required|exists:proyectos,id',
            'nombre' => 'required|string|max:255',
            'tipo' => 'required|in:planta,elevacion,corte,fachada,otro',
        ];

        if ($this->archivo) {
            $rules['archivo'] = 'required|file|mimes:pdf,dwg,jpg,jpeg,png|max:20480';
        }

        $this->validate($rules);

        $plano = Plano::findOrFail($this->planoId);
        $data = [
            'proyecto_id' => $this->proyecto_id,
            'nombre' => $this->nombre,
            'tipo' => $this->tipo,
        ];

        if ($this->archivo) {
            if ($plano->archivo) {
                Storage::disk('public')->delete($plano->archivo);
            }
            $data['archivo'] = $this->archivo->store('planos', 'public');
        }

        $plano->update($data);

        session()->flash('success', 'Plano actualizado exitosamente.');
        $this->closeModal();
    }

    public function destroy($id)
    {
        $plano = Plano::findOrFail($id);
        if ($plano->archivo) {
            Storage::disk('public')->delete($plano->archivo);
        }
        $plano->delete();
        session()->flash('success', 'Plano eliminado exitosamente.');
    }

    public function download($id)
    {
        $plano = Plano::findOrFail($id);
        return response()->download(storage_path('app/public/' . $plano->archivo));
    }
}

<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Cliente;
use Illuminate\Support\Facades\Validator;

class Clientes extends Component
{
    use WithPagination;

    public $search = '';
    public $showModal = false;
    public $clienteId = null;
    public $nombre = '';
    public $cedula = '';
    public $telefono = '';
    public $email = '';
    public $direccion = '';

    protected $rules = [
        'nombre' => 'required|string|max:255',
        'cedula' => 'required|string|max:20|unique:clientes,cedula',
        'telefono' => 'required|string|max:20',
        'email' => 'required|email|unique:clientes,email',
        'direccion' => 'required|string',
    ];

    public function render()
    {
        $clientes = Cliente::where('nombre', 'like', '%' . $this->search . '%')
            ->orWhere('cedula', 'like', '%' . $this->search . '%')
            ->orWhere('email', 'like', '%' . $this->search . '%')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('livewire.clientes', compact('clientes'));
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
        $this->clienteId = null;
        $this->nombre = '';
        $this->cedula = '';
        $this->telefono = '';
        $this->email = '';
        $this->direccion = '';
    }

    public function store()
    {
        $this->validate();

        Cliente::create([
            'nombre' => $this->nombre,
            'cedula' => $this->cedula,
            'telefono' => $this->telefono,
            'email' => $this->email,
            'direccion' => $this->direccion,
        ]);

        session()->flash('success', 'Cliente creado exitosamente.');
        $this->closeModal();
    }

    public function edit($id)
    {
        $cliente = Cliente::findOrFail($id);
        $this->clienteId = $id;
        $this->nombre = $cliente->nombre;
        $this->cedula = $cliente->cedula;
        $this->telefono = $cliente->telefono;
        $this->email = $cliente->email;
        $this->direccion = $cliente->direccion;
        $this->showModal = true;
    }

    public function update()
    {
        $this->validate([
            'nombre' => 'required|string|max:255',
            'cedula' => 'required|string|max:20|unique:clientes,cedula,' . $this->clienteId,
            'telefono' => 'required|string|max:20',
            'email' => 'required|email|unique:clientes,email,' . $this->clienteId,
            'direccion' => 'required|string',
        ]);

        $cliente = Cliente::findOrFail($this->clienteId);
        $cliente->update([
            'nombre' => $this->nombre,
            'cedula' => $this->cedula,
            'telefono' => $this->telefono,
            'email' => $this->email,
            'direccion' => $this->direccion,
        ]);

        session()->flash('success', 'Cliente actualizado exitosamente.');
        $this->closeModal();
    }

    public function destroy($id)
    {
        Cliente::findOrFail($id)->delete();
        session()->flash('success', 'Cliente eliminado exitosamente.');
    }
}

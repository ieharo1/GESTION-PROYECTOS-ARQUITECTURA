<div>
    @if(session()->has('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2><i class="bi bi-people"></i> Clientes</h2>
        <button class="btn btn-primary" wire:click="openModal">
            <i class="bi bi-plus-circle"></i> Nuevo Cliente
        </button>
    </div>

    <div class="mb-3">
        <input type="text" class="form-control" placeholder="Buscar clientes..." wire:model="search">
    </div>

    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Cédula</th>
                    <th>Teléfono</th>
                    <th>Email</th>
                    <th>Dirección</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($clientes as $cliente)
                <tr>
                    <td>{{ $cliente->nombre }}</td>
                    <td>{{ $cliente->cedula }}</td>
                    <td>{{ $cliente->telefono }}</td>
                    <td>{{ $cliente->email }}</td>
                    <td>{{ $cliente->direccion }}</td>
                    <td>
                        <button class="btn btn-sm btn-warning" wire:click="edit({{ $cliente->id }})">
                            <i class="bi bi-pencil"></i>
                        </button>
                        <button class="btn btn-sm btn-danger" wire:click="destroy({{ $cliente->id }})" onclick="return confirm('¿Estás seguro?')">
                            <i class="bi bi-trash"></i>
                        </button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div>{{ $clientes->links() }}</div>

    @if($showModal)
    <div class="modal d-block" tabindex="-1" style="background: rgba(0,0,0,0.5);">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ $clienteId ? 'Editar' : 'Nuevo' }} Cliente</h5>
                    <button type="button" class="btn-close" wire:click="closeModal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label>Nombre</label>
                        <input type="text" class="form-control" wire:model="nombre">
                        @error('nombre') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-3">
                        <label>Cédula</label>
                        <input type="text" class="form-control" wire:model="cedula">
                        @error('cedula') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-3">
                        <label>Teléfono</label>
                        <input type="text" class="form-control" wire:model="telefono">
                        @error('telefono') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-3">
                        <label>Email</label>
                        <input type="email" class="form-control" wire:model="email">
                        @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-3">
                        <label>Dirección</label>
                        <textarea class="form-control" wire:model="direccion"></textarea>
                        @error('direccion') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" wire:click="closeModal">Cerrar</button>
                    <button type="button" class="btn btn-primary" wire:click="{{ $clienteId ? 'update' : 'store' }}">
                        {{ $clienteId ? 'Actualizar' : 'Guardar' }}
                    </button>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>

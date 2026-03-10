<div>
    @if(session()->has('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2><i class="bi bi-currency-dollar"></i> Presupuestos</h2>
        <button class="btn btn-primary" wire:click="openModal">
            <i class="bi bi-plus-circle"></i> Nuevo Presupuesto
        </button>
    </div>

    <div class="mb-3">
        <input type="text" class="form-control" placeholder="Buscar presupuestos..." wire:model="search">
    </div>

    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>Proyecto</th>
                    <th>Descripción</th>
                    <th>Monto</th>
                    <th>Fecha</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($presupuestos as $presupuesto)
                <tr>
                    <td>{{ $presupuesto->proyecto->nombre }}</td>
                    <td>{{ $presupuesto->descripcion }}</td>
                    <td>${{ number_format($presupuesto->monto, 2) }}</td>
                    <td>{{ $presupuesto->fecha }}</td>
                    <td>
                        <button class="btn btn-sm btn-warning" wire:click="edit({{ $presupuesto->id }})">
                            <i class="bi bi-pencil"></i>
                        </button>
                        <button class="btn btn-sm btn-danger" wire:click="destroy({{ $presupuesto->id }})" onclick="return confirm('¿Estás seguro?')">
                            <i class="bi bi-trash"></i>
                        </button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div>{{ $presupuestos->links() }}</div>

    @if($showModal)
    <div class="modal d-block" tabindex="-1" style="background: rgba(0,0,0,0.5);">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ $presupuestoId ? 'Editar' : 'Nuevo' }} Presupuesto</h5>
                    <button type="button" class="btn-close" wire:click="closeModal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label>Proyecto</label>
                        <select class="form-select" wire:model="proyecto_id">
                            <option value="">Seleccionar proyecto</option>
                            @foreach($proyectos as $proyecto)
                                <option value="{{ $proyecto->id }}">{{ $proyecto->nombre }}</option>
                            @endforeach
                        </select>
                        @error('proyecto_id') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-3">
                        <label>Descripción</label>
                        <textarea class="form-control" wire:model="descripcion"></textarea>
                    </div>
                    <div class="mb-3">
                        <label>Monto</label>
                        <input type="number" step="0.01" class="form-control" wire:model="monto">
                        @error('monto') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-3">
                        <label>Fecha</label>
                        <input type="date" class="form-control" wire:model="fecha">
                        @error('fecha') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" wire:click="closeModal">Cerrar</button>
                    <button type="button" class="btn btn-primary" wire:click="{{ $presupuestoId ? 'update' : 'store' }}">
                        {{ $presupuestoId ? 'Actualizar' : 'Guardar' }}
                    </button>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>

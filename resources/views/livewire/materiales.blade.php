<div>
    @if(session()->has('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2><i class="bi bi-box-seam"></i> Materiales</h2>
        <button class="btn btn-primary" wire:click="openModal">
            <i class="bi bi-plus-circle"></i> Nuevo Material
        </button>
    </div>

    <div class="mb-3">
        <input type="text" class="form-control" placeholder="Buscar materiales..." wire:model="search">
    </div>

    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Unidad</th>
                    <th>Costo Unitario</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($materiales as $material)
                <tr>
                    <td>{{ $material->nombre }}</td>
                    <td>{{ $material->unidad }}</td>
                    <td>${{ number_format($material->costo_unitario, 2) }}</td>
                    <td>
                        <button class="btn btn-sm btn-warning" wire:click="edit({{ $material->id }})">
                            <i class="bi bi-pencil"></i>
                        </button>
                        <button class="btn btn-sm btn-danger" wire:click="destroy({{ $material->id }})" onclick="return confirm('¿Estás seguro?')">
                            <i class="bi bi-trash"></i>
                        </button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div>{{ $materiales->links() }}</div>

    @if($showModal)
    <div class="modal d-block" tabindex="-1" style="background: rgba(0,0,0,0.5);">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ $materialId ? 'Editar' : 'Nuevo' }} Material</h5>
                    <button type="button" class="btn-close" wire:click="closeModal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label>Nombre</label>
                        <input type="text" class="form-control" wire:model="nombre">
                        @error('nombre') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-3">
                        <label>Unidad</label>
                        <input type="text" class="form-control" wire:model="unidad" placeholder="e.g., kg, m, pieza">
                        @error('unidad') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-3">
                        <label>Costo Unitario</label>
                        <input type="number" step="0.01" class="form-control" wire:model="costo_unitario">
                        @error('costo_unitario') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" wire:click="closeModal">Cerrar</button>
                    <button type="button" class="btn btn-primary" wire:click="{{ $materialId ? 'update' : 'store' }}">
                        {{ $materialId ? 'Actualizar' : 'Guardar' }}
                    </button>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>

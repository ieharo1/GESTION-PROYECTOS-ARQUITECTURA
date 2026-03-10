<div>
    @if(session()->has('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2><i class="bi bi-file-earmark-ruled"></i> Planos</h2>
        <button class="btn btn-primary" wire:click="openModal">
            <i class="bi bi-plus-circle"></i> Nuevo Plano
        </button>
    </div>

    <div class="mb-3">
        <input type="text" class="form-control" placeholder="Buscar planos..." wire:model="search">
    </div>

    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Proyecto</th>
                    <th>Tipo</th>
                    <th>Archivo</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($planos as $plano)
                <tr>
                    <td>{{ $plano->nombre }}</td>
                    <td>{{ $plano->proyecto->nombre }}</td>
                    <td>{{ ucfirst($plano->tipo) }}</td>
                    <td>
                        @if($plano->archivo)
                            <a href="{{ asset('storage/' . $plano->archivo) }}" target="_blank" class="btn btn-sm btn-info">
                                <i class="bi bi-download"></i> Ver
                            </a>
                        @else
                            <span class="text-muted">Sin archivo</span>
                        @endif
                    </td>
                    <td>
                        <button class="btn btn-sm btn-warning" wire:click="edit({{ $plano->id }})">
                            <i class="bi bi-pencil"></i>
                        </button>
                        <button class="btn btn-sm btn-danger" wire:click="destroy({{ $plano->id }})" onclick="return confirm('¿Estás seguro?')">
                            <i class="bi bi-trash"></i>
                        </button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div>{{ $planos->links() }}</div>

    @if($showModal)
    <div class="modal d-block" tabindex="-1" style="background: rgba(0,0,0,0.5);">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ $planoId ? 'Editar' : 'Nuevo' }} Plano</h5>
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
                        <label>Nombre</label>
                        <input type="text" class="form-control" wire:model="nombre">
                        @error('nombre') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-3">
                        <label>Tipo</label>
                        <select class="form-select" wire:model="tipo">
                            <option value="planta">Planta</option>
                            <option value="elevacion">Elevación</option>
                            <option value="corte">Corte</option>
                            <option value="fachada">Fachada</option>
                            <option value="otro">Otro</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label>Archivo</label>
                        <input type="file" class="form-control" wire:model="archivo">
                        @error('archivo') <span class="text-danger">{{ $message }}</span> @enderror
                        @if($planoId)
                            <small class="text-muted">Dejar vacío para mantener el archivo actual</small>
                        @endif
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" wire:click="closeModal">Cerrar</button>
                    <button type="button" class="btn btn-primary" wire:click="{{ $planoId ? 'update' : 'store' }}">
                        {{ $planoId ? 'Actualizar' : 'Guardar' }}
                    </button>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>

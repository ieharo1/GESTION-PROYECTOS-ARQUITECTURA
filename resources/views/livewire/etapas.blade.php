<div>
    @if(session()->has('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2><i class="bi bi-list-task"></i> Etapas</h2>
        <button class="btn btn-primary" wire:click="openModal">
            <i class="bi bi-plus-circle"></i> Nueva Etapa
        </button>
    </div>

    <div class="mb-3">
        <input type="text" class="form-control" placeholder="Buscar etapas..." wire:model="search">
    </div>

    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Proyecto</th>
                    <th>Estado</th>
                    <th>Progreso</th>
                    <th>Inicio</th>
                    <th>Fin</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($etapas as $etapa)
                <tr>
                    <td>{{ $etapa->nombre }}</td>
                    <td>{{ $etapa->proyecto->nombre }}</td>
                    <td>
                        <span class="badge bg-{{ $etapa->estado == 'completado' ? 'success' : ($etapa->estado == 'en_progreso' ? 'primary' : 'warning') }}">
                            {{ ucfirst($etapa->estado) }}
                        </span>
                    </td>
                    <td>
                        <div class="progress" style="height: 20px;">
                            <div class="progress-bar" role="progressbar" style="width: {{ $etapa->progreso }}%">
                                {{ $etapa->progreso }}%
                            </div>
                        </div>
                    </td>
                    <td>{{ $etapa->fecha_inicio }}</td>
                    <td>{{ $etapa->fecha_fin }}</td>
                    <td>
                        <button class="btn btn-sm btn-warning" wire:click="edit({{ $etapa->id }})">
                            <i class="bi bi-pencil"></i>
                        </button>
                        <button class="btn btn-sm btn-danger" wire:click="destroy({{ $etapa->id }})" onclick="return confirm('¿Estás seguro?')">
                            <i class="bi bi-trash"></i>
                        </button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div>{{ $etapas->links() }}</div>

    @if($showModal)
    <div class="modal d-block" tabindex="-1" style="background: rgba(0,0,0,0.5);">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ $etapaId ? 'Editar' : 'Nueva' }} Etapa</h5>
                    <button type="button" class="btn-close" wire:click="closeModal"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label>Proyecto</label>
                            <select class="form-select" wire:model="proyecto_id">
                                <option value="">Seleccionar proyecto</option>
                                @foreach($proyectos as $proyecto)
                                    <option value="{{ $proyecto->id }}">{{ $proyecto->nombre }}</option>
                                @endforeach
                            </select>
                            @error('proyecto_id') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Nombre</label>
                            <input type="text" class="form-control" wire:model="nombre">
                            @error('nombre') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label>Estado</label>
                            <select class="form-select" wire:model="estado">
                                <option value="pendiente">Pendiente</option>
                                <option value="en_progreso">En Progreso</option>
                                <option value="completado">Completado</option>
                            </select>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label>Fecha Inicio</label>
                            <input type="date" class="form-control" wire:model="fecha_inicio">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label>Fecha Fin</label>
                            <input type="date" class="form-control" wire:model="fecha_fin">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label>Progreso: {{ $progreso }}%</label>
                        <input type="range" class="form-range" min="0" max="100" wire:model="progreso">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" wire:click="closeModal">Cerrar</button>
                    <button type="button" class="btn btn-primary" wire:click="{{ $etapaId ? 'update' : 'store' }}">
                        {{ $etapaId ? 'Actualizar' : 'Guardar' }}
                    </button>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>

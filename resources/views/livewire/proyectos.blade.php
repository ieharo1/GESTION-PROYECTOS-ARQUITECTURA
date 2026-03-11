<div>
    @if(session()->has('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2><i class="bi bi-folder"></i> Proyectos</h2>
        <button class="btn btn-primary" wire:click="openModal">
            <i class="bi bi-plus-circle"></i> Nuevo Proyecto
        </button>
    </div>

    <div class="mb-3">
        <input type="text" class="form-control" placeholder="Buscar proyectos..." wire:model="search">
    </div>

    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Cliente</th>
                    <th>Presupuesto</th>
                    <th>Inicio</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($proyectos as $proyecto)
                <tr>
                    <td>{{ $proyecto->nombre }}</td>
                    <td>{{ $proyecto->cliente->nombre }}</td>
                    <td>${{ number_format($proyecto->presupuesto, 2) }}</td>
                    <td>{{ $proyecto->fecha_inicio }}</td>
                    <td>
                        <span class="badge bg-{{ $proyecto->estado == 'completado' ? 'success' : ($proyecto->estado == 'en_progreso' ? 'primary' : ($proyecto->estado == 'cancelado' ? 'danger' : 'warning')) }}">
                            {{ ucfirst($proyecto->estado) }}
                        </span>
                    </td>
                    <td>
                        <div class="dropdown">
                            <button class="btn btn-sm btn-secondary dropdown-toggle" data-bs-toggle="dropdown">
                                Estado
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#" wire:click="updateStatus({{ $proyecto->id }}, 'pendiente')">Pendiente</a></li>
                                <li><a class="dropdown-item" href="#" wire:click="updateStatus({{ $proyecto->id }}, 'en_progreso')">En Progreso</a></li>
                                <li><a class="dropdown-item" href="#" wire:click="updateStatus({{ $proyecto->id }}, 'completado')">Completado</a></li>
                                <li><a class="dropdown-item" href="#" wire:click="updateStatus({{ $proyecto->id }}, 'cancelado')">Cancelado</a></li>
                            </ul>
                        </div>
                        <button class="btn btn-sm btn-warning" wire:click="edit({{ $proyecto->id }})">
                            <i class="bi bi-pencil"></i>
                        </button>
                        <button class="btn btn-sm btn-danger" wire:click="destroy({{ $proyecto->id }})" onclick="return confirm('¿Estás seguro?')">
                            <i class="bi bi-trash"></i>
                        </button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div>{{ $proyectos->links() }}</div>

    @if($showModal)
    <div class="modal d-block" tabindex="-1" style="background: rgba(0,0,0,0.5);">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ $proyectoId ? 'Editar' : 'Nuevo' }} Proyecto</h5>
                    <button type="button" class="btn-close" wire:click="closeModal"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label>Cliente</label>
                            <select class="form-select" wire:model="cliente_id">
                                <option value="">Seleccionar cliente</option>
                                @foreach($clientes as $cliente)
                                    <option value="{{ $cliente->id }}">{{ $cliente->nombre }}</option>
                                @endforeach
                            </select>
                            @error('cliente_id') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Nombre</label>
                            <input type="text" class="form-control" wire:model="nombre">
                            @error('nombre') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="mb-3">
                        <label>Descripción</label>
                        <textarea class="form-control" wire:model="descripcion"></textarea>
                    </div>
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label>Presupuesto</label>
                            <input type="number" step="0.01" class="form-control" wire:model="presupuesto">
                            @error('presupuesto') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-md-4 mb-3">
                            <label>Fecha Inicio</label>
                            <input type="date" class="form-control" wire:model="fecha_inicio">
                            @error('fecha_inicio') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-md-4 mb-3">
                            <label>Fecha Fin</label>
                            <input type="date" class="form-control" wire:model="fecha_fin">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label>Estado</label>
                            <select class="form-select" wire:model="estado">
                                <option value="pendiente">Pendiente</option>
                                <option value="en_progreso">En Progreso</option>
                                <option value="completado">Completado</option>
                                <option value="cancelado">Cancelado</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Ubicación</label>
                            <input type="text" class="form-control" wire:model="ubicacion">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" wire:click="closeModal">Cerrar</button>
                    <button type="button" class="btn btn-primary" wire:click="{{ $proyectoId ? 'update' : 'store' }}">
                        {{ $proyectoId ? 'Actualizar' : 'Guardar' }}
                    </button>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>

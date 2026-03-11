<div>
    @if(session()->has('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <h2 class="mb-4"><i class="bi bi-speedometer2"></i> Dashboard</h2>

    <div class="row">
        <div class="col-md-3">
            <div class="card text-white bg-primary mb-3">
                <div class="card-body">
                    <h5 class="card-title"><i class="bi bi-folder"></i> Proyectos Activos</h5>
                    <p class="card-text display-4">{{ $activeProjects }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-success mb-3">
                <div class="card-body">
                    <h5 class="card-title"><i class="bi bi-currency-dollar"></i> Presupuesto Total</h5>
                    <p class="card-text display-4">${{ number_format($totalBudget, 2) }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-info mb-3">
                <div class="card-body">
                    <h5 class="card-title"><i class="bi bi-people"></i> Clientes</h5>
                    <p class="card-text display-4">{{ $totalClientes }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-warning mb-3">
                <div class="card-body">
                    <h5 class="card-title"><i class="bi bi-graph-up"></i> Progreso Promedio</h5>
                    <p class="card-text display-4">{{ number_format($averageProgress, 1) }}%</p>
                </div>
            </div>
        </div>
    </div>
</div>

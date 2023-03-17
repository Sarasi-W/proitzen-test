@extends('layouts.list')

@section('list-content')
    <div class="row justify-content-center">
        <div class="col-md">
            <div class="row">
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-info p-3 rounded">
                        <div>
                            <h3>{{ \App\Models\Employee::count()}}</h3>
                            <p>Employees</p>
                        </div>
                        <hr>
                        <div class="icon">
                            <i class="ion ion-stats-bars"></i>
                        </div>
                        <a href="{{ route('employees.index') }}" class="small-box-footer">
                            More info 
                            <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>

                <div class="col-lg-3 col-6">
                    <div class="small-box bg-warning p-3 rounded">
                        <div>
                            <h3>{{ \App\Models\Salary::count()}}</h3>
                            <p>Salary Records</p>
                        </div>
                        <hr>
                        <div class="icon">
                            <i class="ion ion-stats-bars"></i>
                        </div>
                        <a href="{{ route('salaries.index') }}" class="small-box-footer">
                            More info 
                            <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>

                <div class="col-lg-3 col-6">
                    <div class="small-box bg-success p-3 rounded">
                        <div>
                            <h3>{{ \App\Models\Title::count()}}</h3>
                            <p>Title Records</p>
                        </div>
                        <hr>
                        <div class="icon">
                            <i class="ion ion-stats-bars"></i>
                        </div>
                        <a href="{{ route('titles.index') }}" class="small-box-footer text-white">
                            More info 
                            <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

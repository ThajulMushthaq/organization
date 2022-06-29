@extends('include.template')

@section('content')
    <div class="card">
        <div class="card-header">
            <h4>{{ ucfirst(auth()->user()->type) }} Dashboard</h4>
        </div>
        <div class="card-body">
            <div class="row">
                @if (Session::has('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Error!</strong>{{ Session::get('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                <h5 class="text-primary">Welcome {{ auth()->user()->name }}</h5>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label class="text-muted">Your Emil Id</label>
                    </div>
                </div>
                <div class="col-sm-9">
                    <div class="form-group">
                        {{ auth()->user()->email }}
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label class="text-muted">Your Phone Number</label>
                    </div>
                </div>
                <div class="col-sm-9">
                    <div class="form-group">
                        {{ auth()->user()->phone }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@extends('layouts.app')

@section('content')
    <h1>Crud Manager</h1>

    <div class="card">
        <div class="card-body">
            <h2>Create Model</h2>

            <form action="{{ route('generator.createModel') }}" method="post">
                @csrf

                <div class="mb-3">
                    <label for="modelName" class="form-label">Model Name:</label>
                    <input type="text" class="form-control" id="modelName" name="modelName" required>
                </div>

                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="generateController" name="generateController">
                    <label class="form-check-label" for="generateController">Generate Controller</label>
                </div>

                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="generateMigration" name="generateMigration">
                    <label class="form-check-label" for="generateMigration">Generate Migration</label>
                </div>

                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="generateValidation" name="generateValidation">
                    <label class="form-check-label" for="generateValidation">Generate Validation</label>
                </div>

                <button type="submit" class="btn btn-primary">Generate</button>
            </form>
        </div>
    </div>
@endsection

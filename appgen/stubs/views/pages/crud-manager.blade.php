@extends('layouts.app')

@section('content')

    <div class="card">
        <div class="card-header">Create Model</div>
        <div class="card-body">
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

                <div class="mb-3">
                    <label for="numFields" class="form-label">Field count without id and timestamps:</label>
                    <input type="number" class="form-control" id="numFields" name="numFields" required>
                </div>

                <div class="mb-3">
                    <button type="button" class="btn btn-primary" onclick="generateDynamicFields()">Buat Field</button>
                </div>

                <div id="dynamicFieldsContainer" class="mb-3"></div>

                <button type="submit" class="btn btn-primary">Generate</button>
            </form>
        </div>
    </div>

    @push('script')
        <script>
            function generateDynamicFields() {
                var numFields = document.getElementById('numFields').value;
                var container = document.getElementById('dynamicFieldsContainer');
                container.innerHTML = '';

                var dataTypes = ['string', 'text', 'integer', 'bigInteger', 'unsignedBigInteger', 'float', 'double', 'boolean', 'date', 'dateTime', 'time', 'timestamp', 'json', 'jsonb'];

                for (var i = 0; i < numFields; i++) {
                    var fieldContainer = document.createElement('div');
                    fieldContainer.className = 'mb-3 d-flex align-items-center';

                    var fieldNameInput = document.createElement('input');
                    fieldNameInput.type = 'text';
                    fieldNameInput.className = 'form-control mr-2';
                    fieldNameInput.name = 'fields[' + i + '][name]'; // Ganti 'type' ke 'name'

                    var fieldTypeSelect = document.createElement('select');
                    fieldTypeSelect.className = 'form-control mr-2';
                    fieldTypeSelect.name = 'fields[' + i + '][type]';

                    // Tambahkan pilihan tipe data ke dropdown
                    for (var j = 0; j < dataTypes.length; j++) {
                        var option = document.createElement('option');
                        option.value = dataTypes[j];
                        option.text = dataTypes[j];
                        fieldTypeSelect.appendChild(option);
                    }

                    var checkboxRequired = document.createElement('input');
                    checkboxRequired.type = 'checkbox';
                    checkboxRequired.className = 'form-check-input';
                    checkboxRequired.id = 'fieldRequired_' + i;

                    var labelRequired = document.createElement('label');
                    labelRequired.className = 'form-check-label ml-2';
                    labelRequired.htmlFor = 'fieldRequired_' + i;
                    labelRequired.appendChild(document.createTextNode('Required'));

                    fieldContainer.appendChild(fieldNameInput);
                    fieldContainer.appendChild(fieldTypeSelect);
                    fieldContainer.appendChild(checkboxRequired);
                    fieldContainer.appendChild(labelRequired);

                    container.appendChild(fieldContainer);
                }
            }
        </script>

    @endpush
@endsection

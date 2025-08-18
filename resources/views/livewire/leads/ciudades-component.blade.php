<div class="col-md-12">
    <div class="row">
        <div class="col-md-6">
            <label for="ilu_depcolombia">Departamento:</label>
            <select name="ilu_depcolombia" id="ilu_depcolombia" wire:model.change="departamento" class="form-control">
                <option value="">Seleccionar</option>
                @foreach ($departamentos as $departamento)
                    <option value="{{ $departamento['code'] }}">{{ $departamento['label'] }}</option>
                @endforeach
            </select>
        </div>
    
        <div class="col-md-6">
            <label for="ilu_cityofresidencecolombia">Ciudad:</label>
            <select name="ilu_cityofresidencecolombia" id="ilu_cityofresidencecolombia" class="form-control">
                @foreach ($ciudades as $ciudad)
                    <option value="{{ $ciudad['code'] }}">{{ $ciudad['label'] }}</option>
                @endforeach
            </select>
        </div>
    </div>
</div>

<div class="col-md-12">
    <div class="row gy-2">
        <div class="col-6">
            <select name="ilu_depcolombia" id="ilu_depcolombia" wire:model.change="departamento" class="form-control" placeholder="DEPARTAMENTO">
                <option value="">Seleccionar</option>
                @foreach ($departamentos as $departamento)
                    <option value="{{ $departamento['code'] }}">{{ $departamento['label'] }}</option>
                @endforeach
            </select>
        </div>

        <div class="col-6">
            <select name="ilu_cityofresidencecolombia" id="ilu_cityofresidencecolombia" class="form-control" placeholder="CIUDAD">
                <option value="">CIUDAD</option>
                @foreach ($ciudades as $ciudad)
                    <option value="{{ $ciudad['code'] }}">{{ $ciudad['label'] }}</option>
                @endforeach
            </select>
        </div>

        <div class="col-6">
            <select name="ilu_opportunitytype" id="ilu_opportunitytype" wire:model.change="Tprograma" class="form-control" placeholder="TIPO DE PROGRAMA">
                <option value="">TIPO DE PROGRAMA</option>
                @foreach ($tipos_programa as $Tprograma)
                    <option value="{{ $Tprograma['code'] }}">{{ $Tprograma['label'] }}</option>
                @endforeach
            </select>
        </div>

        <div class="col-6">
            <select name="modality" id="modality" wire:model.change="modalidad" class="form-control" placeholder="MODALIDAD">
                <option value="">MODALIDAD</option>
                @foreach ($modalidades as $modalidad)
                    <option value="{{ $modalidad['code'] }}">{{ $modalidad['label'] }}</option>
                @endforeach
            </select>
        </div>

        <div class="col-12">
            <select name="program" id="programa" wire:model.change="programa" class="form-control" placeholder="PROGRAMA DE INTERÉS">
                <option value="">PROGRAMA DE INTERÉS</option>
                @foreach ($programas as $programa)
                    <option value="{{ $programa['code'] }}">{{ $programa['label'] }}</option>
                @endforeach
            </select>
        </div>
    </div>
</div>

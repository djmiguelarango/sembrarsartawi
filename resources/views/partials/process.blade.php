<input type="hidden" id="_mc" name="_mc"
       value="{{ route('de.fa.mc.create', ['rp_id' => $rp_id, 'id' => encode($fa->id)]) }}">

<div class="form-group">
    <label class="control-label col-lg-3 label_required">Aprobado: </label>
    <div class="col-lg-9">
        <div class="input-group">
            <label class="radio-inline">
                {!! Form::radio('approved', 1, false, [
                    'ng-click' => 'approved = true; state = false; observation = true; mcEnabled = false;',
                    'ng-model' => 'formData.approved'
                ]) !!}
                SI
            </label>
            <label class="radio-inline">
                {!! Form::radio('approved', 0, false, [
                    'ng-click' => 'approved = false; state = false; observation = true; mcEnabled = false;',
                    'ng-model' => 'formData.approved'
                ]) !!}
                NO
            </label>
            <label class="radio-inline">
                {!! Form::radio('approved', 2, false, [
                    'ng-click' => 'approved = false; state = true;',
                    'ng-model' => 'formData.approved'
                ]) !!}
                Pendiente
            </label>
        </div>
        <label id="location-error" class="validation-error-label" for="location" ng-show="errors.approved">
            @{{ errors.approved[0] }}
        </label>
    </div>
</div>

<div class="animated" ng-show="approved" ng-class="{ fadeIn: approved, fadeOut: !approved }">
    <div class="form-group">
        <label class="control-label col-lg-3 label_required">Tasa de Racargo: </label>
        <div class="col-lg-9">
            <div class="input-group">
                <label class="radio-inline">
                    {!! Form::radio('surcharge', 1, false, [
                        'ng-click' => 'surcharge=true;',
                        'ng-model' => 'formData.surcharge'
                    ]) !!}
                    SI
                </label>
                <label class="radio-inline">
                    {!! Form::radio('surcharge', 0, false, [
                        'ng-click' => 'surcharge=false;',
                        'ng-model' => 'formData.surcharge'
                    ]) !!}
                    NO
                </label>
            </div>
            <label id="location-error" class="validation-error-label" for="location"
                   ng-show="errors.surcharge">
                @{{ errors.surcharge[0] }}
            </label>
        </div>
    </div>

    <div class="animated" ng-show="surcharge" ng-class="{ fadeIn: surcharge, fadeOut: !surcharge }">
        <div class="form-group">
            <label class="control-label col-lg-3 label_required">Porcentaje de Recargo: </label>
            <div class="col-lg-9">
                <div class="input-group">
                    <span class="input-group-addon"><i class="icon-user-plus"></i></span>
                    {!! Form::text('percentage', null, [
                        'class'        => 'form-control',
                        'placeholder'  => 'Porcentaje de Recargo',
                        'autocomplete' => 'off',
                        'ng-model'     => 'formData.percentage',
                        'ng-keyup'     => 'finalRate()',
                    ]) !!}
                </div>
                <label id="location-error" class="validation-error-label" for="location"
                       ng-show="errors.percentage">
                    @{{ errors.percentage[0] }}
                </label>
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-lg-3 label_required">Tasa Actual: </label>
            <div class="col-lg-9">
                <div class="input-group">
                    <span class="input-group-addon"><i class="icon-user-plus"></i></span>
                    {!! Form::text('current_rate', null, [
                        'class'        => 'form-control',
                        'placeholder'  => 'Tasa Actual',
                        'autocomplete' => 'off',
                        'ng-model'     => 'formData.current_rate',
                        'readonly'     => true
                    ]) !!}
                </div>
                <label id="location-error" class="validation-error-label" for="location"
                       ng-show="errors.current_rate">
                    @{{ errors.current_rate[0] }}
                </label>
            </div>
        </div>
    </div>

    <div class="form-group">
        <label class="control-label col-lg-3 label_required">Tasa Final: </label>
        <div class="col-lg-9">
            <div class="input-group">
                <span class="input-group-addon"><i class="icon-user-plus"></i></span>
                {!! Form::text('final_rate', null, [
                    'class'            => 'form-control',
                    'placeholder'      => 'Tasa Final',
                    'autocomplete'     => 'off',
                    'ng-model'         => 'formData.final_rate',
                    'readonly'         => true
                ]) !!}
            </div>
            <label id="location-error" class="validation-error-label" for="location"
                   ng-show="errors.final_rate">
                @{{ errors.final_rate[0] }}
            </label>
        </div>
    </div>

</div>

<div class="animated" ng-show="state" ng-class="{ fadeIn: state, fadeOut: !state }">
    <div class="form-group">
        <label class="col-lg-3 control-label label_required">Estado: </label>
        <div class="col-lg-9">
            <div class="input-group">
                <select ng-init="formData.state=currentOption"
                        ng-options="item as item.name for item in dataOptions track by item.id"
                        ng-model="currentOption" class="form-control" ng-change="stateChange()">
                </select>
            </div>
            <label id="location-error" class="validation-error-label" for="location" ng-show="errors.state">
                @{{ errors.state[0] }}
            </label>
        </div>
    </div>
</div>

<div class="form-group animated" ng-show="observation"
     ng-class="{ fadeIn: observation, fadeOut: !observation }">
    <label class="control-label col-lg-3 label_required">Observaciones: </label>
    <div class="col-lg-9">
        <div>
            {!! Form::textarea('observation', null, [
                'size'         => '4x4',
                'class'        => 'form-control',
                'placeholder'  => 'Observaciones',
                'autocomplete' => 'off',
                'ng-model'     => 'formData.observation'
            ]) !!}
        </div>
        <label id="location-error" class="validation-error-label" for="location"
               ng-show="errors.observation">
            @{{ errors.observation[0] }}
        </label>
    </div>
</div>

@if(isset($product))
    @if($product === 'au')
        <label class="col-lg-3 control-label text-regular">Vehículo: </label>
        <span class="col-lg-9 control-label text-bold">{{ $fa->detail->vehicleType->vehicle }}</span>
        <br>
        <label class="col-lg-3 control-label text-regular">Marca: </label>
        <span class="col-lg-9 control-label text-bold">{{ $fa->detail->vehicleMake->make }}</span>
        <br>
        <label class="col-lg-3 control-label text-regular">Modelo: </label>
        <span class="col-lg-9 control-label text-bold">{{ $fa->detail->vehicleModel->model }}</span>
        <br>
        <label class="col-lg-3 control-label text-regular">Placa: </label>
        <span class="col-lg-9 control-label text-bold">{{ $fa->detail->license_plate }}</span>
    @endif
    @if($product === 'td')
        <label class="col-lg-3 control-label text-regular">Tipo de Inmueble: </label>
        <span class="col-lg-9 control-label text-bold">{{ config('base.property_types.' . $fa->detail->matter_insured) }}</span>
        <br>
        <label class="col-lg-3 control-label text-regular">Descripcion: </label>
        <span class="col-lg-9 control-label text-bold">{{ $fa->detail->matter_description }}</span>
    @endif
@endif

<div class="form-group">
    <label class="control-label col-lg-12 label_required">Envie la aprobación vía correo
        electrónico: </label>
    <br>
    <div class="col-lg-12">
        {!! Form::text('emails', null, [
            'class'        => 'form-control ',
            'placeholder'  => 'mail@email.com',
            'autocomplete' => 'off',
            'ng-model'     => 'formData.emails',
        ]) !!}
        <div class="input-group">
            <label id="location-error" class="validation-error-label" for="location"
                   ng-show="errors.emails">
                @{{ errors.emails[0] }}
            </label>
        </div>
    </div>
</div>

<div class="text-right">
    <script ng-if="success.facultative">
        $(function () {
            messageAction('succes', 'El caso facultativo se proceso correctamente');
        });
    </script>

    <button type="button" class="btn border-slate text-slate-800 btn-flat" data-dismiss="modal">Cancelar
    </button>

    {!! Form::button('Guardar <i class="icon-floppy-disk position-right"></i>', ['type' => 'submit', 'class' => 'btn btn-primary']) !!}
</div>
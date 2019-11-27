{{-- Blade para select de cargo --}}

@if (isset($Model) && $Model->roles)

<!-- Select de roles  -->
<div class="form-group">
    {!! Form::label('roles', 'Cargo') !!} <br>
    {!! Form::select('role_id', $roles, $Model->roles->first()->id, ['class' => "form-control select2 ". ( isset($classesExtras) ? $classesExtras : '' )]
    ) !!}
</div>

@else

<!-- Select de roles  -->
<div class="form-group">
    {!! Form::label('roles', 'Cargo') !!} <br>
    {!! Form::select('role_id', [''=>'']+$roles, \Request::get('role_id'), ['class' => "form-control select2 ". ( isset($classesExtras) ? $classesExtras : ''  ) ]
    ) !!}
</div>

@endif

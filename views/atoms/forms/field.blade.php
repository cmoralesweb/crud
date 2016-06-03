@if($field instanceof FormManager\Containers\Group)
    @if(empty($panel))
        @foreach($field as $secondaryField)
            @include('anavel-crud::atoms.forms.field', ['field' => $secondaryField])
        @endforeach
    @else
        <div class="panel panel-default">
            <div class="panel-heading" role="tab">
                <h4 class="panel-title">
                    <a role="button" data-toggle="collapse" href="#{{ $relation->getName() . $key }}"
                       aria-expanded="true" aria-controls="{{ $relation->getName() . $key }}" id="label-{{ $relation->getName() . $key }}">
                        {{ ucfirst($relation->getName()) . ' ' . $key }} {{ $relation->getName() }}
                    </a>
                </h4>
            </div>
            <div id="{{ $relationKey . $key }}" class="panel-collapse collapse in" role="tabpanel"
                 aria-labelledby="label-{{ $relationKey . $key }}">
                <div class="panel-body">
                    @foreach($field as $secondaryField)
                        @include('anavel-crud::atoms.forms.field', ['field' => $secondaryField, 'panel' => false])
                    @endforeach
                </div>
            </div>
        </div>
    @endif
@else
    <div class="form-group {{ $field instanceof FormManager\Fields\File && ! empty($field->val()) ? 'input-group' : '' }}">
        @if($field->attr('type') != 'hidden')
            <label for="{{ $field->attr('id') }}"
                   class="col-sm-2 control-label">{{ $field->label->html() }}{{ $field->attr('required') ? ' *' : '' }}</label>
        @endif

        <div class="col-sm-10">
            {!! $field->input !!}
        </div>

        @if($field instanceof FormManager\Fields\File && ! empty($field->val()))

            <span class="input-group-btn"><a href="{{  url(config('anavel-crud.uploads_path')) . '/' . $field->val() }}"
                                             target="_blank" class="btn btn-primary"><i
                            class="glyphicon glyphicon-eye-open"></i></a></span>

        @endif
    </div>
@endif
@extends('layouts.app')

@section('body')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">

                <div class="card shadow-sm border-0">
                    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                        <h6 class="mb-0"><i class="fas fa-user-shield me-2"></i>{{ __('messages.NewRole') }}</h6>
                        <a href="{{ route('role_list') }}" class="btn btn-sm btn-light">
                            <i class="fas fa-list"></i> {{ __('messages.RoleList') }}
                        </a>
                    </div>

                    <div class="card-body">
                        @include('layouts.message')

                        {{ html()
                            ->form('POST', route('role_store'))
                            ->attribute('enctype', 'multipart/form-data')
                            ->attribute('files', true)
                            ->attribute('autocomplete', 'off')
                            ->open()
                        }}

                        {{-- Role Info --}}
                        <div class="card mb-4 border-0 shadow-sm">
                            <div class="card-body">
                                <h5 class="card-title mb-3 text-primary">
                                    <i class="fas fa-id-card me-2"></i>{{ __('messages.BasicInformation') }}
                                </h5>
                                <div class="row mb-3">
                                    <div class="col-md-2">
                                        <label class="form-label fw-bold">{{ __('messages.Name') }} <span class="textRed">*</span></label>
                                    </div>
                                    <div class="col-md-6">
                                        {{ html()->text('name')->class('form-control')->placeholder(__('messages.name'))->required() }}
                                        <small class="textRed">{!! $errors->first('name') !!}</small>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Permissions --}}
                        {{--<div class="card mb-4 border-0 shadow-sm">
                            <div class="card-body">
                                <h5 class="card-title mb-3 text-primary">
                                    <i class="fas fa-lock me-2"></i>{{ __('messages.Permission') }}
                                </h5>
                                @foreach ($permissions as $module => $modulePermissions)
                                    <div class="mb-3">
                                        <h6 class="fw-bold text-secondary border-bottom pb-1">{{ $module }}</h6>
                                        <div class="row">
                                            @foreach ($modulePermissions as $perm)
                                                <div class="col-md-3 mb-2">
                                                    <div class="form-check form-switch">
                                                        {{ html()->checkbox('permissions[]', false, $perm->id)->id('perm_'.$perm->id)->class('form-check-input') }}
                                                        {{ html()->label($perm->name)->for('perm_'.$perm->id)->class('form-check-label') }}
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endforeach
                                <small class="textRed">{!! $errors->first('permission') !!}</small>
                            </div>
                        </div>--}}

                        {{-- Permissions --}}
                        <div class="mb-4">
                            <h6 class="text-primary fw-bold mb-3">
                                <i class="fas fa-lock me-2"></i>{{ __('messages.Permission') }}
                            </h6>

                            <div class="accordion" id="permissionsAccordion">
                                @foreach ($permissions as $module => $modulePermissions)
                                    <div class="accordion-item mb-2 border rounded">
                                        <h2 class="accordion-header" id="heading_{{ Str::slug($module) }}">
                                            <button class="accordion-button collapsed fw-semibold" type="button" data-bs-toggle="collapse" data-bs-target="#collapse_{{ Str::slug($module) }}" aria-expanded="false">
                                                <i class="fas fa-cube me-2 text-secondary"></i> {{ ucfirst($module) }}
                                            </button>
                                        </h2>
                                        <div id="collapse_{{ Str::slug($module) }}" class="accordion-collapse collapse" data-bs-parent="#permissionsAccordion">
                                            <div class="accordion-body">
                                                <div class="d-flex justify-content-between align-items-center mb-3">
                                                    <span class="fw-bold">{{ __('messages.SelectPermissions') }}</span>
                                                    <button type="button" class="btn btn-sm btn-outline-primary select-all" data-module="{{ Str::slug($module) }}">
                                                        <i class="fas fa-check-double"></i> {{ __('messages.SelectAll') }}
                                                    </button>
                                                </div>
                                                <div class="row">
                                                    @foreach ($modulePermissions as $perm)
                                                        <div class="col-md-3 mb-2">
                                                            <div class="form-check form-switch">
                                                                {{ html()->checkbox('permissions[]', false, $perm->id)->id('perm_'.$perm->id)->class('form-check-input perm-checkbox module-'.Str::slug($module)) }}
                                                                {{ html()->label($perm->name)->for('perm_'.$perm->id)->class('form-check-label') }}
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <small class="text-danger">{!! $errors->first('permission') !!}</small>
                        </div>

                        {{-- Status --}}
                        <div class="card mb-4 border-0 shadow-sm">
                            <div class="card-body">
                                <h5 class="card-title mb-3 text-primary">
                                    <i class="fas fa-toggle-on me-2"></i>{{ __('messages.Status') }}
                                </h5>
                                <div class="form-check form-switch">
                                    {{ html()->checkbox('status', true)->class('form-check-input')->id('status') }}
                                    {{ html()->label(__('messages.active'))->for('status')->class('form-check-label fw-bold') }}
                                </div>
                            </div>
                        </div>

                        {{-- Action Buttons --}}
                        <div class="text-end">
                            <button type="submit" class="btn btn-success me-2">
                                <i class="fas fa-save"></i> {{ __('messages.Submit') }}
                            </button>
                            <button type="reset" class="btn btn-secondary">
                                <i class="fas fa-undo"></i> {{ __('messages.Reset') }}
                            </button>
                        </div>

                        {{ html()->form()->close() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('CustomStyle')
    <style>
        .textRed {
            color: #e3342f;
        }
        .card-title i {
            color: #0d6efd;
        }
    </style>

    <style>

        .accordion-item {
            border: 1px solid #e0e6f1 !important;
        }
    </style>
@endpush

@section('footer.scripts')
    <script>
        // Select All toggle
        document.querySelectorAll('.select-all').forEach(button => {
            button.addEventListener('click', function() {
                let module = this.dataset.module;
                let checkboxes = document.querySelectorAll('.module-' + module);
                let allChecked = Array.from(checkboxes).every(cb => cb.checked);
                checkboxes.forEach(cb => cb.checked = !allChecked);
                this.innerHTML = allChecked
                    ? '<i class="fas fa-check-double"></i> {{ __("messages.SelectAll") }}'
                    : '<i class="fas fa-times-circle"></i> {{ __("messages.UnselectAll") }}';
            });
        });
    </script>
@endsection

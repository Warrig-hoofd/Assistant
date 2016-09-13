@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        {{-- Toolbar --}}
        <div class="col-sm-12">
            <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active"><a href="#users" aria-controls="users" role="tab" data-toggle="tab">Users</a></li>
                <li role="presentation"><a href="#roles" aria-controls="roles" role="tab" data-toggle="tab">Roles</a></li>
                <li role="presentation"><a href="#permissions" aria-controls="permissions" role="tab" data-toggle="tab">Permissions</a></li>

                @if (auth()->user()->can('create-permission'))
                    <li role="presentation"><a href="#newPeermission" aria-controls="newPermission" role="tab" data-toggle="tab">Create permission</a></li>
                @endif

                @if (auth()->user()->can('create-role'))
                    <li role="presentation"><a href="#newRole" aria-controls="newRole" role="tab" data-toggle="tab">Create Role</a></li>
                @endif

                @if (auth()->user()->can('create-user'))
                    <li role="presentation"><a href="#newUser" aria-controls="newUser" role="tab" data-toggle="tab">Create user</a></li>
                @endif
            </ul>
        </div>
        {{-- /Toolbar --}}

        {{-- Content --}}
        <div class="col-sm-12">
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane fade in active" id="users">
                    @include('users.partials.users')
                </div>

                <div role="tabpanel" class="tab-pane fade in" id="roles">
                    @include('users.partials.role')
                </div>

                <div role="tabpanel" class="tab-pane fade in" id="permissions">
                    @include('users.partials.permission')
                </div>

                @if (auth()->user()->can('create-permission'))
                    <div role="tabpanel" class="tab-pane fade in" id="newPermission">
                        @include('users.partials.new-permission')
                    </div>
                @endif

                @if (auth()->user()->can('create-role'))
                    <div role="tabpanel" class="tab-pane fade in" id="newRole">
                        @include('users.partials.new-role')
                    </div>
                @endif

                @if (auth()->user()->can('create-user'))
                    <div role="tabpanel" class="tab-pane fade in" id="newUser">
                        @include('users.partials.new-user')
                    </div>
                @endif
            </div>
        </div>
        {{-- /Content --}}
    </div>
</div>
@endsection
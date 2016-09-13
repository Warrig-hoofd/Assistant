@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        {{-- Sidebar --}}
        <div class="col-sm-3">
            <div class="panel panel-default">
                <div class="panel-heading">Menu:</div>

                <div class="list-group">
                    <a href="" class="list-group-item">Account information</a>
                    <a href="" class="list-group-item">Account security</a>
                </div>
            </div>
        </div>
        {{-- /Sidebar --}}

        {{-- Panels --}}
        <div class="col-sm-9">

        </div>
        {{-- /Panels --}}
    </div>
</div>
@endsection
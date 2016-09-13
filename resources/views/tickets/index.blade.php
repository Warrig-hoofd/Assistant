@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-12">

            </div>

            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <table class="table table-condensed table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Platform:</th>
                                    <th>Status:</th>
                                    <th>Category:</th>
                                    <th>Created_at:</th>
                                    <th></th> {{-- Functions --}}
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($tickets as $ticket)

                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
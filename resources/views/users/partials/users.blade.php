<div class="row">
    <div style="padding-top: 10px;" class="col-sm-12">
        <div class="panel panel-default">
            <div class="panel-body">
                <table class="table table-hover table-condensed">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Username:</th>
                            <th>Email:</th>
                            <th>Api Token:</th>
                            <th>Created at:</th>



                            <th></th> {{-- functions --}}
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td><code>#L{!! $user->id !!}</code></td>
                                <td>{!! $user->name !!}</td>
                                <td>{!! $user->email !!}</td>
                                <td><code>@if(empty($user->api_token)) No token found! @else {!! $user->api_token !!} @endif</code></td>
                                <td>{!! $user->created_at !!}</td>

                                {{-- Functions --}}
                                <td>
                                    <a href="" class="label label-danger">Generate token</a>
                                    <a href="" class="label label-danger">Delete</a>
                                </td>
                                {{-- /Functions --}}
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                @if (count($users) >= 15)
                    {{ $users->render()  }}
                @endif
            </div>
        </div>
    </div>
</div>
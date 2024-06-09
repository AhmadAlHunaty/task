@extends('Layout.Layoutt')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        @if (!\Auth::check())
                            <h4>Registration
                                <a href="{{ url('user/create') }}" class="btn">Sign Up</a>
                                <a href="{{ url('user/login') }}" class="btn">Sign in</a>
                            </h4>
                        @endif
                    </div>
                    @if (\Auth::check())
                        <div class="card-body">
                            <table>
                                <tr>
                                    <th>username</th>
                                    <th>email</th>
                                </tr>

                                <tr>
                                    <td>{{ auth()->user()->name }}</td>
                                    <td>{{ auth()->user()->email }}</td>
                                </tr>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

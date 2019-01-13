@extends('_resources.layouts.master')

@section('title')
    Success
@endsection

@section('content')
    <div class="row">
        <div class="col-md-4 col-md-offset-4 success">
            <h1>Success Page</h1>
            @switch($successCode)
                @case('postSuccess')
                    <p>
                        Post successfuly created. <br>
                        {!!link_to_route('dashboard', 'Go to Dashboard')!!}
                    </p>
                    @break
                @case('registrationSuccess')
                    <p>
                        Congratulations! You have successfully registered. <br>
                        {!!link_to_route('dashboard', 'Go to Dashboard')!!}
                    </p>
                    @break
                @case('')
                    <p>
                        Were you looking for the success page? Well if so congratulations, you've found it. ;)  <br>
                        {!!link_to_route('dashboard', 'Go to Dashboard')!!} <br>
                        {!!link_to_route('welcome', 'Go to Main')!!}
                    </p>
                    @break
                @default
                    <p>
                        Unexpected <em>{{$successCode}}</em> success, please contact the <a href="mailto:webmaster@dragonslair.test">webmaster</a> for support.
                    </p>
            @endswitch
        </div>
    </div>

@endsection

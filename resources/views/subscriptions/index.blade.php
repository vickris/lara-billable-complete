@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Manage Subscriptions</div>

                <div class="panel-body">
                    @if (Auth::user()->subscription('main')->cancelled())
                        <p>Your subscription ends on {{ Auth::user()->subscription('main')->ends_at->format('dS M Y') }}</p>
                        <form action="{{ url('subscription/resume') }}" method="post">
                            <button type="submit" class="btn btn-default">Resume subscription</button>
                            {{ csrf_field() }}
                        </form>
                    @else
                        <p>You are currently subscribed to {{ Auth::user()->subscription('main')->braintree_plan }} plan</p>
                        <form action="{{ url('subscription/cancel') }}" method="post">
                            <button type="submit" class="btn btn-default">Cancel subscription</button>
                            {{ csrf_field() }}
                        </form>
                    @endif

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

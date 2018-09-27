@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard {{ Auth::user()->name }}</div>

                <checklists
                    :checklists-data="{{ json_encode($checklists) }}"
                >
                </checklists>
            </div>
        </div>
    </div>
</div>
@endsection

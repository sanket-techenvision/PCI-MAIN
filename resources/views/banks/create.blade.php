@extends('layouts.vertical', ['page_title'=>'Add Banks'])

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1>
                    Create Banks
                    </h1>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">


        <div class="card">

            {!! Form::open(['route' => 'banks.store']) !!}

            <div class="card-body">

                <div class="row">
                    @include('banks.fields')
                </div>

            </div>

            <div class="card-footer">
                {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
                <a href="{{ route('banks.index') }}" class="btn btn-default"> Cancel </a>
            </div>

            {!! Form::close() !!}

        </div>
    </div>
@endsection

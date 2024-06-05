@extends('layouts.vertical', ['page_title' => 'Create Sub Category'])

@section('content')
    <section class="content-header p-3">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1>
                    Create Service Sub Categories
                    </h1>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">

        <div class="card">

            {!! Form::open(['route' => 'service_sub_categories.store']) !!}

            <div class="card-body">

                <div class="row">
                    @include('service_sub_categories.fields')
                </div>

            </div>

            <div class="card-footer">
                {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
                <a href="{{ route('service_sub_categories.index') }}" class="btn btn-default"> Cancel </a>
            </div>

            {!! Form::close() !!}

        </div>
    </div>
@endsection

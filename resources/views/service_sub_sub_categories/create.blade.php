@extends('layouts.vertical', ['page_title' => 'Create Services SubSub Category'])

@section('content')
    <section class="content-header p-3">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1>
                    Create Service Sub Sub Categories
                    </h1>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">
        <div class="card">

            {!! Form::open(['route' => 'serviceSubSubCategories.store']) !!}

            <div class="card-body">
                <div class="row">
                    @include('service_sub_sub_categories.fields')
                </div>

            </div>

            <div class="card-footer">
                {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
                <a href="{{ route('serviceSubSubCategories.index') }}" class="btn btn-default"> Cancel </a>
            </div>

            {!! Form::close() !!}

        </div>
    </div>
@endsection

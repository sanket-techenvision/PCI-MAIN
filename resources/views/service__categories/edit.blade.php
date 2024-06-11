@extends('layouts.vertical', ['page_title' => 'Edit Service Category Details'] )

@section('content')
    <section class="content-header p-3">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1>
                        Edit Service  Category
                    </h1>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">

        <div class="card">

            {!! Form::model($serviceCategory, ['route' => ['serviceCategories.update', $serviceCategory->service_cat_id], 'method' => 'patch']) !!}

            <div class="card-body">
                <div class="row">
                    @include('service__categories.fields')
                </div>
            </div>

            <div class="card-footer">
                {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
                <a href="{{ route('serviceCategories.index') }}" class="btn btn-default"> Cancel </a>
            </div>

            {!! Form::close() !!}

        </div>
    </div>
@endsection

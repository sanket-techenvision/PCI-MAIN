@extends('layouts.vertical', ['page_title'=>'Apply For Service'])

@section('content')
<section class="content-header p-3">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-12">
                <h1>
                    Create Drafts
                </h1>
            </div>
        </div>
    </div>
</section>

<div class="content px-3">
    <div class="card">

        {!! Form::open(['route' => 'drafts.store']) !!}

        <div class="card-body">
            <div class="row">
                @include('drafts.fields')
            </div>
        </div>

        <div class="card-footer">
            {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
            <a href="{{ route('drafts.index') }}" class="btn btn-default"> Cancel </a>
        </div>

        {!! Form::close() !!}

    </div>
</div>
@endsection
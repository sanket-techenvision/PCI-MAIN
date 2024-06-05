@extends('layouts.vertical', ['page_title'=>'Edit Bank Details'])

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1>
                        Edit Banks
                    </h1>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">


        <div class="card">

            {!! Form::model($banks, ['route' => ['banks.update', $banks->bank_id], 'method' => 'patch']) !!}

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

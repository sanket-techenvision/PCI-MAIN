<div class="card-body p-0">
    <div class="table-responsive">
        <table class="table" id="drafts-table">
            <thead>
            <tr>
                <th>User Id</th>
                <th>Service Cat Id</th>
                <th>Service Sub Cat Id</th>
                <th>Service Subsub Cat Id</th>
                <th>Bank Id</th>
                <th>Payment Status</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($drafts as $drafts)
                <tr>
                    <td>{{ $drafts->user_id }}</td>
                    <td>{{ $drafts->service_cat_id }}</td>
                    <td>{{ $drafts->service_sub_cat_id }}</td>
                    <td>{{ $drafts->service_subsub_cat_id }}</td>
                    <td>{{ $drafts->bank_id }}</td>
                    <td>{{ $drafts->payment_status }}</td>
                    <td  style="width: 120px">
                        {!! Form::open(['route' => ['drafts.destroy', $drafts->id], 'method' => 'delete']) !!}
                        <div class='btn-group'>
                            <a href="{{ route('drafts.show', [$drafts->id]) }}"
                               class='btn btn-default btn-xs'>
                                <i class="far fa-eye"></i>
                            </a>
                            <a href="{{ route('drafts.edit', [$drafts->id]) }}"
                               class='btn btn-default btn-xs'>
                                <i class="far fa-edit"></i>
                            </a>
                            {!! Form::button('<i class="far fa-trash-alt"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                        </div>
                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <div class="card-footer clearfix">
        <div class="float-right">
            @include('adminlte-templates::common.paginate', ['records' => $drafts])
        </div>
    </div>
</div>

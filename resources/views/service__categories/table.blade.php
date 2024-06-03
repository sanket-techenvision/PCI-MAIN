<div class="card-body p-0">
    <div class="table-responsive">
        <table class="table" id="service_-categories-table">
            <thead>
            <tr>
                <th>Service Cat Name</th>
                <th>Service Cat Description</th>
                <th>Service Cat Status</th>
                <th>Cat Created By</th>
                <th>Cat Updated By</th>
                <th colspan="3">Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($serviceCategories as $serviceCategory)
                <tr>
                    <td>{{ $serviceCategory->service_cat_name }}</td>
                    <td>{{ $serviceCategory->service_cat_description }}</td>
                    <td>{{ $serviceCategory->service_cat_status }}</td>
                    <td>{{ $serviceCategory->cat_created_by }}</td>
                    <td>{{ $serviceCategory->cat_updated_by }}</td>
                    <td  style="width: 120px">
                        {!! Form::open(['route' => ['serviceCategories.destroy', $serviceCategory->id], 'method' => 'delete']) !!}
                        <div class='btn-group'>
                            <a href="{{ route('serviceCategories.show', [$serviceCategory->id]) }}"
                               class='btn btn-default btn-xs'>
                                <i class="far fa-eye"></i>
                            </a>
                            <a href="{{ route('serviceCategories.edit', [$serviceCategory->id]) }}"
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
        </div>
    </div>
</div>

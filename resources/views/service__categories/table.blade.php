<div class="card-body p-0">
    <div class="table-responsive">
        <table class="table" id="service_-categories-table">
            <thead>
            <tr>
                <th>Name</th>
                <th>Description</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($serviceCategories as $serviceCategory)
                <tr>
                    <td>{{ $serviceCategory->service_cat_name }}</td>
                    <td>{{ $serviceCategory->service_cat_description }}</td>
                    <td>{{ $serviceCategory->service_cat_status }}</td>
                    <td  style="width: 120px">
                        {!! Form::open(['route' => ['serviceCategories.destroy', $serviceCategory->service_cat_id], 'method' => 'delete']) !!}
                        <div class='btn-group'>
                            <a href="{{ route('serviceCategories.show', [$serviceCategory->service_cat_id]) }}"
                               class='btn btn-default'>
                               <i class="ri-eye-fill"></i>
                            </a>
                            <a href="{{ route('serviceCategories.edit', [$serviceCategory->service_cat_id]) }}"
                               class='btn btn-default'>
                               <i class="ri-edit-box-line"></i>
                            </a>
                            {!! Form::button('<i class="ri-delete-bin-line"></i>', ['type' => 'submit', 'class' => 'btn btn-danger', 'onclick' => "return confirm('Are you sure?')"]) !!}
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

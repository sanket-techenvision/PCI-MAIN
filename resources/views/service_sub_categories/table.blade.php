<div class="card-body p-0">
    <div class="table-responsive">
        <table class="table" id="service_-sub_-categories-table">
            <thead>
            <tr>
                <th>Name</th>
                <th>Description</th>
                <th>Status</th>
                <th>Service Cat Id</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($serviceSubCategories as $serviceSubCategory)
                <tr>
                    <td>{{ $serviceSubCategory->service_sub_cat_name }}</td>
                    <td>{{ $serviceSubCategory->service_sub_cat_description }}</td>
                    <td>{{ $serviceSubCategory->service_sub_cat_status }}</td>
                    <td>{{ $serviceSubCategory->serviceCategory->service_cat_name }}</td>
                   <td  style="width: 120px">
                        {!! Form::open(['route' => ['service_sub_categories.destroy', $serviceSubCategory->service_sub_cat_id], 'method' => 'delete']) !!}
                        <div class='btn-group'>
                            <a href="{{ route('service_sub_categories.show', [$serviceSubCategory->service_sub_cat_id]) }}"
                               class='btn btn-default btn-xs'>
                                <i class="ri-eye-fill"></i>
                            </a>
                            <a href="{{ route('service_sub_categories.edit', [$serviceSubCategory->service_sub_cat_id]) }}"
                               class='btn btn-default btn-xs'>
                                <i class="ri-edit-box-line"></i>
                            </a>
                            {!! Form::button('<i class="ri-delete-bin-line"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
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
            @include('adminlte-templates::common.paginate', ['records' => $serviceSubCategories])
        </div>
    </div>
</div>

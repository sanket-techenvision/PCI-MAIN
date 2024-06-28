<div class="card-body p-0">
    <div class="table-responsive">
        <table class="table" id="basic-datatable">
            <thead>
            <tr>
                <th>ID</th>
                <th>Service Cat Name</th>
                <th>Service Sub Cat Name</th>
                <th>Service Subsub Cat Name</th>
                <!-- <th>Service Subsub Cat Description</th> -->
                <th>Service Subsub Cat Status</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($serviceSubSubCategories as $serviceSubSubCategory)
                <tr>
                    <td>{{ $serviceSubSubCategory->service_subsub_cat_id}}</td>
                    <td>{{ $serviceSubSubCategory->serviceSubCategory->serviceCategory->service_cat_name}}</td>
                    <td>{{ $serviceSubSubCategory->serviceSubCategory->service_sub_cat_name }}</td>
                    <td>{{ $serviceSubSubCategory->service_subsub_cat_name }}</td>
                    <!-- <td>{{ $serviceSubSubCategory->service_subsub_cat_description }}</td> -->
                    <td>{{ $serviceSubSubCategory->service_subsub_cat_status }}</td>
                    <td  style="width: 120px">
                        {!! Form::open(['route' => ['serviceSubSubCategories.destroy', $serviceSubSubCategory->service_subsub_cat_id], 'method' => 'delete']) !!}
                        <div class='btn-group'>
                            <a href="{{ route('serviceSubSubCategories.show', [$serviceSubSubCategory->service_subsub_cat_id]) }}"
                               class='btn btn-default btn-xs'>
                                <i class="ri-eye-fill"></i>
                            </a>
                            <a href="{{ route('serviceSubSubCategories.edit', [$serviceSubSubCategory->service_subsub_cat_id]) }}"
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
</div>

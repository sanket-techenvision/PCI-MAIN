<div class="card-body p-0">
    <div class="table-responsive">
        <table class="table" id="banks-table">
            <thead>
                <tr>
                    <th>Sr. No.</th>
                    <th>Bank Name</th>
                    <th>Bank Applicant</th>
                    <th>Bank Swift Code</th>
                    <th>Bank Address</th>
                    <th>Bank Country</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @php
                $i = 1;
                @endphp
                @foreach($banks as $banks)
                <tr>
                    <td>{{ $i }}</td>
                    <td>{{ $banks->bank_name }}</td>
                    <td>{{ $banks->bank_applicant }}</td>
                    <td>{{ $banks->bank_swift_code }}</td>
                    <td>{{ $banks->bank_address }}</td>
                    <td>{{ $banks->bank_country }}</td>
                    <td>
                        {!! Form::open(['route' => ['banks.destroy', $banks->bank_id], 'method' => 'delete']) !!}
                        <div class='btn-group'>
                            <a href="{{ route('banks.show', [$banks->bank_id]) }}" class='btn btn-default btn-xs'>
                                <i class="ri-eye-fill"></i>
                            </a>
                            <a href="{{ route('banks.edit', [$banks->bank_id]) }}" class='btn btn-default btn-xs'>
                                <i class="ri-edit-box-line"></i>
                            </a>
                            {!! Form::button('<i class="ri-delete-bin-line"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                        </div>
                        {!! Form::close() !!}
                    </td>
                </tr>
                @php
                $i++;
                @endphp
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="card-footer clearfix">
        <div class="float-right">
        </div>
    </div>
</div>
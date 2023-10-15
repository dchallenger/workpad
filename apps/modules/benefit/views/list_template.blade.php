<tr class="record">
    <td><input type="checkbox" value="{{ $record_id }}" class="record-checker checkboxes"></td>
    <td>{{ $users_benefit_benefit_type }}</td>
    <td>{{ $users_benefit_company }}</td>
    <td>{{ $users_benefit_job_level }}</td>
    <td>{{ $users_benefit_benefit_package }}</td>
<!--     <td>{{ $users_benefit_description }}</td> -->
    <td>{{ $users_benefit_status_id }}</td>
    <td>
        <div class="btn-group">
            <a class="btn btn-xs text-muted" href="{{ $edit_url }}"><i class="fa fa-pencil"></i> Edit</a>
        </div>
        <div class="btn-group">
            <a class="btn btn-xs text-muted" href="#" data-close-others="true" data-toggle="dropdown"><i class="fa fa-gear"></i> Options</a>
            <ul class="dropdown-menu pull-right">
                {{ $options }}
            </ul>
        </div>
    </td>
</tr>
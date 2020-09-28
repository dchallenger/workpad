<tr class="record">
    <td class="hidden-xs">
    <input type="checkbox" value="{{ $record_id }}" class="record-checker checkboxes">
    </td>

    <td>
        {{ $time_form_balance_fcc_setup_form }}
    </td>

    <td>
        {{ $time_form_balance_fcc_setup_description}}
    </td>

    <td>
        {{ $time_form_balance_fcc_setup_company}}
    </td>

    <td>
        {{ $time_form_balance_fcc_setup_employment_type }}
    </td>

    <td>
        {{ $time_form_balance_fcc_setup_employment_status }}
    </td>
        
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
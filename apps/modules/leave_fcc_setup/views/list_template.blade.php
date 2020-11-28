<tr class="record">
    <td class="hidden-xs">
    <input type="checkbox" value="{{ $record_id }}" class="record-checker checkboxes">
    </td>

    <td>
        {{ $time_form_balance_fcc_setup_form }}
        <br>
        <span class="small">Benefit Package = @if($time_form_balance_fcc_setup_old_new == 0) Old @else New @endif</span>
        <br>
        <span class="small">Carry Over = {{ $time_form_balance_fcc_setup_max_balance_carry_over }}</span>
        <br>
        <span class="small">Pay Excess = {{ $time_form_balance_fcc_setup_in_excess_to_pay }}</span>
        <br>
        <span class="small">Forfeiture = {{ $time_form_balance_fcc_setup_in_excess_to_forfeit }}</span>                
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
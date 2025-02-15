<tr class="record">
    <td class="hidden-xs"><input type="checkbox" value="{{ $record_id }}" class="record-checker checkboxes"></td>
    <td>
        @if( !empty($users_profile_photo) )
            <a href="#"><img class="avatar img-responsive" src="{{ base_url($users_profile_photo)}}" style="width: 48px;"></a>
        @else
            <a href="#"><img class="avatar img-responsive" src="{{ base_url('assets/img/avatar.png') }}"></a>
        @endif
    </td>
    <td>
        <a href="{{ $detail_url }}" id="date_name">{{ $users_profile_firstname }} {{ $users_profile_lastname }} {{ $users_profile_suffix or '' }}</a>
        <br>
        <span class="small" id="date_set">{{ $users_profile_position_id }}</span>
        <br>
        <span class="small" id="date_set">{{ $partners_id_number }}</span>        
    </td>
    <td class="hidden-xs">{{ $users_profile_company }}</td>
    <td>
        @if( $users_active == 'Yes' )
            <span class="badge badge-success">{{ lang('partners_immediate.active') }}</span>
        @else
            <span class="badge badge-error">{{ lang('partners_immediate.inactive') }}</span>
        @endif
    </td>
    <td>
        @if( $permission['edit'] == 1 )
            <div class="btn-group">
                <a class="btn btn-xs text-muted" href="{{ $edit_url }}"><i class="fa fa-pencil"></i> {{ lang('common.Edit') }}</a>
            </div>
        @endif

        @if($permission['detail'] == 1 OR $permission['delete'] == 1 )
            <div class="btn-group">
                <a class="btn btn-xs text-muted" href="#" data-close-others="true" data-toggle="dropdown"><i class="fa fa-gear"></i> Options</a>
                <ul class="dropdown-menu pull-right">
                    {{ $options }}
                </ul>
            </div>
        @endif
    </td>
</tr>
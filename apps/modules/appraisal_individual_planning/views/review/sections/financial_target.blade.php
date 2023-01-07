<?php
    //debug($financial_metric_planning);
?>
<div class="table-responsive">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th colspan="5" class="bold">FINANCIAL TARGETS</th>
            </tr>
            <tr>
                @if(count($financial_metric_planning['columns_arr']) > 0)
                    <th class="text-center bold">&nbsp;</th>
                    @foreach($financial_metric_planning['columns_arr'] as $key => $val)
                        <th class="text-center bold">{{$val}}</th>
                    @endforeach
                @endif
            </tr>
        </thead>
        <tbody>
            @if(count($financial_metric_planning['fmp_details_arr']) > 0)
                @foreach($financial_metric_planning['fmp_details_arr'] as $kpi => $financial)
                    <tr>
                        <td>{{$kpi}}</td>
                        @if(count($financial_metric_planning['columns_arr']) > 0)
                            @foreach($financial_metric_planning['columns_arr'] as $key1 => $val1)
                                @if(array_key_exists($val1,$financial))
                                    <td>{{$financial[ $val1]->value}} ({{$financial[ $val1]->weight}}%)</td>
                                @else
                                    <td>&nbsp;</td>
                                @endif
                            @endforeach
                        @endif
                    </tr>
                @endforeach
                <tr>
                    <td colspan="5">&nbsp;</td>
                </tr>
            @endif
        </tbody>
    </table>
</div>
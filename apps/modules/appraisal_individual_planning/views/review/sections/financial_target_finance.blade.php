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
                <th class="text-center bold">SBU</th>
                <th class="text-center bold">Item</th>
                <th class="text-center bold">%</th>
                <th class="text-center bold">Target</th>
                <th class="text-center bold">Rating Comp</th>
            </tr>
        </thead>
        <tbody>
            @if(count($financial_metric_planning_finance['fmpi_details_arr']) > 0)
                @foreach($financial_metric_planning_finance['fmpi_details_arr'] as $sbu_unit => $financial)
                    <?php $total_weight = 0 ?>
                    @foreach($financial as $key => $val)
                        <tr>
                            <td>{{$sbu_unit}}</td>
                            <td>{{$val['financial_metric_kpi']}}</td>
                            <td align="right">{{$val['weight']}}%</td>
                            <td align="right">{{$val['value']}}</td>
                            <td>@if($val['rating_comp'] == 1) Actual/Target @else Target/Actual @endif</td>
                        </tr>
                        <?php $total_weight += $val['weight'] ?>
                    @endforeach
                    <tr>
                        <td class="bold">{{$sbu_unit}}</td>
                        <td class="bold">TOTAL</td>
                        <td class="bold" align="right">{{$total_weight}}%</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                    </tr>
                @endforeach
                <tr>
                    <td colspan="5">&nbsp;</td>
                </tr>
            @endif
        </tbody>
    </table>
</div>
<div>
    
    <div class="form-group">
        <p>Hello <?php echo $name; ?>,</p>
    </div>

    <div class="form-group">
        <p>
            <b>
                Below are the list of
            </b> 
            <b style="color: blue;"> 
                current week Planned 
            </b>
            <b> 
                & 
            </b>
            <b style="color: red;">
                till now Delay
            </b>
            <b>
                activities, kindly take necessary action.
            </b>
        </p>
    </div>


    @if(count($upComingActivities)>0)
        <table style="border-collapse: collapse; border-spacing: 0; width: 85%; border: 1px solid;">
            <tr>
                <th style="color: blue; column-span:5;">
                    List of current week planned activities
                </th>
            </tr>
            
        
            @if(!is_null($upComingActivities))
                @foreach($upComingActivities as $uak => $uav)
                    @if($loop->first)
                        <tr style="border: 1px solid;">
                            <center>
                                <th style="border: 1px solid;">Sr.No</th>
                                <th style="border: 1px solid;">Study No</th>
                                <th style="border: 1px solid;">Activity Name</th>
                                <th style="border: 1px solid;">Schedule Start Date</th>
                                <th style="border: 1px solid;">Schedule End Date</th>
                                @if( ((!is_null($uav->activities)) && (($uav->activities->para_value != '') && (($uav->activities->para_value == 'CR') || ($uav->activities->para_value == 'BR')))) )
                                    <th style="border: 1px solid;">Location</th>
                                @endif
                                    <th style="border: 1px solid;">User Name</th>
                            </center>
                        </tr>
                    @endif
                    <center>
                        <tr style="border: 1px solid;">
                            <td style="border: 1px solid;">{{ $loop->iteration }}</td>
                            <td style="border: 1px solid;">
                                {{ ((!is_null($uav->studyNo)) && ($uav->studyNo->study_no != '')) ? $uav->studyNo->study_no : '---' }}
                            </td>
                            <td style="border: 1px solid;">{{ ($uav->activity_name != '') ? $uav->activity_name : '---' }}</td>
                            <td style="border: 1px solid;">
                                    {{ ($uav->scheduled_start_date != '') ? date('d M Y', strtotime($uav->scheduled_start_date)) : '---' }}
                            </td>
                            <td style="border: 1px solid;">
                                    {{ ($uav->scheduled_end_date != '') ? date('d M Y', strtotime($uav->scheduled_end_date)) : '---' }}
                            </td>
                            @if( ((!is_null($uav->activities)) && (($uav->activities->para_value != '') && ($uav->activities->para_value == 'CR'))) )
                                <td style="border: 1px solid;">
                                    {{ (( (!is_null($uav->studyNo)) && (!is_null($uav->studyNo->crLocationName)) ) && ($uav->studyNo->crLocationName->location_name != '')) ? $uav->studyNo->crLocationName->location_name : '---' }}
                                </td>
                            @elseif( ((!is_null($uav->activities)) && (($uav->activities->para_value != '') && ($uav->activities->para_value == 'BR'))) )
                                <td style="border: 1px solid;">
                                    {{ (( (!is_null($uav->studyNo)) && (!is_null($uav->studyNo->brLocationName)) ) && ($uav->studyNo->brLocationName->location_name != '')) ? $uav->studyNo->brLocationName->location_name : '---' }}
                                </td>
                            @endif

                            @if( ((!is_null($uav->activities)) && (($uav->activities->para_value != '') && ($uav->activities->para_value == 'CR'))) )
                                <td style="border: 1px solid;">
                                    @php $userNames = []; @endphp
                                    @if(!is_null($getUsersWithLocation))
                                        @foreach($getUsersWithLocation as $gguwlk => $guwlv)
                                            @if($guwlv->location_id == $uav->studyNo->cr_location)
                                                @php $userNames[] = $guwlv->name; @endphp
                                            @endif
                                        @endforeach
                                    @endif
                                    {{ implode(' | ', $userNames) }}
                                </td>
                            @elseif( ((!is_null($uav->activities)) && (($uav->activities->para_value != '') && ($uav->activities->para_value == 'BR'))) )
                                <td style="border: 1px solid;">
                                    @php $userNames = []; @endphp
                                    @if(!is_null($getUsersWithLocation))
                                        @foreach($getUsersWithLocation as $guwlk => $guwlv)
                                            @if($guwlv->location_id == $uav->studyNo->br_location)
                                                @php $userNames[] = $guwlv->name; @endphp
                                            @endif
                                        @endforeach
                                    @endif
                                    {{ implode(' | ', $userNames) }}
                                </td>
                            @elseif( ((!is_null($uav->activities)) && (($uav->activities->para_value != '') && ($uav->activities->para_value == 'RW'))) )
                                <td style="border: 1px solid;">
                                    @php $userNames = []; @endphp
                                    @if(!is_null($getUsersWithLocation))
                                        @foreach($getUsersWithLocation as $guwlk => $guwlv)
                                            @if(($guwlv->role_id == 7))
                                                @php $userNames[] = $guwlv->name; @endphp
                                            @endif
                                        @endforeach
                                    @endif
                                    {{ implode(' | ', $userNames) }}
                                </td>
                            @elseif( ((!is_null($uav->activities)) && (($uav->activities->para_value != '') && ($uav->activities->para_value == 'PB'))) )
                                <td style="border: 1px solid;">
                                    @php $userNames = []; @endphp
                                    @if(!is_null($getUsersWithLocation))
                                        @foreach($getUsersWithLocation as $guwlk => $guwlv)
                                            @if(($guwlv->location_id == 1) && ($guwlv->role_id == 8))
                                                @php $userNames[] = $guwlv->name; @endphp
                                            @endif
                                        @endforeach
                                    @endif
                                    {{ implode(' | ', $userNames) }}
                                </td>
                            @endif
                        </tr>
                    </center>
                @endforeach
            @endif    
        </table>
        <br>
        <br>
    @else
        <table style="border-collapse: collapse; border-spacing: 0; width: 85%; border: 1px solid;">
            <tr>
                <th style="color: blue;">
                    No planned activities today
                </th>
            </tr>
        </table>
    @endif<br><br>

   

    @if(count($delayActivities)>0)
        <table style="border-collapse: collapse; border-spacing: 0; width: 85%; border: 1px solid;">
            <tr>
                <th style="color: red; column-span:5;">
                    List of delay activities
                </th>
            </tr>
            
        
            @if(!is_null($delayActivities))
                @foreach($delayActivities as $dak => $dav)
                            @if($loop->first)
                                <tr style="border: 1px solid;">
                                    <center>
                                        <th style="border: 1px solid;">Sr.No</th>
                                        <th style="border: 1px solid;">Study No</th>
                                        <th style="border: 1px solid;">Activity Name</th>
                                        <th style="border: 1px solid;">Schedule Start Date</th>
                                        <th style="border: 1px solid;">Schedule End Date</th>
                                        @if( ((!is_null($dav->activities)) && (($dav->activities->para_value != '') && (($dav->activities->para_value == 'CR') || ($dav->activities->para_value == 'BR')))) )
                                            <th style="border: 1px solid;">Location</th>
                                        @endif
                                        <th style="border: 1px solid;">User Name</th>
                                    </center>
                                </tr>
                            @endif
                            <center>
                                <tr style="border: 1px solid;">
                                    <td style="border: 1px solid;">{{ $loop->iteration }}</td>
                                    <td style="border: 1px solid;">
                                        {{ ((!is_null($dav->studyNo)) && ($dav->studyNo->study_no != '')) ? $dav->studyNo->study_no : '---' }}
                                    </td>
                                    <td style="border: 1px solid;">{{ ($dav->activity_name != '') ? $dav->activity_name : '---' }}</td>
                                    <td style="border: 1px solid;">
                                        {{ ($dav->scheduled_start_date != '') ? date('d M Y', strtotime($dav->scheduled_start_date)) : '---' }}
                                    </td>
                                    <td style="border: 1px solid;">
                                        {{ ($dav->scheduled_end_date != '') ? date('d M Y', strtotime($dav->scheduled_end_date)) : '---' }}
                                    </td>
                                    @if( ((!is_null($dav->activities)) && (($dav->activities->para_value != '') && ($dav->activities->para_value == 'CR'))) )
                                        <td style="border: 1px solid;">
                                            {{ (( (!is_null($dav->studyNo)) && (!is_null($dav->studyNo->crLocationName)) ) && ($dav->studyNo->crLocationName->location_name != '')) ? $dav->studyNo->crLocationName->location_name : '---' }}
                                        </td>
                                    @elseif( ((!is_null($dav->activities)) && (($dav->activities->para_value != '') && ($dav->activities->para_value == 'BR'))) )
                                        <td style="border: 1px solid;">
                                            {{ (( (!is_null($dav->studyNo)) && (!is_null($dav->studyNo->brLocationName)) ) && ($dav->studyNo->brLocationName->location_name != '')) ? $dav->studyNo->brLocationName->location_name : '---' }}
                                        </td>    
                                    @endif
                                    @if( ((!is_null($dav->activities)) && (($dav->activities->para_value != '') && ($dav->activities->para_value == 'CR'))) )
                                        <td style="border: 1px solid;">
                                            @php $userNames = []; @endphp
                                            @if(!is_null($getUsersWithLocation))
                                                @foreach($getUsersWithLocation as $gguwlk => $guwlv)
                                                    @if($guwlv->location_id == $dav->studyNo->cr_location)
                                                        @php $userNames[] = $guwlv->name; @endphp
                                                    @endif
                                                @endforeach
                                            @endif
                                            {{ implode(' | ', $userNames) }}
                                        </td>
                                    @elseif( ((!is_null($dav->activities)) && (($dav->activities->para_value != '') && ($dav->activities->para_value == 'BR'))) )
                                        <td style="border: 1px solid;">
                                            @php $userNames = []; @endphp
                                            @if(!is_null($getUsersWithLocation))
                                                @foreach($getUsersWithLocation as $guwlk => $guwlv)
                                                    @if($guwlv->location_id == $dav->studyNo->br_location)
                                                        @php $userNames[] = $guwlv->name; @endphp
                                                    @endif
                                                @endforeach
                                            @endif
                                            {{ implode(' | ', $userNames) }}
                                        </td>
                                    @elseif( ((!is_null($dav->activities)) && (($dav->activities->para_value != '') && ($dav->activities->para_value == 'RW'))) )
                                        <td style="border: 1px solid;">
                                            @php $userNames = []; @endphp
                                            @if(!is_null($getUsersWithLocation))
                                                @foreach($getUsersWithLocation as $guwlk => $guwlv)
                                                    @if(($guwlv->role_id == 7))
                                                        @php $userNames[] = $guwlv->name; @endphp
                                                    @endif
                                                @endforeach
                                            @endif
                                            {{ implode(' | ', $userNames) }}
                                        </td>
                                    @elseif( ((!is_null($dav->activities)) && (($dav->activities->para_value != '') && ($dav->activities->para_value == 'PB'))) )
                                        <td style="border: 1px solid;">
                                            @php $userNames = []; @endphp
                                            @if(!is_null($getUsersWithLocation))
                                                @foreach($getUsersWithLocation as $guwlk => $guwlv)
                                                    @if(($guwlv->location_id == 1) && ($guwlv->role_id == 8) )
                                                        @php $userNames[] = $guwlv->name; @endphp
                                                    @endif
                                                @endforeach
                                            @endif
                                            {{ implode(' | ', $userNames) }}
                                        </td>
                                    @endif
                                </tr>
                            </center>
                @endforeach
            @endif
            
        </table>
    @else 
        <table style="border-collapse: collapse; border-spacing: 0; width: 85%; border: 1px solid;">
            <tr>
                <th style="color: red;">
                    No delay activities
                </th>
            </tr>
        </table>
    @endif

    <p>
        <b>Note:</b> Please do not reply to this email, this is system generated email from Study Management System.
    </p>
    
    <div class="form-group">
        <h4>Study Management System</h4>
    </div>
        
</div>

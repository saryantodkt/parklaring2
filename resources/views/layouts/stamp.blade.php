<div id="company-stamp">
                        @if($parklaringInfo->entity_id==1)
                        <img src="{{ asset('images/stamp-pdi.png') }}" alt="" width="100px" height="100px">
                        @elseif($parklaringInfo->entity_id==2)
                        <img src="{{ asset('images/stamp-ydi.png') }}" alt="" width="100px" height="100px">
                       @elseif($parklaringInfo->entity_id==3)
                        <img src="{{ asset('images/stamp-pda.png') }}" alt="" width="100px" height="100px">
                        @endif
                    </div>
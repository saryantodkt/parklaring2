@extends('layouts.template')
@section('script-header')
    <script>
        document.addEventListener('contextmenu', (e) => {
            e.preventDefault();
        });
        document.addEventListener('selectstart', function(e) {
            e.preventDefault();
        });
        document.addEventListener('keydown', function(e) {
            if (e.ctrlKey && e.shiftKey && e.keyCode == 'I'.charCodeAt(0)) {
                return false;
            }
            if (e.ctrlKey && e.shiftKey && e.keyCode == 'J'.charCodeAt(0)) {
                return false;
            }
            if (e.ctrlKey && e.shiftKey && e.keyCode == 'C'.charCodeAt(0)) {
                return false;
            }
            if (e.ctrlKey && e.keyCode == 'U'.charCodeAt(0)) {
                return false;
            }
        });
        // Detect PrintScreen key (44) and clear clipboard
        document.addEventListener("keyup", function (e) {
        if (e.keyCode == 44) {
            navigator.clipboard.writeText("Copying is disabled"); // Modern approach
            alert("Screenshot function blocked");
        }
        });
    </script>
@endsection
@section('content')

        <div class="content">
            <div class="row">
                <div class="col">
                    <h3 class="mb-0 text-center" style="font-size: 18px; font-weight:bold; text-decoration: underline;">SURAT KETERANGAN KERJA</h3>
                    <h3 class="mb-0 text-center" style="font-size: 18px; font-weight:bold;">EMPLOYMENT CERTIFICATE</h3>
                    <p class="mt-0 text-center" style="font-size: 11px; font-weight:bold">NO. {!! $parklaringInfo->document_no !!}</p>
                </div>
            </div>
            <br>
            <p class="mb-0" style="text-decoration: underline;">Dengan ini menerangkan bahwa</p>
            <p style="font-size: 10px; font-style: italic;">This is to certyfy that</p>
            <div class="row">
                <div class="col-1"></div>
                <div class="col-10">
                    <table>
                        <tr>
                            <td style="width: 100px;">
                                <p class="mb-0" style="text-decoration: underline;">Nama</p>
                                <p style="font-size: 10px; font-style: italic;">Name</p>
                            </td>
                            <td style="width: 25px;text-align:center">:</td>
                            <td>{!! $parklaringInfo->employee_name !!}</td>
                        </tr>
                        <tr>
                            <td>
                                <p class="mb-0" style="text-decoration: underline;">Periode Kerja</p>
                                <p style="font-size: 10px; font-style: italic;">Period of Employment</p>
                            </td>
                            <td style="width: 25px;text-align:center">:</td>
                            <td><b>{{ Date::parse($parklaringInfo->join_date)->format('d F Y') }}</b> - <b>{{ Date::parse($parklaringInfo->resignation_date)->format('d F Y') }}</b></td>
                        </tr>
                        <tr>
                            <td>
                                <p class="mb-0" style="text-decoration: underline;">Status</p>
                                <p style="font-size: 10px; font-style: italic;">Status</p>
                            </td>
                            <td style="width: 25px;text-align:center">:</td>
                            <td><b>{!! $parklaringInfo->probationStatuses->probation_status_name !!}</b></td>
                        </tr>
                        
                    </table>
                </div>
                <div class="col-1"></div>
            </div>
            <br>
            <p class="mb-0">Yang bersangkutan benar telah bekerja di {!! $parklaringInfo->entity->entity_name !!} selama periode tersebut.</p>
            <p style="font-size: 10px; font-style: italic;">The aforementioned individual was duly employed by {!! $parklaringInfo->entity->entity_name !!} for the duration of the stated period.</p>
            <p class="mb-0">Surat ini dibuat hanya sebagai keterangan tanpa konsekuensi lebih lanjut.</p>
            <p style="font-size: 10px; font-style: italic;">This certificate is issued solely for record purposes and does not create any legal rights or obligations.</p>
            <br>
            <div class="row">
                <div class="col-4">
                    <div>
                    <img src="{{ asset('QR/' . $parklaringInfo->unique_code . '.svg') }}" alt="QR Code">    
                    </div>
                    <small style="font-size:10px">{!! $parklaringInfo->unique_code !!}</small>
                </div>
                <div class="col-4"></div>
                <div class="col-4">
                    <?php 
                    $signPosition = getSignPosition($parklaringInfo->sign_position);
                    ?>
                    <div id="company-stamp"
                    style="
                        position: absolute;
                        left: {{ $signPosition[0] }}mm;
                        bottom: {{ $signPosition[1] }}mm;
                        z-index: -1;
                        transform: rotate({{ $signPosition[2] }}deg);
                    "
                    >
                        <img src="{{ asset('images/'.$parklaringInfo->entity->stamp) }}" alt="" width="100px" height="100px">
                    </div>
                    <div id="sign"
                    style="
                        position: absolute;
                        left: {{ $signPosition[3] }}mm;
                        bottom: {{ $signPosition[4] }}mm;
                        z-index: -1;
                        transform: rotate({{ $signPosition[5] }}deg);
                    "
                    >
                        <img src="{{ asset('images/'.$parklaringInfo->approver->signature) }}" alt="" width="auto" height="auto">
                    </div>
                    <p style="padding-top: 0px">Jakarta, {{ Date::parse($parklaringInfo->date_approved)->format('d F Y') }}</p>
                    <br>
                    <br>
                    <br>
                    <p style="margin-bottom: 0px; font-weight:bold">{!! $parklaringInfo->approver->approver_name !!}</p>
                    <p>{!! $parklaringInfo->approver->approver_position !!}</p>
                </div>
            </div>
        </div>

        @endsection
@section('script')
@include('layouts.watermark')
@endsection

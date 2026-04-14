<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DKT Parklaring Document</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* CSS reset and base styles */
        body {
            margin: 0;
            padding: 0;
            background-color: #f0f0f0;
            font-family: 'Inter', 'Roboto', 'Segoe UI', sans-serif;
            color: #333;
        }

        /* Print-specific configurations */
        @page {
            size: A4;
            margin: 0; /* Removing margins helps prevent empty pages when printing */
        }

        /* The canvas for our A4 page */
        .a4-page {
            @if(isset($is_pdf) && $is_pdf)
            width: 100%;
            padding: 20mm;
            margin: 0;
            box-sizing: border-box;
            @else
            /* A4 dimensions */
            width: 210mm;
            min-height: 297mm;
            
            /* Add some padding to simulate actual print margins */
            padding: 20mm;
            
            /* Center the page on screen with some margin */
            margin: 10mm auto;
            
            /* Visual styling for screen */
            border: none;
            border-radius: 8px;
            background: white;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05); /* Softer, larger shadow consistent with welcome */
            
            /* Make sure padding doesn't affect the size */
            box-sizing: border-box;
            @endif
            
            /* Optional: ensure contents don't break awkwardly */
            position: relative;
            z-index: -2;
        }

        /* Styling the content */
        .header {
            text-align: center;
            margin-bottom: 30px;
            padding-bottom: 15px;
        }
        
        .header h1 {
            margin: 0 0 10px 0;
            font-size: 24pt;
        }
        
        .header p {
            margin: 0;
            color: #666;
            font-size: 11pt;
        }

        .content {
            font-size: 10pt;
            line-height: 1.6;
        }

        .content p {
            margin-bottom: 15px;
            text-align: justify;
        }

        .footer {
            /* Position footer at the bottom of the page */
            position: absolute;
            bottom: 20mm;
            left: 20mm;
            right: 20mm;
            text-align: center;
            font-size: 10pt;
            color: #888;
            /* border-top: 1px solid #ddd; */
            padding-top: 10px;
        }

        .watermark {
            position: absolute;
            top: 40%;
            @if($parklaringInfo->entity->id == 3)
                left: 16%;
            @else
                left: 30%;
            @endif
            transform: translate(-50%, -50%);
            padding: 0 15px;
            border: 6px solid  rgba(255, 189, 189, 0.13); /* Square border */
            color: rgba(255, 189, 189, 0.13);
            font-size: 30px;
            font-weight: bold;
            text-align: center;
            z-index: 0; /* Below current text */
            pointer-events: none;
            /* Force exact colors to print */
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
            /* Optional: Make it a perfect square */
            display: flex;
            align-items: center;
            justify-content: center;
            transform: rotate(350deg);
        }
        .watermark1 {
            top: 20%;
        }
        .watermark2 {
            top: 30%;
        }
        .watermark3 {
            top: 40%;
        }
        .watermark4 {
            top: 50%;
        }
        .watermark5 {
            top: 60%;
        }

        /* When actually printing (Ctrl+P) */
        @media print {
            .footer {
                position: fixed;
                bottom: 20mm;
            }
            
            html, body {
                /* Reset body to exact A4 size */
                width: 210mm;
                height: 297mm;
                background-color: white;
            }
            .a4-page {
                /* Remove screen-only visual styles */
                margin: 0;
                border: initial;
                border-radius: initial;
                width: initial;
                min-height: initial;
                box-shadow: initial;
                background: initial;
                
                /* If you have multiple pages, this forces a break after each */
                page-break-after: always;
            }
            
            /* Utility class to hide elements during print (like print buttons) */
            .no-print {
                display: none !important;
            }
        }
        
        /* Quick Print Button styling */
        .print-button {
            display: block;
            width: 200px;
            margin: 20px auto;
            padding: 10px 20px;
            background-color: #1f2937;
            color: white;
            border: none;
            border-radius: 8px;
            font-weight: 500;
            font-size: 16px;
            cursor: pointer;
            text-align: center;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            transition: background-color 0.2s, transform 0.1s;
        }
        .print-button:hover {
            background-color: #374151;
        }
        .print-button:active {
            transform: scale(0.98);
        }
        td {
            vertical-align: top;
        }
    </style>
    @yield('script-header')
    
</head>
<body>
    @if(!isset($is_pdf) || !$is_pdf)
    <!-- Print & Download Buttons (hidden when actually printing) -->
    <div class="text-center no-print" style="margin: 20px 0;">
        <button class="print-button d-inline-block mx-2 bg-primary" onclick="downloadPDF()" style="margin: 0; min-width: 150px;">Download PDF</button>
    </div>
    @endif

    <!-- First Page -->
    <div class="a4-page" id="content">
        <div class="header">
            <div class="row">
                <div class="col-3 text-left">
                    @if($parklaringInfo->entity->id==1)
                        <img width="75px" src="{{ asset('images/logo-pdi.png') }}" alt="Logo" style="float:left" width="100px" height="auto">
                    @elseif($parklaringInfo->entity->id==2)
                        <img width="75px" src="{{ asset('images/logo-ydi.png') }}" alt="Logo" style="float:left" width="100px" height="auto">
                    @elseif($parklaringInfo->entity->id==3)
                        <img width="75px" src="{{ asset('images/logo-pda.png') }}" alt="Logo" style="float:left" width="100px" height="auto">
                    @endif
                </div>
                <div class="col-9 d-flex align-items-end justify-content-end">
                    <!-- <h1 class="company-name mb-0" style="font-size: 16px;">{!! $parklaringInfo->entity !!}</h1> -->
                </div>
            </div>  
        </div>

        @yield('content')

        <div class="footer">
            <small>{{ $parklaringInfo->entity->entity_name }}<br>RDTX Place Lantai 10, Jl. Prof. DR Satrio Kav. 3 RT/RW 018/004 Kel. Karet Kuningan,<br>Kec. Setiabudi, Jakarta Selata, DKI Jakarta 12940</small>
        </div>
    </div>

<!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- html2pdf JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
    <script>
        function downloadPDF() {
            const element = document.querySelector('.a4-page');
            
            // Generate PDF from the A4 page container
            const opt = {
                margin:       0,
                filename:     'Surat_Keterangan_Kerja {{ $parklaringInfo->employee_name }}.pdf',
                image:        { type: 'jpeg', quality: 0.98 },
                html2canvas:  { scale: 2, useCORS: true },
                jsPDF:        { unit: 'mm', format: 'a4', orientation: 'portrait' }
            };

            // Keep original styles to restore later
            const originalShadow = element.style.boxShadow;
            const originalBorder = element.style.border;
            const originalMargin = element.style.margin;
            const originalHeight = element.style.height;
            const originalOverflow = element.style.overflow;

            // Before generating, temporarily tweak styles to forcibly prevent extra page bleeding
            element.style.boxShadow = 'none';
            element.style.border = 'none';
            element.style.margin = '0';
            element.style.height = '296.5mm'; // Constrain strictly slightly under 297mm 
            element.style.overflow = 'hidden';

            html2pdf().set(opt).from(element).save().then(() => {
                // Restore styles after generation
                element.style.boxShadow = originalShadow;
                element.style.border = originalBorder;
                element.style.margin = originalMargin;
                element.style.height = originalHeight;
                element.style.overflow = originalOverflow;
            });
        }
    </script>

    @yield('script')
</body>
</html>
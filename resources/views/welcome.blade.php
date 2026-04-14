<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>DKT Indonesia</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
        
        <!-- Bootstrap 3.4.1 (legacy support requested for a4 print) -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">

        <!-- Optional theme -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/css/bootstrap-theme.min.css" integrity="sha384-6pzBo3FDv/PJ8r2KRkGHifhEocL+1X2rVCTTkUfGk7/0pbek5mMa1upzvWbrUbOZ" crossorigin="anonymous">

        <!-- Latest compiled and minified JavaScript -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/js/bootstrap.min.js" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous"></script>
        
        <!-- Styles -->
        <style>
            body {
                font-family: 'Inter', sans-serif;
                background-color: #f3f4f6;
                color: #1f2937;
                margin: 0;
                padding: 0;
            }
            
            /* A4 Print Styles */
            @page {
                size: A4;
                margin: 0;
            }
            .a4-page {
                width: 210mm;
                min-height: 297mm;
                padding: 15mm 20mm;
                margin: 40px auto;
                background: white;
                box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05); /* Softer, larger shadow */
                border-radius: 8px; /* Slight rounding for screen presentation */
                box-sizing: border-box;
                position: relative;
            }
            @media print {
                html, body {
                    width: 210mm;
                    height: 297mm;
                    background-color: white !important;
                    margin: 0;
                    padding: 0;
                }
                .a4-page {
                    margin: 0;
                    padding: 15mm 20mm;
                    border: none;
                    border-radius: 0;
                    box-shadow: none;
                    width: 100%;
                    height: 100%;
                    page-break-after: always;
                }
                .no-print {
                    display: none !important;
                }
            }
            
            .print-btn-container {
                position: fixed;
                bottom: 30px;
                right: 30px;
                z-index: 1000;
            }
            
            .btn-print {
                background-color: #1f2937;
                color: white;
                border: none;
                border-radius: 50%;
                width: 60px;
                height: 60px;
                box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.2);
                display: flex;
                align-items: center;
                justify-content: center;
                cursor: pointer;
                transition: transform 0.2s, background-color 0.2s;
            }
            .btn-print:hover {
                transform: scale(1.05);
                background-color: #374151;
                color: white;
            }
            
            /* Print Content Tweaks */
            .table-striped > tbody > tr:nth-of-type(odd) {
                background-color: #f9fafb;
            }
            .table > tbody > tr > th, .table > tbody > tr > td {
                border-color: #e5e7eb;
                padding: 12px;
            }
            .content-section {
                border: 1px solid #e5e7eb;
                border-radius: 8px;
                overflow: hidden;
                margin-top: 20px;
            }
        </style>
    </head>
    <body class="antialiased">
        
        <div class="print-btn-container no-print">
            <button onclick="window.print()" class="btn-print" title="Print Document">
                <i class="glyphicon glyphicon-print" style="font-size: 24px; top: 2px;"></i>
            </button>
        </div>

        <div class="a4-page">
            <div style="display: flex; justify-content: space-between; align-items: flex-start; border-bottom: 2px solid #1f2937; padding-bottom: 20px; margin-bottom: 30px;">
                <div>
                    <img src="https://www.sahabatandalan.com/wp-content/uploads/2021/04/Group-147.png" alt="DKT Logo" style="height: 50px;">
                </div>
                <div style="text-align: right;">
                    <?php echo DNS2D::getBarcodeHTML('http://parklaring.test/', 'QRCODE'); ?>
                </div>
            </div>
            
            <div class="text-center" style="margin-bottom: 40px;">
                <h2 style="font-weight: 700; font-family: 'Inter', sans-serif; margin-top: 0; text-transform: uppercase; letter-spacing: 1px; color: #111827;">Employment Validation</h2>
            </div>
            
            <div class="content-section">
                <table class="table table-striped" style="margin-bottom:0;">
                    <tr>
                        <th style="color: #4b5563; font-weight: 600;">Date</th>
                        <th style="color: #4b5563; font-weight: 600;">Personal ID Number</th>
                        <th style="color: #4b5563; font-weight: 600;">Name</th>
                        <th style="color: #4b5563; font-weight: 600;">Address</th>
                    </tr>   
                    <tr>
                        <td>20 January 2025</td>
                        <td>1234567890</td>
                        <td>Saryanto</td>
                        <td>Jl Ki Hajar Dewantoro No 30 Ciputat, Tangerang Selatan, Banten</td>
                    </tr>
                </table>
                <table class="table table-striped" style="margin-bottom:0;">
                    <tr>
                        <th style="color: #4b5563; font-weight: 600;">Letter Number</th>
                        <th style="color: #4b5563; font-weight: 600;">Office</th>
                        <th style="color: #4b5563; font-weight: 600;">Date Join</th>
                        <th style="color: #4b5563; font-weight: 600;">Date Resign</th>
                    </tr>
                    <tr>
                        <td>020/DKT-ER/I/2025</td>
                        <td>PT DKT International</td>
                        <td>1 January 2024</td>
                        <td>30 December 2024</td>
                    </tr>
                </table>
            </div>

            <div class="content-section">
                <table class="table table-striped" style="margin-bottom:0;">
                    <tr>
                        <th style="color: #4b5563; font-weight: 600;">Date</th>
                        <th style="color: #4b5563; font-weight: 600;">Personal ID Number</th>
                        <th style="color: #4b5563; font-weight: 600;">Name</th>
                        <th style="color: #4b5563; font-weight: 600;">Address</th>
                    </tr>   
                    <tr>
                        <td>20 January 2025</td>
                        <td>1234567890</td>
                        <td>Saryanto</td>
                        <td>Jl Ki Hajar Dewantoro No 30 Ciputat, Tangerang Selatan, Banten</td>
                    </tr>
                </table>
                <table class="table table-striped" style="margin-bottom:0;">
                    <tr>
                        <th style="color: #4b5563; font-weight: 600;">Letter Number</th>
                        <th style="color: #4b5563; font-weight: 600;">Office</th>
                        <th style="color: #4b5563; font-weight: 600;">Date Join</th>
                        <th style="color: #4b5563; font-weight: 600;">Date Resign</th>
                    </tr>
                    <tr>
                        <td>020/DKT-ER/I/2025</td>
                        <td>PT DKT International</td>
                        <td>1 January 2024</td>
                        <td>30 December 2024</td>
                    </tr>
                </table>
            </div>

            <div style="position: absolute; bottom: 30px; left: 0; right: 0; text-align: center;">
                <div style="color: #9ca3af; font-size: 14px;">
                    DKT Indonesia &copy;<?php echo (date('Y', strtotime(now())));?>, all rights reserved.
                </div>
            </div>
        </div>
        
    </body>
</html>

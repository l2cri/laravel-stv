<html>
<head>
    <style type="text/css">
        th{text-align: left;}
        td, th {height: 35px}

        table table {
            width: 600px !important;
            padding: 2%;
        }
        table div + div { /* main content */
            width: 100%;
        }
        table div + div + div { /* sidebar */
            width: 100%;
        }
        table div + div + div + div { /* footer */
            width: 100%;
            float: none;
            clear: both;
        }

        @media (max-width: 630px) {
            table table {
                width: 96% !important;
            }
            table div {
                float: none !important;
                width: 100% !important;
            }
        }
    </style>
</head>
<body style="margin: 0; padding: 0; background: #ccc;">
<table cellpadding=0 cellspacing=0 style="width: 100%;"><tr><td style="padding: 12px 2%;">
            <table cellpadding=0 cellspacing=0 style="margin: 0 auto; background: #fff; width: 96%;">
                <tr><td style="padding: 12px 2%;">

                        <div>
                            <img src="{{ url('http://stage.buy26.ru/img/logo-main.png') }}">
                        </div>

                        <br><br>

                        @yield('content')

                        <div style="border-top: solid 1px #ccc;">
                            <p>
                                http://www.buy26.ru<br>
                                <br>
                                8 800 111 22 33<br>
                                г. Ставрополь, пр. Мира, д. 1
                            </p>
                        </div>

                    </td></tr></table>
        </td></tr></table>
</body>
</html>

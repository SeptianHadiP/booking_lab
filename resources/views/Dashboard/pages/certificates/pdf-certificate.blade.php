<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Sertifikat</title>
    <style>
        @page { margin: 0; }
        body {
            margin: 0;
            padding: 0;
        }

        /* Daftarkan font Lobster (akses via public/storage) */
        @font-face {
            font-family: 'Lobster';
            src: url('{{ public_path('/Lobster/Lobster-Regular.ttf') }}') format('truetype');
            font-weight: normal;
            font-style: normal;
        }

        .certificate {
            position: relative;
            width: 100%;
            height: 100%;
        }

        .background {
            position: absolute;
            top: 0; left: 0;
            width: 100%;
            height: auto;
            z-index: 0;
        }

        .text {
            position: absolute;
            z-index: 1;
            white-space: nowrap;
        }

        .name {
            font-family: 'lobster', sans-serif;
            font-size: 40px;
            font-weight: bold;
            color: {{ $fontColor }};
        }

        .desc {
            font-size: 20px;
            font-weight: bold;
        }

        .score {
            font-size: 30px;
            font-weight: bold;
        }
    </style>

</head>
<body>
    <div class="certificate">
        <img src="{{ $bgImage }}" class="background" alt="Certificate Background">

        <div class="text desc"
             style="left: {{ $descXType === 'center' ? '50%' : $descX . 'px' }};
                    top: {{ $descYType === 'center' ? '45%' : $descY . 'px' }};
                    {{ $descXType === 'center' ? 'transform: translateX(-50%);' : '' }}">
            {{ $course }}
        </div>

        <div class="text name"
            style="left: {{ $nameXType === 'center' ? '50%' : $nameX . 'px' }};
                    top: {{ $nameYType === 'center' ? '50%' : $nameY . 'px' }};
                    {{ $nameXType === 'center' || $nameYType === 'center' ? 'transform: translate(-50%, -50%);' : '' }}">
            {{ $name }}
        </div>

        <div class="text score"
             style="left: {{ $scoreXType === 'center' ? '50%' : $scoreX . 'px' }};
                    top: {{ $scoreYType === 'center' ? '48%' : $scoreY . 'px' }};
                    {{ $scoreXType === 'center' ? 'transform: translateX(-50%);' : '' }}">
            {{ $score }}
        </div>
    </div>
</body>
</html>

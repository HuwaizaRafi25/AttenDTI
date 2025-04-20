<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sertifikat</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&family=Pacifico&display=swap"
        rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<style>
    body, html {
      margin: 0;
      padding: 0;
      height: 100%;
    }

    .bg-template {
      background-image: url('{{ asset('assets/images/template-sertifikat.png') }}');
      background-size: cover;
      background-position: center;
      background-size: contain;
      min-height: 100vh;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      color: #1E3A8A;
      font-family: 'Roboto', sans-serif;
      padding: 20px;
      box-sizing: border-box;
    }
  </style>

<body>
    <div class="bg-template font-roboto text-blue-900 min-h-screen flex flex-col justify-center">
        <div class="header flex justify-between items-center">
            <div>
                <h1 class="text-4xl font-bold">Sertifikat</h1>
                <p class="text-sm">101/ITI.B05.3/DL.09/2024</p>
            </div>
        </div>

        <div class="content text-center mt-8">
            <p class="text-lg">Sertifikat ini diberikan kepada:</p>
            <h2 class="text-5xl font-weight-200 my-4" style="font-family: 'Pacifico', cursive;">Adithya Restu Andayana</h2>
            <p class="text-md">Telah melaksanakan Praktek Kerja Lapangan (PKL)</p>
            <p class="text-md">di Direktorat Teknologi Informasi ITB</p>
            <p class="text-md">dari tanggal 22 April 2024 - 13 September 2024</p>
        </div>

        <div class="footer mt-8 flex flex-col items-center">
            <img src="{{ asset('assets/images/ttd.png-removebg-preview.png') }}" alt="Tanda Tangan" class="w-32 h-32">
            <div class="text-center">
                <p class="text-md font-bold">Yustinus Dwiharjanto, S.Kom.</p>
                <p class="text-sm">Kepala Seksi Layanan Teknologi Informasi</p>
            </div>
        </div>
    </div>
</body>

</html>

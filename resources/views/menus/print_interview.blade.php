<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />
  <title>AttenDti</title>
  <link rel="shortcut icon" href="{{ asset('assets/images/icons/dti_icon.png') }}" type="image/x-icon" />
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-50 min-h-screen p-4 md:p-8">
  <div id="form-container" class="max-w-4xl mx-auto bg-white rounded-xl shadow-lg p-6 md:p-8">
    <h1 class="text-3xl font-bold text-gray-800 mb-8 text-center">Formulir Exit Clearance</h1>

    <form class="space-y-12" id="clearanceForm">
      <section>
        <h2 class="text-xl font-semibold text-gray-700 border-b pb-2 mb-4">Pengalaman Program</h2>
        <div class="space-y-4 mt-4">
          <div class="grid gap-4 items-center">
            <label class="text-sm font-medium text-gray-700">1. Bagaimana Anda menilai pengalaman Anda secara keseluruhan selama magang/praktik kerja di DTI?</label>
            <input type="text" name="question1" placeholder="Keterangan" class="w-full p-2 border border-gray-300 rounded-md sync-input" data-target="modal-input1">
          </div>
        </div>
        <div class="space-y-4 mt-4">
          <div class="grid gap-4 items-center">
            <label class="text-sm font-medium text-gray-700">2. Apakah tugas yang diberikan sesuai dengan harapan dan bidang studi Anda?</label>
            <input type="text" name="question2" placeholder="Keterangan" class="w-full p-2 border border-gray-300 rounded-md sync-input" data-target="modal-input2">
          </div>
        </div>
        <div class="space-y-4 mt-4">
          <div class="grid gap-4 items-center">
            <label class="text-sm font-medium text-gray-700">3. Bagaimana Anda menilai dukungan yang Anda terima dari PIC dan tim kerja?</label>
            <input type="text" name="question3" placeholder="Keterangan" class="w-full p-2 border border-gray-300 rounded-md sync-input" data-target="modal-input3">
          </div>
        </div>
        <div class="space-y-4 mt-4">
          <div class="grid gap-4 items-center">
            <label class="text-sm font-medium text-gray-700">4. Bagaimana Anda menilai fasilitas dan sumber daya yang tersedia untuk mendukung kerja Anda?</label>
            <input type="text" name="question4" placeholder="Keterangan" class="w-full p-2 border border-gray-300 rounded-md sync-input" data-target="modal-input4">
          </div>
        </div>
        <div class="space-y-4 mt-4">
          <div class="grid gap-4 items-center">
            <label class="text-sm font-medium text-gray-700">5. Bagaimana Anda merasa keterampilan Anda berkembang selama program ini?</label>
            <input type="text" name="question5" placeholder="Keterangan" class="w-full p-2 border border-gray-300 rounded-md sync-input" data-target="modal-input5">
          </div>
        </div>
      </section>

      <section>
        <h2 class="text-xl font-semibold text-gray-700 border-b pb-2 mb-4">Saran dan Umpan Balik</h2>
        <div class="space-y-4 mt-4">
          <div class="grid gap-4 items-center">
            <label class="text-sm font-medium text-gray-700">6. Apa aspek terbaik dari program magang/praktik kerja di DTI yang paling Anda sukai?</label>
            <input type="text" name="question6" placeholder="Keterangan" class="w-full p-2 border border-gray-300 rounded-md sync-input" data-target="modal-input6">
          </div>
        </div>
        <div class="space-y-4 mt-4">
          <div class="grid gap-4 items-center">
            <label class="text-sm font-medium text-gray-700">7. Apa yang menurut Anda perlu ditingkatkan dalam program ini di DTI?</label>
            <input type="text" name="question7" placeholder="Keterangan" class="w-full p-2 border border-gray-300 rounded-md sync-input" data-target="modal-input7">
          </div>
        </div>
        <div class="space-y-4 mt-4">
          <div class="grid gap-4 items-center">
            <label class="text-sm font-medium text-gray-700">8. Apakah pengalaman ini membantu Anda dalam merencanakan karir di masa depan?</label>
            <input type="text" name="question8" placeholder="Keterangan" class="w-full p-2 border border-gray-300 rounded-md sync-input" data-target="modal-input8">
          </div>
        </div>
        <div class="space-y-4 mt-4">
          <div class="grid gap-4 items-center">
            <label class="text-sm font-medium text-gray-700">9. Apakah ada saran atau umpan balik lain yang ingin Anda berikan untuk peningkatan program ini di DTI?</label>
            <input type="text" name="question9" placeholder="Keterangan" class="w-full p-2 border border-gray-300 rounded-md sync-input" data-target="modal-input9">
          </div>
        </div>
      </section>

      <div class="flex justify-end space-x-4 pt-6">
        <div onclick="openModal()" class="px-6 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 cursor-pointer">
          Print
        </div>
      </div>
    </form>
  </div>

  <!-- Modal -->
  <div id="userReportModal" class="fixed inset-0 items-center justify-center bg-black bg-opacity-70 z-50 hidden">
    <div class="bg-gray-50 text-white rounded-lg shadow-lg m-6 p-6 h-[95vh] max-w-xl md:max-w-4xl w-full">
      <div class="overflow-y-auto h-[80vh] space-y-4">
        <!-- Container yang akan dicetak -->
        <div id="laporanTransaksi" class="laporanTransaksi h-auto p-8 rounded-md max-width-full border-2 bg-white text-black" style="aspect-ratio: 2480 / 3508;">
          <table class="w-full border border-gray-800 table-fixed opacity-70">
            <tr>
              <td class="w-1/6 border-r border-gray-800 text-center p-2">
                <img src="{{ asset('assets/images/logo_itb_512.png') }}" alt="Logo" class="w-20 mx-auto my-2">
              </td>
              <td class="w-5/6">
                <table class="w-full">
                  <tr>
                    <td class="text-center p-2">
                      <div class="text-base font-bold">DIREKTORAT TEKNOLOGI INFORMASI ITB</div>
                      <div class="text-sm text-gray-600">Gedung CRCS Lantai 4, Jalan Ganesha Nomor 10 Bandung 40132 Telp: +6222 86010037</div>
                    </td>
                  </tr>
                  <tr>
                    <td class="bg-blue-600 text-white text-center p-2">
                      <div class="font-bold">FORMULIR EXIT CLEARANCE</div>
                    </td>
                  </tr>
                  <tr>
                    <td class="p-0">
                      <table class="w-full text-sm border-t border-gray-800">
                        <tr>
                          <td class="border-r border-gray-800 p-1">Nomor : FRM.07-OPL.01</td>
                          <td class="border-r border-gray-800 p-1">Revisi : 0</td>
                          <td class="border-r border-gray-800 p-1">Tanggal: {{ date('d M Y') }}</td>
                          <td class="p-1">Halaman : 1 dari 1</td>
                        </tr>
                      </table>
                    </td>
                  </tr>
                </table>
              </td>
            </tr>
          </table>

          <!-- Body Laporan -->
          <div class="p-8" id="laporanContainer">
            <div class="mt-4 space-y-4">
              <div class="text-center space-y-2">
                <h1 class="text-2xl font-bold">Form Evaluasi Exit Interview</h1>
                <h2 class="text-xl">Personel Magang/PKL</h2>
              </div>

              <div class="space-y-2">
                <h3 class="text-xl font-bold">Pengalaman Program</h3>
                <div class="space-y-4">
                  <div class="space-y-2">
                    <p class="font-medium">1. Bagaimana Anda menilai pengalaman Anda secara keseluruhan selama magang/praktik kerja di DTI?</p>
                    <input type="text" id="modal-input1" class="w-full border border-gray-300 rounded px-3 py-2 h-12" readonly>
                  </div>
                  <div class="space-y-2">
                    <p class="font-medium">2. Apakah tugas yang diberikan sesuai dengan harapan dan bidang studi Anda?</p>
                    <input type="text" id="modal-input2" class="w-full border border-gray-300 rounded px-3 py-2 h-12" readonly>
                  </div>
                  <div class="space-y-2">
                    <p class="font-medium">3. Bagaimana Anda menilai dukungan yang Anda terima dari PIC dan tim kerja?</p>
                    <input type="text" id="modal-input3" class="w-full border border-gray-300 rounded px-3 py-2 h-12" readonly>
                  </div>
                  <div class="space-y-2">
                    <p class="font-medium">4. Bagaimana Anda menilai fasilitas dan sumber daya yang tersedia untuk mendukung kerja Anda?</p>
                    <input type="text" id="modal-input4" class="w-full border border-gray-300 rounded px-3 py-2 h-12" readonly>
                  </div>
                  <div class="space-y-2">
                    <p class="font-medium">5. Bagaimana Anda merasa keterampilan Anda berkembang selama program ini?</p>
                    <input type="text" id="modal-input5" class="w-full border border-gray-300 rounded px-3 py-2 h-12" readonly>
                  </div>

                  <h3 class="text-xl font-bold">Saran dan Umpan Balik</h3>
                  <div class="space-y-2">
                    <p class="font-medium">6. Apa aspek terbaik dari program magang/praktik kerja di DTI yang paling Anda sukai?</p>
                    <input type="text" id="modal-input6" class="w-full border border-gray-300 rounded px-3 py-2 h-12" readonly>
                  </div>
                  <div class="space-y-2">
                    <p class="font-medium">7. Apa yang menurut Anda perlu ditingkatkan dalam program ini di DTI?</p>
                    <input type="text" id="modal-input7" class="w-full border border-gray-300 rounded px-3 py-2 h-12" readonly>
                  </div>
                  <div class="space-y-2">
                    <p class="font-medium">8. Apakah pengalaman ini membantu Anda dalam merencanakan karir di masa depan?</p>
                    <input type="text" id="modal-input8" class="w-full border border-gray-300 rounded px-3 py-2 h-12" readonly>
                  </div>
                  <div class="space-y-2">
                    <p class="font-medium">9. Apakah ada saran atau umpan balik lain yang ingin Anda berikan untuk peningkatan program ini di DTI?</p>
                    <input type="text" id="modal-input9" class="w-full border border-gray-300 rounded px-3 py-2 h-12" readonly>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="flex gap-x-2 py-3">
        <button class="w-full px-4 py-2 text-sm font-medium text-gray-800 rounded-md hover:text-gray-900 border-2" id="userReportClose" onclick="closeModal()">Kembali</button>
        <button class="w-full px-4 py-2 text-sm font-medium text-white bg-green-600 rounded-md hover:bg-green-700" onclick="printDiv('laporanTransaksi')">Cetak Laporan</button>
      </div>
    </div>
  </div>

  <script>
    // Fungsi untuk menyalin nilai dari form ke input modal
    function syncFormToModal() {
      // Untuk setiap input di form yang memiliki kelas .sync-input
      document.querySelectorAll('.sync-input').forEach(input => {
        // Ambil target modal dari atribut data-target
        const targetId = input.getAttribute('data-target');
        if (targetId) {
          const modalInput = document.getElementById(targetId);
          if (modalInput) {
            modalInput.value = input.value;
          }
        }
      });
    }

    // Fungsi untuk membuka modal dan menyinkronkan data
    function openModal() {
      // Sinkronkan data form ke modal
      syncFormToModal();
      // Tampilkan modal
      document.getElementById('userReportModal').classList.remove('hidden');
      document.getElementById('userReportModal').classList.add('flex');
    }

    function closeModal() {
      document.getElementById('userReportModal').classList.add('hidden');
      document.getElementById('userReportModal').classList.remove('flex');
    }

    function printDiv(divId) {
      // Sebelum mencetak, sinkronkan kembali data form ke modal
      syncFormToModal();
      var printContents = document.getElementById(divId).innerHTML;
      var originalContents = document.body.innerHTML;

      document.body.innerHTML = printContents;
      window.print();
      document.body.innerHTML = originalContents;
      // Opsional: reload halaman untuk mengembalikan state semula
      location.reload();
    }
  </script>
</body>

</html>

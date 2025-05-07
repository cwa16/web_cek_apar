<x-filament::page>
    <div class="p-6 bg-white shadow rounded-lg">
        <h2 class="text-xl font-bold mb-4">Data Monitoring APAR</h2>
        <table class="w-full border-collapse border border-gray-300" style="font-size: 10px;">
            <thead>
                <tr class="bg-gray-200">
                    <th class="border p-2">No</th>
                    <th class="border p-2">Kode APAR</th>
                    <th class="border p-2">No APAR</th>
                    <th class="border p-2">Dept.</th>
                    <th class="border p-2">Lokasi</th>
                    <th class="border p-2">Jarum Tekanan</th>
                    <th class="border p-2">Segel</th>
                    <th class="border p-2">Handgrip</th>
                    <th class="border p-2">Tabung</th>
                    <th class="border p-2">Selang</th>
                    <th class="border p-2">Nozzle</th>
                    <th class="border p-2">Judge</th>
                    <th class="border p-2">Keterangan</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($cekApars as $index => $apar)
                    <tr class="text-center">
                        <td class="border border-gray-300 px-4 py-2">{{ $index + 1 }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $apar->kode_apar }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $apar->apar->no_apar }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $apar->apar->dept }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $apar->apar->lokasi }}</td>
                        <td class="border border-gray-300 px-4 py-2">{!! $apar->segel == 0 ? "<span class='x-symbol' data-image='".asset($apar->seal_image)."'>❌</span>" : '⭕' !!}</td>
                        <td class="border border-gray-300 px-4 py-2">
                            {!! $apar->jarum_tekanan == 0
                                ? "<span class='x-symbol cursor-pointer text-red-500' data-image='" . asset($apar->pressure_gauge_image) . "'>❌</span>"
                                : '⭕' !!}
                        </td>
                        <td class="border border-gray-300 px-4 py-2">{!! $apar->handgrip == 0 ? "<span class='x-symbol' data-image='".asset($apar->handgrip_image)."'>❌</span>" : '⭕' !!}</td>
                        <td class="border border-gray-300 px-4 py-2">{!! $apar->tabung == 0 ? "<span class='x-symbol' data-image='".asset($apar->tabung)."'>❌</span>" : '⭕' !!}</td>
                        <td class="border border-gray-300 px-4 py-2">{!! $apar->selang == 0 ? "<span class='x-symbol' data-image='".asset($apar->selang)."'>❌</span>" : '⭕' !!}</td>
                        <td class="border border-gray-300 px-4 py-2">{!! $apar->nozzle == 0 ? "<span class='x-symbol' data-image='".asset($apar->nozzle)."'>❌</span>" : '⭕' !!}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $apar->result }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $apar->remark }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Improved Image Modal -->
    <div id="imageModal" class="modal hidden">
        <div class="modal-overlay"></div>
        <div class="modal-content">
            <span class="close">&times;</span>
            <img id="modalImage" src="" class="max-w-full h-auto rounded-lg">
        </div>
    </div>

    <style>
        .modal {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.7);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 9999;
        }

        .modal-content {
            background: white;
            padding: 20px;
            border-radius: 10px;
            position: relative;
            max-width: 80%;
            max-height: 80%;
            overflow: hidden;
        }

        .close {
            position: absolute;
            top: 10px;
            right: 10px;
            cursor: pointer;
            font-size: 24px;
            font-weight: bold;
            color: #333;
        }

        .x-symbol {
            cursor: pointer;
            color: red;
            font-size: 20px;
        }

        .hidden {
            display: none;
        }

        .modal-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
        }
    </style>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const modal = document.getElementById("imageModal");
            const modalImage = document.getElementById("modalImage");
            const closeModal = document.querySelector(".close");
            const overlay = document.querySelector(".modal-overlay");

            document.querySelectorAll(".x-symbol").forEach(item => {
                item.addEventListener("click", function() {
                    let imageUrl = this.getAttribute("data-image");
                    if (imageUrl) {
                        modalImage.src = imageUrl;
                        modal.classList.remove("hidden");
                    }
                });
            });

            closeModal.addEventListener("click", function() {
                modal.classList.add("hidden");
            });

            overlay.addEventListener("click", function() {
                modal.classList.add("hidden");
            });
        });
    </script>
</x-filament::page>

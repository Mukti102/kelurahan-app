 <!-- Footer Surat -->
 <div class="row mt-5">
     <div class="col-6"></div>
     <div class="col-6 text-center">
         <div>
             <p class="mb-0">Dikeluarkan di: Kelurahan {{ $pengaturan->kelurahan }}</p>
             <p>Pada Tanggal: <span class="fw-medium">{{ \Carbon\Carbon::now()->format('d M Y') }}</span></p>
         </div>
         <br>
         <br>
         <br>
         <br>
         <div>
             <p style="text-transform: capitalize" class="fw-bold mb-0">Lurah {{ $pengaturan->kelurahan }}</p>
             <p style="text-transform: uppercase" class="mb-0">( {{ $pengaturan->nama_lurah }} )</p>
             <p>NIP: {{ $pengaturan->nip_lurah }}</p>
         </div>
     </div>
 </div>

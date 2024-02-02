{{-- Confirmation Letter Modal --}}
<div class="modal fade" id="confirmationLetterModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-head" id="confirmationLetterModalTitle">Konfirmasi Surat</h5>
        <button
          type="button"
          data-bs-dismiss="modal"
          aria-label="Close">
					<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
						<path d="M8.03222 9.56774C7.91783 9.67651 7.84836 9.74037 7.78099 9.80704C5.8673 11.7235 3.95151 13.6386 2.04134 15.5593C1.70309 15.8997 1.31572 16.0498 0.851162 15.9228C0.11432 15.7214 -0.195856 14.8302 0.245548 14.2056C0.315723 14.106 0.404143 14.019 0.490459 13.932C2.3852 12.033 4.27994 10.1341 6.17748 8.23791C6.25046 8.16493 6.34941 8.11791 6.43642 8.05826C6.44063 8.01546 6.44555 7.97195 6.44976 7.92914C6.35993 7.8737 6.25607 7.833 6.18309 7.76072C4.27291 5.85265 2.36695 3.94037 0.457479 2.0316C0.2259 1.80002 0.0574769 1.54458 0.0476524 1.20704C0.0329155 0.732651 0.228707 0.367737 0.650461 0.153C1.06941 -0.0610347 1.48134 -0.0147194 1.85888 0.270895C1.94941 0.338965 2.0273 0.423878 2.108 0.50458C3.99713 2.39651 5.88625 4.28844 7.77397 6.18247C7.84134 6.24984 7.88835 6.33756 7.95993 6.43651C8.08204 6.32072 8.15713 6.25195 8.22941 6.18037C10.1431 4.26388 12.0589 2.34809 13.9691 0.427387C14.308 0.086334 14.6975 -0.0582273 15.1613 0.0744042C15.9073 0.287738 16.2006 1.1944 15.7333 1.81826C15.6547 1.92283 15.5599 2.01546 15.4673 2.10809C13.5915 3.98879 11.715 5.86879 9.83713 7.74669C9.76344 7.82037 9.67432 7.87931 9.56906 7.96353C9.67362 8.0737 9.74169 8.14879 9.81327 8.22107C11.7143 10.1256 13.6147 12.0309 15.5185 13.9341C15.748 14.1635 15.9319 14.4098 15.9522 14.7481C15.9817 15.233 15.7929 15.6105 15.3634 15.8351C14.9368 16.0583 14.515 16.0119 14.1333 15.7137C14.0098 15.6169 13.9038 15.4976 13.7922 15.386C11.9403 13.5312 10.0884 11.6765 8.23783 9.81967C8.16836 9.7516 8.11432 9.66949 8.03222 9.56774Z" fill="#282421" fill-opacity="0.32"/>
					</svg>
				</button>
      </div>
      <div class="modal-body">
        <p>
        Konfirmasi Menyetujui Surat: Apakah Anda yakin ingin menyetujui
        surat ini? Tindakan ini tidak dapat dibatalkan dan konfirmasi 
        anda akan langsung dikirimkan.
        </p>
      </div>
      <form action="{{ route('letters.approve', $get_letter->id) }}" method="POST" class="d-flex justify-content-center">
        @csrf
        @method("PUT")
        <div class="flex justify-content-center gap-3 mb-4 w-100 px-4">
            <button type="submit" class="button btn-main w-100">Setujui Surat</button>
            <button type="button" class="button btn-second w-100" data-bs-dismiss="modal">
                Batal Setujui
            </button>
        </div>
      </form>
    </div>
  </div>
</div>

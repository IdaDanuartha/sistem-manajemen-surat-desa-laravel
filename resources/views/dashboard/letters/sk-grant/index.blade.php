@extends('layouts.main')
@section('title', 'Halaman Surat Hibah Samsat')

@section('main')
    <div class="table-wrapper mt-[20px]">
        <div class="flex justify-between items-center gap-3">
            <div class="input-wrapper flex gap-2 items-center">
                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 12 12" fill="none">
                    <path d="M9.75 4.875C9.75 5.95078 9.40078 6.94453 8.8125 7.75078L11.7797 10.7203C12.0727 11.0133 12.0727 11.4891 11.7797 11.782C11.4867 12.075 11.0109 12.075 10.718 11.782L7.75078 8.8125C6.94453 9.40312 5.95078 9.75 4.875 9.75C2.18203 9.75 0 7.56797 0 4.875C0 2.18203 2.18203 0 4.875 0C7.56797 0 9.75 2.18203 9.75 4.875ZM4.875 8.25C5.31821 8.25 5.75708 8.1627 6.16656 7.99309C6.57603 7.82348 6.94809 7.57488 7.26149 7.26149C7.57488 6.94809 7.82348 6.57603 7.99309 6.16656C8.1627 5.75708 8.25 5.31821 8.25 4.875C8.25 4.43179 8.1627 3.99292 7.99309 3.58344C7.82348 3.17397 7.57488 2.80191 7.26149 2.48851C6.94809 2.17512 6.57603 1.92652 6.16656 1.75691C5.75708 1.5873 5.31821 1.5 4.875 1.5C4.43179 1.5 3.99292 1.5873 3.58344 1.75691C3.17397 1.92652 2.80191 2.17512 2.48851 2.48851C2.17512 2.80191 1.92652 3.17397 1.75691 3.58344C1.5873 3.99292 1.5 4.43179 1.5 4.875C1.5 5.31821 1.5873 5.75708 1.75691 6.16656C1.92652 6.57603 2.17512 6.94809 2.48851 7.26149C2.80191 7.57488 3.17397 7.82348 3.58344 7.99309C3.99292 8.1627 4.43179 8.25 4.875 8.25Z"
                          fill="#282421" fill-opacity="0.52"/>
                </svg>
                <input type="search" class="searchInputTable w-full focus:ring-0 focus:outline-none" placeholder="Cari surat ...">
            </div>
            @if (auth()->user()->isCitizent() || auth()->user()->isSuperAdmin())
            <div class="flex">
                <a href="{{ route('letters.sk-grant.create') }}"
                    class="flex button btn-main duration-200 capitalize w-max items-center gap-1" type="button">
                    Tambah
                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 12 12" fill="none">
                            <g clip-path="url(#clip0_7909_670)">
                                    <path d="M5.59868 11.9841C5.51903 11.9548 5.43528 11.9331 5.36022 11.8945C5.09928 11.7602 4.94839 11.5457 4.91571 11.2524C4.9083 11.1868 4.90779 11.1201 4.90779 11.0542C4.90728 9.78863 4.90754 8.52301 4.90754 7.25714C4.90754 7.20735 4.90754 7.15756 4.90754 7.09041C4.84728 7.09041 4.79826 7.09041 4.74924 7.09041C3.46422 7.09041 2.17945 7.09093 0.894429 7.09016C0.474685 7.08991 0.16728 6.87901 0.0531524 6.51697C0.0449822 6.49118 0.034259 6.46437 0.034259 6.43782C0.0329824 6.14675 0.00591727 5.85237 0.040896 5.56565C0.0840449 5.2128 0.391705 4.95697 0.744811 4.92199C0.806598 4.91586 0.869151 4.91459 0.931449 4.91459C2.2009 4.91407 3.47009 4.91433 4.73954 4.91433C4.78932 4.91433 4.83937 4.91433 4.90754 4.91433C4.90754 4.8551 4.90754 4.80633 4.90754 4.75731C4.90754 3.47229 4.90856 2.18701 4.90677 0.901989C4.90626 0.542755 5.04592 0.267776 5.37145 0.10284C5.60966 -0.0176703 6.38098 -0.0189474 6.61894 0.100797C6.88422 0.234585 7.04124 0.450074 7.07519 0.748542C7.0826 0.814159 7.08362 0.880542 7.08362 0.94667C7.08413 2.21229 7.08388 3.4779 7.08388 4.74378C7.08388 4.79382 7.08388 4.84412 7.08388 4.91433C7.14107 4.91433 7.18983 4.91433 7.23834 4.91433C8.4843 4.91433 9.73051 4.92429 10.9762 4.90948C11.4657 4.90361 11.8394 5.07441 11.9766 5.60522C11.9766 5.86999 11.9766 6.13475 11.9766 6.39978C11.8384 6.93441 11.46 7.10088 10.9765 7.09552C9.73103 7.08122 8.48558 7.09067 7.24013 7.09067C7.19136 7.09067 7.1426 7.09067 7.08388 7.09067C7.08388 7.15961 7.08388 7.20939 7.08388 7.25944C7.08388 8.53629 7.0826 9.81314 7.0849 11.09C7.08541 11.3422 7.02158 11.5654 6.84081 11.7487C6.71596 11.8754 6.55741 11.9348 6.39298 11.9844C6.12847 11.9841 5.86371 11.9841 5.59868 11.9841Z"
                                                fill="white"/>
                            </g>
                            <defs>
                                    <clipPath id="clip0_7909_670">
                                            <rect width="12" height="12" fill="white"/>
                                    </clipPath>
                            </defs>
                    </svg>
                </a>
            </div>
            @endif
        </div>
        <div class="mt-[32px]">
            <table class="dataTable w-full ">
                <thead>
                <tr>
                    <th>#</th>
                    <th class="md:table-cell">Kode</th>
                    <th class="md:table-cell">Nomor Surat</th>
                    @if (auth()->user()->isCitizent() || auth()->user()->isSuperAdmin())
                        <th class="md:table-cell">Status Surat</th>
                    @endif
                    <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
                @forelse($letters as $item)
                    <tr class="table-body">
                        <input type="hidden" class="letter_id" value="{{ $item->id }}">
                        <td>{{ $loop->iteration }}</td>
                        <td class="md:table-cell">#{{ $item->sk->code }}</td>
                        <td class="md:table-cell">{{ $item->sk->reference_number }}</td>
                        @if (auth()->user()->isCitizent() || auth()->user()->isSuperAdmin())
                            <td class="md:table-cell">{{ $item->sk->is_published ? 'Terkirim' : 'Belum dikirim' }}</td>
                        @endif
                        <td>
                            <div class="flex gap-2 items-center">

                                <a href="{{ route('letters.sk-grant.show', $item->id) }}"  class="icon-table icon-detail">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                                        <g clip-path="url(#clip0_7909_2017)">
                                            <path d="M0 7.78109C0.212656 6.95097 0.740438 6.29931 1.24125 5.6395C2.12616 4.47366 3.19309 3.50834 4.50056 2.82897C5.7475 2.18103 7.07422 1.89766 8.4775 1.98525C10.5819 2.11656 12.3039 3.05512 13.7758 4.51181C14.561 5.28887 15.2174 6.16656 15.7538 7.13109C15.8652 7.33144 15.9194 7.56362 16 7.78112C16 7.92697 16 8.07278 16 8.21862C15.8249 8.97666 15.3426 9.56675 14.9142 10.1839C14.7143 10.472 14.3293 10.5169 14.0539 10.3173C13.7778 10.1172 13.7147 9.75144 13.9047 9.45662C14.1583 9.06322 14.4121 8.66997 14.664 8.27553C14.7712 8.10766 14.7799 7.93334 14.6796 7.75862C13.9052 6.40959 12.9389 5.23069 11.6377 4.35347C10.4538 3.55537 9.14866 3.16141 7.71775 3.22531C6.30425 3.28844 5.05559 3.80041 3.94309 4.65969C2.85125 5.50303 2.00934 6.55978 1.32541 7.74953C1.23597 7.90512 1.21938 8.06566 1.30903 8.22512C2.15775 9.73437 3.23072 11.0487 4.76469 11.8967C7.13203 13.2055 9.46419 13.0716 11.7278 11.601C11.865 11.5118 12.0125 11.4158 12.168 11.3827C12.4535 11.3219 12.7262 11.4948 12.8329 11.7585C12.9426 12.0291 12.8587 12.3243 12.6085 12.5059C11.8959 13.023 11.1268 13.4367 10.2803 13.683C7.68197 14.4388 5.30903 13.9606 3.16566 12.3297C1.92459 11.3854 0.971719 10.1891 0.22 8.83041C0.116406 8.64316 0.071875 8.42331 0 8.21859C0 8.07275 0 7.92694 0 7.78109Z" fill="#547DE2" fill-opacity="0.72"/>
                                            <path d="M8.0061 4.3125C10.036 4.31416 11.6898 5.97288 11.6872 8.00463C11.6847 10.0346 10.0251 11.6891 7.99442 11.6862C5.96438 11.6833 4.31129 10.0247 4.31348 7.99294C4.31567 5.96275 5.97304 4.31084 8.0061 4.3125ZM5.56332 7.99266C5.56117 9.33472 6.65157 10.4327 7.99017 10.4363C9.33235 10.4399 10.4326 9.35031 10.4374 8.01275C10.4422 6.66231 9.35004 5.56328 8.00245 5.56247C6.66035 5.56169 5.56548 6.65253 5.56332 7.99266Z" fill="#547DE2" fill-opacity="0.72"/>
                                            <path d="M8.00165 9.24923C7.4749 9.24976 6.99381 8.90895 6.81996 8.41211C6.64699 7.91773 6.8044 7.3608 7.20984 7.03167C7.32752 6.93614 7.45071 6.86733 7.60934 6.93083C7.77293 6.99633 7.8179 7.12973 7.83421 7.29023C7.8854 7.7938 8.20712 8.11601 8.70849 8.16561C8.86902 8.18148 9.00259 8.22561 9.06846 8.38926C9.13227 8.54776 9.06418 8.67076 8.96859 8.78886C8.73612 9.07592 8.37409 9.24886 8.00165 9.24923Z" fill="#547DE2" fill-opacity="0.72"/>
                                        </g>
                                        <defs>
                                            <clipPath id="clip0_7909_2017">
                                                <rect width="16" height="16" fill="white"/>
                                            </clipPath>
                                        </defs>
                                    </svg>
                                </a>

                                @if ((auth()->user()->isCitizent() || auth()->user()->isSuperAdmin()) && $item->sk->is_published === 0)
                                    <a href="{{ route('letters.sk-grant.edit', $item->id) }}"
                                        class="icon-table icon-edit">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                viewBox="0 0 16 16" fill="none">
                                            <g clip-path="url(#clip0_7909_699)">
                                                <path d="M12.4832 3.14713e-05C13.6351 0.226594 14.382 1.03406 15.1085 1.85653C15.3459 2.12519 15.551 2.43603 15.7097 2.75772C16.1209 3.59122 15.9911 4.42919 15.3369 5.09194C14.3494 6.09231 13.3408 7.07191 12.3362 8.05525C12.0689 8.31694 11.703 8.292 11.4223 8.01156C10.4277 7.01794 9.43401 6.02347 8.43985 5.0295C8.40014 4.98978 8.35873 4.95175 8.34235 4.93606C6.54367 6.71916 4.75164 8.49563 2.95907 10.2727C3.8737 11.1799 4.78242 12.0812 5.70039 12.9918C5.86582 12.8257 6.04789 12.6433 6.22936 12.4604C7.27073 11.411 8.31279 10.3622 9.35223 9.31084C9.49814 9.16325 9.66107 9.06547 9.87292 9.07675C10.1294 9.09041 10.319 9.21669 10.4173 9.45244C10.5175 9.69272 10.4819 9.92513 10.301 10.1171C10.0699 10.3625 9.82904 10.5988 9.59154 10.8381C8.46604 11.9722 7.33957 13.1053 6.21545 14.2407C6.08451 14.3729 5.93957 14.4642 5.75698 14.5156C4.13704 14.9711 2.51848 15.4316 0.900699 15.8948C0.646324 15.9677 0.415543 15.9507 0.221637 15.7613C0.0231057 15.5674 0.000135634 15.333 0.0734169 15.0717C0.529354 13.4463 0.978012 11.8188 1.4382 10.1946C1.47723 10.0569 1.56001 9.91534 1.66092 9.81381C4.67426 6.78203 7.69354 3.75612 10.7085 0.726C11.0772 0.3555 11.5038 0.104094 12.0163 0C12.1719 3.125e-05 12.3276 3.14713e-05 12.4832 3.14713e-05ZM13.5843 5.107C13.874 4.81222 14.1675 4.51941 14.4543 4.22022C14.7278 3.93497 14.7644 3.61209 14.5825 3.26344C14.5442 3.19006 14.5065 3.11538 14.4592 3.04784C14.0237 2.42619 13.4967 1.89509 12.8694 1.46678C12.768 1.39753 12.6515 1.34772 12.5372 1.30041C12.2802 1.19394 12.0266 1.2215 11.8224 1.4045C11.4799 1.71153 11.1569 2.04025 10.8311 2.35453C11.752 3.27519 12.6572 4.18009 13.5843 5.107ZM9.22445 4.00441C10.1268 4.90709 11.0265 5.80713 11.9329 6.71375C12.1629 6.47237 12.4044 6.21888 12.6245 5.98794C11.7315 5.09313 10.8292 4.18897 9.93979 3.29775C9.70532 3.52938 9.45904 3.77266 9.22445 4.00441ZM2.35967 11.5041C2.20914 12.044 2.05298 12.5966 1.90482 13.1512C1.89401 13.1917 1.92942 13.2591 1.96351 13.2945C2.19004 13.5298 2.42489 13.7572 2.6507 13.9932C2.71851 14.0641 2.77826 14.0712 2.86882 14.0441C3.26051 13.9267 3.65479 13.818 4.04804 13.706C4.18486 13.667 4.32148 13.6273 4.46032 13.5874C3.75436 12.8873 3.06048 12.1991 2.35967 11.5041Z"
                                                        fill="#F6C46A" fill-opacity="0.72"/>
                                                <path d="M11.5333 15.9099C10.289 15.9098 9.04465 15.9112 7.8003 15.9091C7.38093 15.9084 7.10055 15.5938 7.15493 15.195C7.19352 14.9118 7.42905 14.6936 7.72515 14.6682C7.76636 14.6647 7.80805 14.6663 7.84952 14.6663C10.3123 14.6663 12.7751 14.6669 15.2378 14.665C15.4446 14.6649 15.6311 14.7096 15.7719 14.8673C15.9461 15.0623 15.9916 15.289 15.8873 15.5314C15.7835 15.7726 15.5918 15.9046 15.3286 15.9074C14.7998 15.9131 14.2709 15.9098 13.7421 15.9099C13.0058 15.9101 12.2696 15.9099 11.5333 15.9099Z"
                                                        fill="#F6C46A" fill-opacity="0.72"/>
                                            </g>
                                            <defs>
                                                <clipPath id="clip0_7909_699">
                                                    <rect width="16" height="16" fill="white"/>
                                                </clipPath>
                                            </defs>
                                        </svg>
                                    </a>
                                    @if(auth()->user()->isCitizent() || auth()->user()->isSuperAdmin())
                                    <button type="button"  class="icon-table icon-delete delete-letter-data" data-bs-toggle="modal" data-bs-target="#deleteSkGrantModal">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                                            <path d="M9.2823 0C9.52783 0.0933731 9.79325 0.153622 10.0151 0.286536C10.6124 0.644362 10.915 1.1916 10.9386 1.88896C10.9437 2.03946 10.9394 2.19029 10.9394 2.36458C11.0096 2.36458 11.0701 2.36458 11.1306 2.36458C11.917 2.36466 12.7035 2.36124 13.4898 2.36628C13.9256 2.36908 14.2124 2.71069 14.129 3.11577C14.0862 3.32377 13.9657 3.48047 13.7686 3.55484C13.6578 3.59668 13.6374 3.65522 13.6375 3.76071C13.6401 5.92184 13.6398 8.08292 13.6385 10.244C13.6384 10.3476 13.6384 10.4549 13.6131 10.5539C13.5401 10.8393 13.2655 11.0217 12.961 11.0012C12.6809 10.9824 12.4431 10.7622 12.4025 10.4781C12.3908 10.3961 12.3899 10.3121 12.3899 10.229C12.3892 8.09908 12.3894 5.96925 12.3894 3.83938C12.3894 3.77251 12.3894 3.70563 12.3894 3.62672C9.46321 3.62672 6.55006 3.62672 3.62041 3.62672C3.61775 3.6823 3.61283 3.73738 3.61283 3.79251C3.61246 6.99511 3.61196 10.1977 3.61287 13.4003C3.61312 14.2366 4.13115 14.7496 4.97068 14.7497C7.01226 14.7498 9.05384 14.7506 11.0954 14.7492C11.7315 14.7488 12.232 14.3552 12.3617 13.7555C12.3835 13.6544 12.3829 13.5486 12.3959 13.4455C12.4395 13.1028 12.7207 12.8595 13.0476 12.8802C13.3947 12.9021 13.6404 13.1774 13.6374 13.5409C13.6282 14.6329 12.8748 15.6118 11.8157 15.905C11.6812 15.9422 11.5437 15.9684 11.4075 15.9998C9.13647 15.9998 6.86543 15.9998 4.59435 15.9998C4.56506 15.9905 4.53635 15.9772 4.50631 15.9726C3.84216 15.8726 3.30246 15.5568 2.88851 15.0303C2.51335 14.5531 2.35969 14.0053 2.36044 13.4009C2.36456 10.2032 2.36182 7.00548 2.36427 3.80776C2.36436 3.67913 2.35277 3.5918 2.20603 3.53905C2.0257 3.47426 1.91812 3.32014 1.87508 3.13144C1.78145 2.72128 2.06986 2.36924 2.51165 2.36633C3.29813 2.36116 4.08461 2.3647 4.87114 2.36462C4.93168 2.36462 4.99222 2.36462 5.04659 2.36462C5.05526 2.33099 5.06005 2.32091 5.06013 2.31083C5.06118 2.18062 5.05988 2.05042 5.06234 1.92025C5.07588 1.20239 5.38538 0.644279 6.00041 0.278953C6.21844 0.149456 6.47865 0.0909568 6.7196 4.19608e-05C7.57379 2.94995e-07 8.42802 0 9.2823 0ZM6.31486 2.35379C7.44779 2.35379 8.5634 2.35379 9.68571 2.35379C9.68571 2.172 9.69871 1.99967 9.68287 1.83C9.65358 1.51597 9.38201 1.25743 9.06414 1.25368C8.35669 1.24531 7.64904 1.24556 6.9416 1.25343C6.61694 1.25702 6.34207 1.52222 6.31715 1.84125C6.30423 2.00633 6.31486 2.17325 6.31486 2.35379Z" fill="#D55051" fill-opacity="0.72"/>
                                            <path d="M7.3761 9.17002C7.3761 8.3005 7.37476 7.43097 7.37685 6.56145C7.37755 6.27766 7.53772 6.05392 7.79371 5.9625C8.03533 5.87626 8.32008 5.93796 8.46907 6.148C8.55141 6.26408 8.61861 6.42116 8.61941 6.5602C8.62936 8.30437 8.62703 10.0487 8.62507 11.7929C8.62465 12.1615 8.35316 12.436 8.0015 12.4364C7.65042 12.4368 7.37793 12.1613 7.37685 11.7943C7.37435 10.9195 7.37605 10.0448 7.3761 9.17002Z" fill="#D55051" fill-opacity="0.72"/>
                                            <path d="M11.014 9.18057C11.014 10.0396 11.0154 10.8986 11.0133 11.7576C11.0124 12.1034 10.8463 12.3327 10.5484 12.4141C10.1983 12.5097 9.83702 12.2799 9.77848 11.9224C9.76843 11.8611 9.7646 11.7981 9.76456 11.7359C9.76385 10.0335 9.7646 8.33109 9.76318 6.62871C9.76302 6.42209 9.80714 6.23455 9.96685 6.09247C10.1646 5.91656 10.3947 5.87756 10.6353 5.97881C10.8779 6.08085 11.0082 6.27672 11.0111 6.54109C11.0167 7.04599 11.0137 7.55103 11.014 8.05601C11.0142 8.43088 11.0141 8.80571 11.014 9.18057Z" fill="#D55051" fill-opacity="0.72"/>
                                            <path d="M4.9876 9.1711C4.98776 8.30691 4.98368 7.44268 4.98935 6.57849C4.99247 6.10283 5.42704 5.79971 5.84645 5.97321C6.05903 6.06117 6.18816 6.2227 6.22432 6.45224C6.23399 6.51362 6.23699 6.57657 6.23699 6.63882C6.23766 8.33599 6.23803 10.0332 6.23711 11.7303C6.2369 12.103 6.06582 12.3424 5.75125 12.4201C5.40238 12.5064 5.0391 12.2609 4.99801 11.9036C4.98322 11.775 4.98797 11.6438 4.98785 11.5138C4.98705 10.7329 4.98743 9.952 4.9876 9.1711Z" fill="#D55051" fill-opacity="0.72"/>
                                        </svg>
                                    </button>
                                    @endif
                                @endif
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td class="text-center" colspan="6">Data tidak ditemukan</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <x-modal-delete-letter>
        <x-slot name="name">surat keterangan hibah samsat</x-slot>
        <x-slot name="modalId">SkGrant</x-slot>
    </x-modal-delete-letter>
@endsection

@push('js')
    <script src="{{ asset('assets/js/custom/letters/sk-grant.js') }}"></script>
@endpush

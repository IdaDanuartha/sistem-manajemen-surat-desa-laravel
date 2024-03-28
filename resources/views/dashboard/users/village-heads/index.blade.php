@extends('layouts.main')
@section('title', 'Halaman Pengguna')

@section('main')
    <div class="table-wrapper mt-[20px]">
        <div class="flex justify-between items-center gap-3">
            <div class="input-wrapper flex gap-2 items-center">
                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 12 12" fill="none">
                    <path
                        d="M9.75 4.875C9.75 5.95078 9.40078 6.94453 8.8125 7.75078L11.7797 10.7203C12.0727 11.0133 12.0727 11.4891 11.7797 11.782C11.4867 12.075 11.0109 12.075 10.718 11.782L7.75078 8.8125C6.94453 9.40312 5.95078 9.75 4.875 9.75C2.18203 9.75 0 7.56797 0 4.875C0 2.18203 2.18203 0 4.875 0C7.56797 0 9.75 2.18203 9.75 4.875ZM4.875 8.25C5.31821 8.25 5.75708 8.1627 6.16656 7.99309C6.57603 7.82348 6.94809 7.57488 7.26149 7.26149C7.57488 6.94809 7.82348 6.57603 7.99309 6.16656C8.1627 5.75708 8.25 5.31821 8.25 4.875C8.25 4.43179 8.1627 3.99292 7.99309 3.58344C7.82348 3.17397 7.57488 2.80191 7.26149 2.48851C6.94809 2.17512 6.57603 1.92652 6.16656 1.75691C5.75708 1.5873 5.31821 1.5 4.875 1.5C4.43179 1.5 3.99292 1.5873 3.58344 1.75691C3.17397 1.92652 2.80191 2.17512 2.48851 2.48851C2.17512 2.80191 1.92652 3.17397 1.75691 3.58344C1.5873 3.99292 1.5 4.43179 1.5 4.875C1.5 5.31821 1.5873 5.75708 1.75691 6.16656C1.92652 6.57603 2.17512 6.94809 2.48851 7.26149C2.80191 7.57488 3.17397 7.82348 3.58344 7.99309C3.99292 8.1627 4.43179 8.25 4.875 8.25Z"
                        fill="#282421" fill-opacity="0.52" />
                </svg>
                <input type="search" class="searchInputTable w-full focus:ring-0 focus:outline-none"
                    placeholder="Cari data lurah ...">
            </div>
            @if ($users->count() == 0)
                <div class="flex">
                    <a href="{{ route('village-heads.create') }}"
                        class="flex button btn-main duration-200 capitalize w-max items-center gap-1" type="button">
                        Tambah
                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 12 12"
                            fill="none">
                            <g clip-path="url(#clip0_7909_670)">
                                <path
                                    d="M5.59868 11.9841C5.51903 11.9548 5.43528 11.9331 5.36022 11.8945C5.09928 11.7602 4.94839 11.5457 4.91571 11.2524C4.9083 11.1868 4.90779 11.1201 4.90779 11.0542C4.90728 9.78863 4.90754 8.52301 4.90754 7.25714C4.90754 7.20735 4.90754 7.15756 4.90754 7.09041C4.84728 7.09041 4.79826 7.09041 4.74924 7.09041C3.46422 7.09041 2.17945 7.09093 0.894429 7.09016C0.474685 7.08991 0.16728 6.87901 0.0531524 6.51697C0.0449822 6.49118 0.034259 6.46437 0.034259 6.43782C0.0329824 6.14675 0.00591727 5.85237 0.040896 5.56565C0.0840449 5.2128 0.391705 4.95697 0.744811 4.92199C0.806598 4.91586 0.869151 4.91459 0.931449 4.91459C2.2009 4.91407 3.47009 4.91433 4.73954 4.91433C4.78932 4.91433 4.83937 4.91433 4.90754 4.91433C4.90754 4.8551 4.90754 4.80633 4.90754 4.75731C4.90754 3.47229 4.90856 2.18701 4.90677 0.901989C4.90626 0.542755 5.04592 0.267776 5.37145 0.10284C5.60966 -0.0176703 6.38098 -0.0189474 6.61894 0.100797C6.88422 0.234585 7.04124 0.450074 7.07519 0.748542C7.0826 0.814159 7.08362 0.880542 7.08362 0.94667C7.08413 2.21229 7.08388 3.4779 7.08388 4.74378C7.08388 4.79382 7.08388 4.84412 7.08388 4.91433C7.14107 4.91433 7.18983 4.91433 7.23834 4.91433C8.4843 4.91433 9.73051 4.92429 10.9762 4.90948C11.4657 4.90361 11.8394 5.07441 11.9766 5.60522C11.9766 5.86999 11.9766 6.13475 11.9766 6.39978C11.8384 6.93441 11.46 7.10088 10.9765 7.09552C9.73103 7.08122 8.48558 7.09067 7.24013 7.09067C7.19136 7.09067 7.1426 7.09067 7.08388 7.09067C7.08388 7.15961 7.08388 7.20939 7.08388 7.25944C7.08388 8.53629 7.0826 9.81314 7.0849 11.09C7.08541 11.3422 7.02158 11.5654 6.84081 11.7487C6.71596 11.8754 6.55741 11.9348 6.39298 11.9844C6.12847 11.9841 5.86371 11.9841 5.59868 11.9841Z"
                                    fill="white" />
                            </g>
                            <defs>
                                <clipPath id="clip0_7909_670">
                                    <rect width="12" height="12" fill="white" />
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
                        <th>NIP</th>
                        <th class="md:table-cell">Nama</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $item)
                        <tr class="table-body">
                            <input type="hidden" class="user_id" value="{{ $item->id }}">
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->employee_number }}</td>
                            <td class="md:table-cell">{{ $item->name }}</td>
                            <td>
                                <div class="flex gap-2 items-center">

                                    <a href="{{ route('village-heads.show', $item->id) }}"
                                        class="icon-table icon-detail">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            viewBox="0 0 16 16" fill="none">
                                            <g clip-path="url(#clip0_7909_2017)">
                                                <path
                                                    d="M0 7.78109C0.212656 6.95097 0.740438 6.29931 1.24125 5.6395C2.12616 4.47366 3.19309 3.50834 4.50056 2.82897C5.7475 2.18103 7.07422 1.89766 8.4775 1.98525C10.5819 2.11656 12.3039 3.05512 13.7758 4.51181C14.561 5.28887 15.2174 6.16656 15.7538 7.13109C15.8652 7.33144 15.9194 7.56362 16 7.78112C16 7.92697 16 8.07278 16 8.21862C15.8249 8.97666 15.3426 9.56675 14.9142 10.1839C14.7143 10.472 14.3293 10.5169 14.0539 10.3173C13.7778 10.1172 13.7147 9.75144 13.9047 9.45662C14.1583 9.06322 14.4121 8.66997 14.664 8.27553C14.7712 8.10766 14.7799 7.93334 14.6796 7.75862C13.9052 6.40959 12.9389 5.23069 11.6377 4.35347C10.4538 3.55537 9.14866 3.16141 7.71775 3.22531C6.30425 3.28844 5.05559 3.80041 3.94309 4.65969C2.85125 5.50303 2.00934 6.55978 1.32541 7.74953C1.23597 7.90512 1.21938 8.06566 1.30903 8.22512C2.15775 9.73437 3.23072 11.0487 4.76469 11.8967C7.13203 13.2055 9.46419 13.0716 11.7278 11.601C11.865 11.5118 12.0125 11.4158 12.168 11.3827C12.4535 11.3219 12.7262 11.4948 12.8329 11.7585C12.9426 12.0291 12.8587 12.3243 12.6085 12.5059C11.8959 13.023 11.1268 13.4367 10.2803 13.683C7.68197 14.4388 5.30903 13.9606 3.16566 12.3297C1.92459 11.3854 0.971719 10.1891 0.22 8.83041C0.116406 8.64316 0.071875 8.42331 0 8.21859C0 8.07275 0 7.92694 0 7.78109Z"
                                                    fill="#547DE2" fill-opacity="0.72" />
                                                <path
                                                    d="M8.0061 4.3125C10.036 4.31416 11.6898 5.97288 11.6872 8.00463C11.6847 10.0346 10.0251 11.6891 7.99442 11.6862C5.96438 11.6833 4.31129 10.0247 4.31348 7.99294C4.31567 5.96275 5.97304 4.31084 8.0061 4.3125ZM5.56332 7.99266C5.56117 9.33472 6.65157 10.4327 7.99017 10.4363C9.33235 10.4399 10.4326 9.35031 10.4374 8.01275C10.4422 6.66231 9.35004 5.56328 8.00245 5.56247C6.66035 5.56169 5.56548 6.65253 5.56332 7.99266Z"
                                                    fill="#547DE2" fill-opacity="0.72" />
                                                <path
                                                    d="M8.00165 9.24923C7.4749 9.24976 6.99381 8.90895 6.81996 8.41211C6.64699 7.91773 6.8044 7.3608 7.20984 7.03167C7.32752 6.93614 7.45071 6.86733 7.60934 6.93083C7.77293 6.99633 7.8179 7.12973 7.83421 7.29023C7.8854 7.7938 8.20712 8.11601 8.70849 8.16561C8.86902 8.18148 9.00259 8.22561 9.06846 8.38926C9.13227 8.54776 9.06418 8.67076 8.96859 8.78886C8.73612 9.07592 8.37409 9.24886 8.00165 9.24923Z"
                                                    fill="#547DE2" fill-opacity="0.72" />
                                            </g>
                                            <defs>
                                                <clipPath id="clip0_7909_2017">
                                                    <rect width="16" height="16" fill="white" />
                                                </clipPath>
                                            </defs>
                                        </svg>
                                    </a>

                                    <a href="{{ route('village-heads.edit', $item->id) }}"
                                        class="icon-table icon-edit">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            viewBox="0 0 16 16" fill="none">
                                            <g clip-path="url(#clip0_7909_699)">
                                                <path
                                                    d="M12.4832 3.14713e-05C13.6351 0.226594 14.382 1.03406 15.1085 1.85653C15.3459 2.12519 15.551 2.43603 15.7097 2.75772C16.1209 3.59122 15.9911 4.42919 15.3369 5.09194C14.3494 6.09231 13.3408 7.07191 12.3362 8.05525C12.0689 8.31694 11.703 8.292 11.4223 8.01156C10.4277 7.01794 9.43401 6.02347 8.43985 5.0295C8.40014 4.98978 8.35873 4.95175 8.34235 4.93606C6.54367 6.71916 4.75164 8.49563 2.95907 10.2727C3.8737 11.1799 4.78242 12.0812 5.70039 12.9918C5.86582 12.8257 6.04789 12.6433 6.22936 12.4604C7.27073 11.411 8.31279 10.3622 9.35223 9.31084C9.49814 9.16325 9.66107 9.06547 9.87292 9.07675C10.1294 9.09041 10.319 9.21669 10.4173 9.45244C10.5175 9.69272 10.4819 9.92513 10.301 10.1171C10.0699 10.3625 9.82904 10.5988 9.59154 10.8381C8.46604 11.9722 7.33957 13.1053 6.21545 14.2407C6.08451 14.3729 5.93957 14.4642 5.75698 14.5156C4.13704 14.9711 2.51848 15.4316 0.900699 15.8948C0.646324 15.9677 0.415543 15.9507 0.221637 15.7613C0.0231057 15.5674 0.000135634 15.333 0.0734169 15.0717C0.529354 13.4463 0.978012 11.8188 1.4382 10.1946C1.47723 10.0569 1.56001 9.91534 1.66092 9.81381C4.67426 6.78203 7.69354 3.75612 10.7085 0.726C11.0772 0.3555 11.5038 0.104094 12.0163 0C12.1719 3.125e-05 12.3276 3.14713e-05 12.4832 3.14713e-05ZM13.5843 5.107C13.874 4.81222 14.1675 4.51941 14.4543 4.22022C14.7278 3.93497 14.7644 3.61209 14.5825 3.26344C14.5442 3.19006 14.5065 3.11538 14.4592 3.04784C14.0237 2.42619 13.4967 1.89509 12.8694 1.46678C12.768 1.39753 12.6515 1.34772 12.5372 1.30041C12.2802 1.19394 12.0266 1.2215 11.8224 1.4045C11.4799 1.71153 11.1569 2.04025 10.8311 2.35453C11.752 3.27519 12.6572 4.18009 13.5843 5.107ZM9.22445 4.00441C10.1268 4.90709 11.0265 5.80713 11.9329 6.71375C12.1629 6.47237 12.4044 6.21888 12.6245 5.98794C11.7315 5.09313 10.8292 4.18897 9.93979 3.29775C9.70532 3.52938 9.45904 3.77266 9.22445 4.00441ZM2.35967 11.5041C2.20914 12.044 2.05298 12.5966 1.90482 13.1512C1.89401 13.1917 1.92942 13.2591 1.96351 13.2945C2.19004 13.5298 2.42489 13.7572 2.6507 13.9932C2.71851 14.0641 2.77826 14.0712 2.86882 14.0441C3.26051 13.9267 3.65479 13.818 4.04804 13.706C4.18486 13.667 4.32148 13.6273 4.46032 13.5874C3.75436 12.8873 3.06048 12.1991 2.35967 11.5041Z"
                                                    fill="#F6C46A" fill-opacity="0.72" />
                                                <path
                                                    d="M11.5333 15.9099C10.289 15.9098 9.04465 15.9112 7.8003 15.9091C7.38093 15.9084 7.10055 15.5938 7.15493 15.195C7.19352 14.9118 7.42905 14.6936 7.72515 14.6682C7.76636 14.6647 7.80805 14.6663 7.84952 14.6663C10.3123 14.6663 12.7751 14.6669 15.2378 14.665C15.4446 14.6649 15.6311 14.7096 15.7719 14.8673C15.9461 15.0623 15.9916 15.289 15.8873 15.5314C15.7835 15.7726 15.5918 15.9046 15.3286 15.9074C14.7998 15.9131 14.2709 15.9098 13.7421 15.9099C13.0058 15.9101 12.2696 15.9099 11.5333 15.9099Z"
                                                    fill="#F6C46A" fill-opacity="0.72" />
                                            </g>
                                            <defs>
                                                <clipPath id="clip0_7909_699">
                                                    <rect width="16" height="16" fill="white" />
                                                </clipPath>
                                            </defs>
                                        </svg>
                                    </a>
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
@endsection

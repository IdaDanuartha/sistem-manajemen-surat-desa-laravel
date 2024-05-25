<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <style>
        .center-text {
            position: relative;
            top: 0;
            left: 50%;
            transform: translateX(-50%);
        }

        table td {
            width: 100%;
            font-size: 0.913rem !important;
            line-height: 130%;
        }

        p {
            font-size: 0.913rem !important;
            line-height: 130%;
        }
    </style>
</head>

<body>
    <main style="width: 100%; height: 100%; position: relative;">
        <div class="wrapper-header" style="width: 100%; position: relative;">
            <img src="{{ public_path('assets/img/letter-header.png') }}" alt="Banner Top" class="image-full"
                style="border-bottom: 3px solid black; width: 100%;">
            <h1 class="center-text"
                style="text-transform: uppercase; font-size: 1.2rem; border-bottom: 2px solid black; width: 51%; margin-top: 24px;">
                Surat Keterangan Tidak Mampu</h1>
            <p style="text-align: center !important; margin-top: 16px;">Nomor: {{ $letter->sk->reference_number }}</p>
            <table style="width: 100%; margin-top: 20px;">
                <tr>
                    <td colspan="3" style="padding-bottom: 8px !important; text-indent: 42px;">Yang bertanda tangan
                        di bawah ini,
                        Lurah
                        Subagan, Kecamatan Karangasem, Kabupaten Karangasem,
                        Propinsi Bali, menerangkan dengan sebenarnya bahwa :</td>
                </tr>
                @if ($letter->sktm_type->value == 4 || $letter->sktm_type->value == 5)
                    <tr>
                        <td style="width: 140px;">Nama</td>
                        <td style="width: 12px;">:</td>
                        <td>{{ $letter->sk->citizent->name }}</td>
                    </tr>
                    <tr>
                        <td style="width: 140px;">Tempat Tanggal Lahir</td>
                        <td style="width: 12px;">:</td>
                        <td>{{ $letter->sk->citizent->birth_place . ', ' . $letter->sk->citizent->birth_date->format('d-m-Y') }}
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 140px;">Pekerjaan</td>
                        <td style="width: 12px;">:</td>
                        <td>{{ $letter->sk->citizent->work }}</td>
                    </tr>
                    <tr>
                        <td style="width: 140px;">Agama</td>
                        <td style="width: 12px;">:</td>
                        <td>{{ $letter->sk->citizent->religion->label() }}</td>
                    </tr>
                    <tr>
                        <td style="width: 140px;">Alamat</td>
                        <td style="width: 12px;">:</td>
                        <td>{{ $letter->sk->citizent->address }}.</td>
                    </tr>
                @else
                    <tr>
                        <td style="width: 140px;">Nama</td>
                        <td style="width: 12px;">:</td>
                        <td>{{ $letter->sk->citizent->name }}</td>
                    </tr>
                    <tr>
                        <td style="width: 140px;">Tempat Tanggal Lahir</td>
                        <td style="width: 12px;">:</td>
                        <td>{{ $letter->sk->citizent->birth_place . ', ' . $letter->sk->citizent->birth_date->format('d-m-Y') }}
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 140px;">Jenis Kelamin</td>
                        <td style="width: 12px;">:</td>
                        <td>{{ $letter->sk->citizent->gender->label() }}</td>
                    </tr>
                    <tr>
                        <td style="width: 140px;">Agama</td>
                        <td style="width: 12px;">:</td>
                        <td>{{ $letter->sk->citizent->religion->label() }}</td>
                    </tr>
                    <tr>
                        <td style="width: 140px;">Pekerjaan</td>
                        <td style="width: 12px;">:</td>
                        <td>{{ $letter->sk->citizent->work }}</td>
                    </tr>
                    <tr>
                        <td style="width: 140px;">No. KK/ KTP</td>
                        <td style="width: 12px;">:</td>
                        <td>{{ $letter->sk->citizent->national_identify_number }}</td>
                    </tr>
                    <tr>
                        <td style="width: 140px;">Alamat</td>
                        <td style="width: 12px;">:</td>
                        <td>{{ $letter->sk->citizent->address }}</td>
                    </tr>
                @endif
            </table>
            <table style="width: 100%; margin-top: 32px;">
                <tr>
                    @if ($letter->sktm_type->value === 1)
                        <td colspan="3" style="padding-bottom: 8px !important; text-indent: 42px;">Berdasarkan surat
                            pengantar Kepala
                            Lingkungan
                            {{ $letter->sk->citizent->environmental->name }}, No:
                            {{ $letter->sk->cover_letter_number }}, tanggal
                            {{ $letter->sk->created_at->format('d M Y') }}, Sepanjang pengetahuan kami memang benar
                            orang
                            tersebut di
                            atas tidak mampu untuk membayar proses sidang perceraian.</td>
                    @elseif ($letter->sktm_type->value === 2)
                        <td colspan="3" style="padding-bottom: 8px !important; text-indent: 42px;">Berdasarkan Surat
                            Pengantar dari
                            Kepala Lingkungan
                            {{ $letter->sk->citizent->environmental->name }}, No.
                            {{ $letter->sk->cover_letter_number }}, tanggal
                            {{ $letter->sk->created_at->format('d M Y') }}, memang benar orang tersebut diatas kurang
                            mampu, untuk Membiayai
                            Sekolah Anaknya, Atas Nama: </td>
                    @elseif ($letter->sktm_type->value === 3)
                        <td colspan="3" style="padding-bottom: 8px !important; text-indent: 42px;">Berdasarkan surat
                            pengantar Kepala
                            Lingkungan
                            {{ $letter->sk->citizent->environmental->name }}, No:
                            {{ $letter->sk->cover_letter_number }}, tanggal
                            {{ $letter->sk->created_at->format('d M Y') }}, sepanjang pengetahuan kami memang benar
                            orang
                            tersebut di atas
                            Kurang Mampu dan Memohon Bantuan Bedah Rumah.</td>
                    @elseif ($letter->sktm_type->value === 4)
                        <td colspan="3" style="padding-bottom: 8px !important; text-indent: 42px;">Berdasarkan surat
                            pengantar Kepala
                            Lingkungan
                            {{ $letter->sk->citizent->environmental->name }} No :
                            {{ $letter->sk->cover_letter_number }}, tanggal
                            {{ $letter->sk->created_at->format('d M Y') }}
                            menyatakan dengan sebenarnya bahwa memang benar orang tersebut
                            diatas Tidak mampu/miskin dan Disabilitas</td>
                    @elseif ($letter->sktm_type->value === 5)
                        <td colspan="3" style="padding-bottom: 8px !important; text-indent: 42px;">Berdasarkan surat
                            pengantar Kepala
                            Lingkungan
                            {{ $letter->sk->citizent->environmental->name }} No :
                            {{ $letter->sk->cover_letter_number }}, tanggal
                            {{ $letter->sk->created_at->format('d M Y') }}
                            menyatakan dengan sebenarnya bahwa memang benar orang tersebut
                            diatas Tidak mampu / Miskin.</td>
                    @else
                        <td colspan="3" style="padding-bottom: 8px !important; text-indent: 42px;">Berdasarkan Surat
                            Pengantar dari
                            Kepala Lingkungan
                            {{ $letter->sk->citizent->environmental->name }}, No:
                            {{ $letter->sk->cover_letter_number }}, tanggal
                            {{ $letter->sk->created_at->format('d M Y') }}
                            ,menyatakan bahwa memang benar orang tersebut diatas kurang mampu
                            / miskin dan lansia .</td>
                    @endif
                </tr>
                @if ($letter->sktm_type->value === 2)
                    <tr>
                        <td style="width: 140px;">Nama</td>
                        <td style="width: 12px;">:</td>
                        <td>{{ $letter->sktmSchool->citizent->name }}</td>
                    </tr>
                    <tr>
                        <td style="width: 140px;">Tempat Tanggal Lahir</td>
                        <td style="width: 12px;">:</td>
                        <td>{{ $letter->sktmSchool->citizent->birth_place . ', ' . $letter->sktmSchool->citizent->birth_date->format('d-m-Y') }}
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 140px;">Jenis Kelamin</td>
                        <td style="width: 12px;">:</td>
                        <td>{{ $letter->sktmSchool->citizent->gender->label() }}</td>
                    </tr>
                    <tr>
                        <td style="width: 140px;">Sekolah</td>
                        <td style="width: 12px;">:</td>
                        <td>{{ $letter->sktmSchool->school_name }}</td>
                    </tr>
                @endif
            </table>
            <p style="margin-top: 24px; text-indent: 42px;">Demikian surat keterangan ini dibuat dengan sebenarnya untuk
                dapat
                dipergunakan
                {{ $letter->purpose === '-' ? 'sebagai mana mestinya' : 'sebagai ' . $letter->purpose }}.
            </p>
        </div>
        <div class="wrapper-footer" style="margin-top: 14px;">
            <table style="width: 100%;">
                <tr>
                    <td style="width: 100%;"></td>
                    <td style="width: 100%;"></td>
                    <td style="width: 100%;">
                        <p style="font-size: 0.875rem !important; text-align: center !important;">Subagan,
                            {{ ($letter->sk->sectionHead || $letter->sk->villageHead) && ($letter->sk->status_by_section_head === 1 || $letter->sk->status_by_village_head === 1) ? $letter->sk->updated_at->format('d M Y') : '..........' }}
                            <br> A.n, Lurah Subagan
                        </p>
                        @if (isset($letter->sk->sectionHead))
                            @if ($letter->sk->status_by_section_head === 1 && isset($letter->sk->sectionHead->user->signature_image))
                                <img src="{{ public_path('uploads/users/signatures/' . $letter->sk->sectionHead->user->signature_image) }}"
                                    style="width: 100%; height: 100px; object-fit: cover;">
                                <p style="font-size: 0.875rem !important; text-align: center !important;">
                                    {{ $letter->sk->sectionHead->name }} <br> NIP :
                                    {{ $letter->sk->sectionHead->employee_number }}
                                </p>
                            @else
                                <div class="wrapper-image" style="width: 100%; height: 100px;"></div>
                            @endif
                        @else
                            @if (isset($letter->sk->villageHead))
                                @if ($letter->sk->status_by_village_head === 1 && isset($letter->sk->villageHead->user->signature_image))
                                    <img src="{{ public_path('uploads/users/signatures/' . $letter->sk->villageHead->user->signature_image) }}"
                                        style="width: 100%; height: 100px; object-fit: cover;">
                                    <p style="font-size: 0.875rem !important; text-align: center !important;">
                                        {{ $letter->sk->villageHead->name }} <br> NIP :
                                        {{ $letter->sk->villageHead->employee_number }}
                                    </p>
                                @else
                                    <div class="wrapper-image" style="width: 100%; height: 100px;"></div>
                                @endif
                            @else
                                <div class="wrapper-image" style="width: 100%; height: 100px;"></div>
                            @endif
                        @endif
                        <p style="font-size: 0.875rem !important; text-align: center !important;">
                            {{ $letter->sk->sectionHead ? $letter->sk->sectionHead->position : '' }}
                        </p>
                    </td>
                </tr>
            </table>
        </div>
    </main>
</body>

</html>

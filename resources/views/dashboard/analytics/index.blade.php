@extends('layouts.main')
@section('title') Halaman Dashboard @endsection

@section('main')
<div class="py-14 pt-2">	
	<div class="card-dashboard-wrapper grid lg:grid-cols-4 md:grid-cols-2 grid-cols-1 gap-8">
		<div class="card-dashboard md:border-r border-r-0">
			<div class="icon-dashboard-wrapper">
				<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
					<g clip-path="url(#clip0_7909_16172)">
						<path d="M8.35162 0.50003C8.59959 0.547315 8.85075 0.582031 9.09503 0.643848C10.84 1.08556 12.1474 2.62212 12.3129 4.41743C12.5153 6.61443 11.0869 8.58556 8.9278 9.06731C8.61151 9.13789 8.28005 9.16291 7.955 9.16763C6.70578 9.18576 5.48563 9.35489 4.3168 9.81541C3.65469 10.0763 3.03365 10.4111 2.49275 10.8791C1.95295 11.3462 1.68272 11.9427 1.67281 12.6554C1.66792 13.0068 1.6705 13.3584 1.67234 13.7099C1.67428 14.0792 1.91908 14.3274 2.28705 14.3275C6.09529 14.3284 9.90351 14.3284 13.7117 14.3275C14.0798 14.3275 14.3291 14.0796 14.3268 13.711C14.324 13.2525 14.3378 12.7917 14.2965 12.3363C14.2446 11.7649 13.9694 11.2897 13.5413 10.9082C13.104 10.5185 12.6038 10.2271 12.0727 9.98472C11.7661 9.8448 11.6319 9.56325 11.72 9.2682C11.8132 8.95616 12.1494 8.75486 12.4474 8.88148C13.3871 9.28083 14.2497 9.79733 14.8631 10.6448C15.2071 11.1201 15.4036 11.6569 15.4735 12.2398C15.4774 12.2724 15.4909 12.3039 15.5 12.3359C15.5 12.8828 15.5 13.4297 15.5 13.9766C15.4897 14.0078 15.4768 14.0384 15.4696 14.0703C15.3223 14.7236 14.9372 15.1707 14.3091 15.4044C14.2013 15.4445 14.0876 15.4685 13.9766 15.5C9.99219 15.5 6.00781 15.5 2.02344 15.5C1.99221 15.4897 1.96159 15.4766 1.92966 15.4697C1.41298 15.3583 1.00408 15.0857 0.74583 14.6239C0.634355 14.4247 0.580186 14.1933 0.5 13.9766C0.5 13.4297 0.5 12.8828 0.5 12.3359C0.508525 12.3086 0.521562 12.2819 0.524961 12.254C0.640068 11.314 1.06578 10.543 1.79018 9.93696C2.59136 9.26668 3.50937 8.81422 4.50049 8.50288C4.77254 8.41742 5.0496 8.3479 5.32484 8.27094C5.31992 8.25494 5.31978 8.24366 5.31409 8.23804C5.29678 8.22096 5.27727 8.20616 5.25875 8.19028C4.09473 7.19331 3.55821 5.93264 3.68996 4.40272C3.83932 2.66826 5.1144 1.14034 6.7925 0.676221C7.07261 0.59876 7.36285 0.557832 7.64841 0.5C7.88287 0.500029 8.11725 0.50003 8.35162 0.50003ZM11.164 4.84124C11.1666 3.10165 9.75368 1.67908 8.01644 1.67208C6.26941 1.66505 4.8415 3.07974 4.83614 4.82296C4.83075 6.56926 6.2472 7.99566 7.99083 7.99991C9.73613 8.00413 11.1614 6.5854 11.164 4.84124Z" fill="#282421" fill-opacity="0.52"/>
					</g>
					<defs>
						<clipPath id="clip0_7909_16172">
							<rect width="15" height="15" fill="white" transform="translate(0.5 0.5)"/>
						</clipPath>
					</defs>
				</svg>
			</div>
			<p class="mt-[16px] mb-0 uppercase text-sm font-medium desc">Total Warga</p>
			<h1 class="m-0 text-3xl font-semibold text-second">{{ $total_citizents }}</h1>
		</div>
		<div class="card-dashboard lg:border-r border-r-0">
			<div class="icon-dashboard-wrapper">
				<svg xmlns="http://www.w3.org/2000/svg" width="17" height="16" viewBox="0 0 17 16" fill="none">
					<path d="M8.73355 0.506836C8.90097 0.554055 9.07346 0.588397 9.23502 0.650836C10.1486 1.00479 10.659 1.98625 10.4331 2.93962C10.4253 2.9724 10.4206 3.00635 10.41 3.06605C10.474 3.06605 10.5295 3.06566 10.5849 3.06605C11.1055 3.06996 11.628 3.05006 12.147 3.08245C13.2721 3.15269 14.1935 4.1002 14.2586 5.23074C14.2735 5.4883 14.2684 5.74742 14.2684 6.00576C14.2692 7.39581 14.2696 8.78586 14.2684 10.1755C14.268 10.5349 14.0932 10.7624 13.7798 10.821C13.4727 10.8783 13.1636 10.6625 13.114 10.3523C13.1019 10.2758 13.1008 10.197 13.1008 10.1189C13.1 8.57786 13.0992 7.03679 13.1012 5.49532C13.1016 5.21513 13.0524 4.9521 12.883 4.72225C12.6399 4.39249 12.3101 4.23601 11.9031 4.2364C9.63463 4.2364 7.36575 4.23445 5.09726 4.23757C4.37687 4.23874 3.89999 4.73669 3.89999 5.47971C3.89882 8.01084 3.8996 10.542 3.8996 13.0735C3.8996 13.1027 3.89921 13.132 3.90038 13.1613C3.92497 13.8419 4.41356 14.3195 5.09297 14.3207C6.36829 14.3226 7.64399 14.3215 8.91931 14.3215C9.89765 14.3215 10.8764 14.3219 11.8547 14.3215C12.5751 14.3211 13.0309 13.9035 13.0984 13.1835C13.1297 12.8495 13.3213 12.6263 13.6034 12.5942C13.9812 12.5513 14.2817 12.8233 14.2645 13.2116C14.2231 14.1513 13.7767 14.8401 12.9396 15.2584C12.7137 15.3712 12.4541 15.4165 12.2102 15.4926C9.73687 15.4926 7.26312 15.4926 4.78975 15.4926C4.76321 15.4832 4.73707 15.47 4.70975 15.4657C4.39756 15.4192 4.10487 15.3162 3.84068 15.1449C3.09999 14.6653 2.7316 13.98 2.73121 13.0965C2.73082 10.5513 2.73082 8.00654 2.7316 5.46137C2.7316 5.38332 2.73512 5.30527 2.7398 5.22762C2.8116 4.09708 3.72946 3.1523 4.85492 3.08206C5.37394 3.04966 5.8957 3.06957 6.41629 3.06567C6.47131 3.06528 6.52633 3.06567 6.58916 3.06567C6.57941 3.00947 6.57707 2.9802 6.56965 2.9525C6.3316 2.09396 6.78351 1.02313 7.7919 0.639129C7.94487 0.580983 8.10799 0.550153 8.26643 0.506836C8.42175 0.506836 8.57746 0.506836 8.73355 0.506836ZM8.48731 3.06605C8.59424 3.06605 8.70116 3.06605 8.80848 3.06605C9.19794 3.06605 9.19795 3.06606 9.29082 2.69064C9.39775 2.25864 9.14916 1.82586 8.72809 1.70957C8.28946 1.58859 7.84302 1.83523 7.70995 2.26371C7.63502 2.50449 7.7236 2.7242 7.77199 2.95054C7.78994 3.03445 7.82663 3.07191 7.91873 3.0684C8.10799 3.06098 8.29765 3.06605 8.48731 3.06605Z" fill="#282421" fill-opacity="0.52"/>
					<path d="M10.1035 9.4213C10.2166 9.51808 10.3282 9.60471 10.4293 9.70227C10.9913 10.2463 11.2875 10.9097 11.305 11.6937C11.3097 11.9032 11.3062 12.1132 11.3007 12.3228C11.291 12.6869 11.0529 12.9245 10.6884 12.9249C9.22813 12.9272 7.76823 12.9269 6.30794 12.9249C5.98443 12.9245 5.73272 12.7298 5.71125 12.4207C5.67379 11.881 5.65701 11.339 5.84706 10.8156C6.04023 10.2841 6.35711 9.84432 6.80589 9.50051C6.82891 9.48295 6.85272 9.46579 6.87496 9.44666C6.88199 9.44081 6.8855 9.43066 6.89018 9.42247C5.93487 8.37817 6.17408 6.92686 7.04316 6.18188C7.92316 5.42754 9.21565 5.46032 10.0449 6.26227C10.8711 7.06149 11.0037 8.43788 10.1035 9.4213ZM6.87223 11.744C7.96374 11.744 9.04628 11.744 10.1276 11.744C10.187 10.8839 9.40608 10.1015 8.49955 10.1015C7.59379 10.1019 6.81057 10.8871 6.87223 11.744ZM9.55399 7.87476C9.55672 7.28744 9.08648 6.80939 8.50306 6.80627C7.92823 6.80315 7.45018 7.27613 7.4455 7.8533C7.44043 8.44764 7.9173 8.93271 8.50345 8.92959C9.08062 8.92608 9.55165 8.45349 9.55399 7.87476Z" fill="#282421" fill-opacity="0.52"/>
				</svg>
			</div>
			<p class="mt-[16px] mb-0 uppercase text-sm font-medium desc">Total Surat Disetujui</p>
			<h1 class="m-0 text-3xl font-semibold text-second">{{ $total_letters_approved }}</h1>
		</div>
		<div class="card-dashboard  md:border-r border-r-0">
			<div class="icon-dashboard-wrapper">
				<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
					<path d="M2.76489 15.7989C2.58988 15.7448 2.40444 15.7116 2.24102 15.6328C1.50699 15.2781 1.14732 14.6816 1.145 13.8696C1.14307 13.1189 1.14461 12.3683 1.14461 11.6172C1.14461 8.40334 1.14577 5.18982 1.14307 1.97592C1.14268 1.51967 1.2412 1.09895 1.52515 0.734639C1.8883 0.268722 2.36813 0.0191514 2.95806 0.00640243C3.51322 -0.00557387 4.06876 0.00292499 4.62431 0.00292499C7.64813 0.00292499 10.6723 0.00292537 13.6962 0.0033117C13.7781 0.0033117 13.8623 0.000993566 13.9419 0.0164469C14.2544 0.0771011 14.4422 0.320104 14.4426 0.679393C14.4449 3.02404 14.4433 5.3687 14.4441 7.71373C14.4441 8.00155 14.3375 8.22678 14.0632 8.34346C13.8287 8.44313 13.598 8.41068 13.4215 8.23026C13.3272 8.13406 13.2747 7.99073 13.2248 7.86015C13.197 7.78714 13.2098 7.69751 13.2098 7.61561C13.209 5.56379 13.2094 3.51237 13.2094 1.46056C13.2094 1.39411 13.2094 1.32766 13.2094 1.24885C11.45 1.24885 9.70033 1.24885 7.93325 1.24885C7.93325 1.318 7.93325 1.38329 7.93325 1.44858C7.93325 2.96532 7.93363 4.48245 7.93286 5.99919C7.93286 6.36427 7.79764 6.58912 7.52373 6.68802C7.30082 6.76838 7.09993 6.72163 6.91487 6.58139C6.5382 6.29551 6.16153 6.01001 5.77249 5.71485C5.4132 5.98799 5.05739 6.26421 4.69424 6.5304C4.59302 6.60457 4.47634 6.67102 4.35658 6.70347C4.0197 6.79504 3.67045 6.54855 3.62757 6.20201C3.61675 6.11548 3.61328 6.02778 3.61328 5.94085C3.6125 4.44459 3.6125 2.94832 3.6125 1.45206C3.6125 1.38638 3.6125 1.32032 3.6125 1.24923C3.3583 1.24923 3.11568 1.22721 2.87886 1.25503C2.60418 1.28748 2.41642 1.5158 2.38744 1.79242C2.38088 1.85346 2.37894 1.91566 2.37894 1.97708C2.37856 5.31925 2.37856 8.66179 2.37856 12.004C2.37856 12.0638 2.37856 12.1237 2.37856 12.1558C2.79773 12.128 3.19488 12.1017 3.6125 12.0739C3.6125 12.0233 3.6125 11.9634 3.6125 11.9035C3.6125 10.8133 3.61135 9.72344 3.61328 8.63321C3.61366 8.26039 3.77979 8.02666 4.08963 7.9494C4.43501 7.86324 4.78966 8.10354 4.83486 8.45742C4.84529 8.53855 4.84684 8.62161 4.84684 8.70352C4.84761 9.76786 4.84722 10.8322 4.84722 11.8966C4.84722 11.9572 4.84722 12.0179 4.84722 12.0874C7.63654 12.0874 10.4112 12.0874 13.209 12.0874C13.209 11.9638 13.2082 11.8429 13.209 11.7215C13.2117 11.4133 13.2048 11.1042 13.2214 10.7967C13.2357 10.534 13.4149 10.3389 13.6684 10.2697C13.9133 10.2029 14.1872 10.2859 14.3185 10.5034C14.3892 10.6205 14.4348 10.7708 14.4375 10.9075C14.4503 11.4936 14.448 12.0797 14.4414 12.6661C14.4364 13.0965 14.1853 13.3302 13.7452 13.3302C10.1968 13.3306 6.6483 13.3291 3.09945 13.3356C2.94338 13.336 2.76991 13.3805 2.63586 13.4585C2.41642 13.5856 2.33645 13.8634 2.40135 14.1095C2.46432 14.349 2.6799 14.5329 2.93295 14.5595C2.99901 14.5665 3.06662 14.5646 3.13345 14.5646C6.65101 14.565 10.169 14.5646 13.6865 14.565C13.7483 14.565 13.8101 14.563 13.8716 14.5684C14.1509 14.5916 14.3835 14.7991 14.429 15.0633C14.4796 15.3585 14.3406 15.6239 14.0721 15.746C14.0358 15.7622 14.001 15.7815 13.9654 15.7993C10.2323 15.7989 6.49879 15.7989 2.76489 15.7989ZM6.68578 4.85681C6.68578 3.63291 6.68578 2.43991 6.68578 1.24614C6.06881 1.24614 5.46497 1.24614 4.86113 1.24614C4.86113 2.44725 4.86113 3.63909 4.86113 4.85642C5.04 4.72043 5.19763 4.59912 5.35718 4.48052C5.64345 4.26765 5.90307 4.26765 6.18934 4.48052C6.34928 4.59912 6.50652 4.72082 6.68578 4.85681Z" fill="#282421" fill-opacity="0.52"/>
				</svg>
			</div>
			<p class="mt-[16px] mb-0 uppercase text-sm font-medium desc">Total Surat Belum Disetujui</p>
			<h1 class="m-0 text-3xl font-semibold text-second">{{ $total_letters_not_approved }}</h1>
		</div>
		<div class="card-dashboard">
			<div class="icon-dashboard-wrapper">
				<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
					<g clip-path="url(#clip0_7969_9)">
						<path d="M3.23439 15.9959C3.21314 15.9838 3.19272 15.9688 3.17022 15.9592C2.90356 15.8459 2.76106 15.6484 2.76064 15.3559C2.76022 14.8517 2.75522 14.3476 2.76189 13.8434C2.77647 12.6951 3.68814 11.7817 4.84022 11.7596C5.16314 11.7534 5.48606 11.7538 5.80897 11.7609C5.90939 11.763 5.95522 11.7342 5.98189 11.6359C6.09064 11.2355 6.20772 10.8371 6.32647 10.4213C5.33481 10.0292 4.54522 9.3888 3.98147 8.47964C3.41564 7.56714 3.23314 6.56505 3.30481 5.50214C3.21356 5.48005 3.13897 5.46297 3.06481 5.4438C1.76606 5.10714 0.844391 3.9438 0.826057 2.60714C0.817307 1.96255 0.821474 1.31797 0.824391 0.673385C0.826057 0.286718 1.08606 0.0279688 1.47314 0.0279688C5.81147 0.0271354 10.1502 0.0271354 14.4886 0.0279688C14.8852 0.0279688 15.144 0.284635 15.1456 0.681302C15.1486 1.32047 15.1536 1.96005 15.144 2.59922C15.119 4.2538 13.7527 5.56797 12.0931 5.54214C11.6848 5.53589 11.4252 5.27339 11.4248 4.86047C11.4236 3.73255 11.4244 2.60463 11.4244 1.47672C11.4244 1.41547 11.4244 1.35422 11.4244 1.28422C9.12814 1.28422 6.84481 1.28422 4.54522 1.28422C4.54522 1.33505 4.54522 1.38005 4.54522 1.42547C4.54522 2.9588 4.54231 4.49255 4.54606 6.02588C4.55022 7.68338 5.66231 9.0488 7.28606 9.39755C8.67022 9.69505 10.1419 9.0738 10.8952 7.87339C10.9286 7.82047 10.9594 7.7663 10.9936 7.71422C11.1898 7.41297 11.5565 7.32214 11.8527 7.50172C12.1473 7.68005 12.2398 8.0488 12.0611 8.36047C11.7119 8.97005 11.2536 9.48505 10.6673 9.87297C10.3486 10.0842 10.0027 10.2546 9.65189 10.453C9.77147 10.8688 9.89814 11.3096 10.0273 11.7588C10.3748 11.7588 10.7127 11.758 11.0506 11.7588C12.1506 11.7626 13.0069 12.4842 13.1877 13.5642C13.2073 13.6813 13.2073 13.8021 13.2081 13.9217C13.2106 14.3426 13.1923 14.7646 13.214 15.1846C13.234 15.5738 13.1056 15.8501 12.7348 15.9967C9.56772 15.9959 6.40106 15.9959 3.23439 15.9959ZM11.959 14.7434C11.959 14.4742 11.9456 14.2196 11.9615 13.9667C11.9973 13.3971 11.5656 12.9942 10.9894 13.0005C9.55231 13.0159 8.11522 13.0055 6.67814 13.0055C6.08439 13.0055 5.49106 13.003 4.89731 13.0063C4.49439 13.0084 4.12814 13.2351 4.06064 13.6017C3.99272 13.9726 4.01189 14.3592 3.99272 14.743C6.66939 14.7434 9.30272 14.7434 11.959 14.7434ZM2.07481 1.28214C2.07481 1.73005 2.06189 2.1663 2.07772 2.6013C2.10272 3.29589 2.44564 3.79672 3.06022 4.11505C3.13064 4.1513 3.20772 4.17422 3.28647 4.20547C3.28647 3.2188 3.28647 2.25422 3.28647 1.28214C2.88397 1.28214 2.49022 1.28214 2.07481 1.28214ZM12.6798 4.21338C13.3123 3.97547 13.7265 3.55714 13.8502 2.91089C13.9127 2.58422 13.8865 2.24005 13.8952 1.9038C13.9006 1.69838 13.8961 1.49255 13.8961 1.28505C13.4794 1.28505 13.0823 1.28505 12.6798 1.28505C12.6798 2.2588 12.6798 3.22297 12.6798 4.21338ZM8.42397 10.7071C8.11897 10.7071 7.83522 10.7071 7.54522 10.7071C7.44606 11.0538 7.34814 11.3963 7.24731 11.7492C7.74522 11.7492 8.22606 11.7492 8.72272 11.7492C8.62064 11.3934 8.52231 11.0505 8.42397 10.7071Z" fill="#282421" fill-opacity="0.52"/>
						<path d="M8.60541 5.3141C9.00541 5.48285 9.17 5.7541 9.08375 6.08826C9.01375 6.35993 8.79833 6.54618 8.51041 6.55451C8.15666 6.56493 7.80208 6.56493 7.44833 6.55493C7.15166 6.54618 6.91416 6.33576 6.8625 6.06201C6.80666 5.76535 6.95416 5.48868 7.235 5.36285C7.2725 5.34618 7.31083 5.3316 7.35458 5.3141C7.35458 5.07243 7.36 4.83368 7.34958 4.59535C7.34791 4.55285 7.29 4.4966 7.245 4.47535C6.955 4.33993 6.80416 4.06701 6.8625 3.76535C6.91833 3.47576 7.17583 3.27493 7.49666 3.27076C7.585 3.26951 7.67375 3.27035 7.76208 3.27035C8.00166 3.27035 8.24125 3.26785 8.48083 3.2716C8.78958 3.2766 9.02625 3.4741 9.09125 3.77368C9.15166 4.05326 9.00583 4.34201 8.72791 4.45868C8.63 4.49993 8.59791 4.54743 8.60166 4.65118C8.61125 4.86868 8.60541 5.0866 8.60541 5.3141Z" fill="#282421" fill-opacity="0.52"/>
					</g>
					<defs>
						<clipPath id="clip0_7969_9">
							<rect width="16" height="16" fill="white"/>
						</clipPath>
					</defs>
				</svg>
			</div>
			<p class="mt-[16px] mb-0 uppercase text-sm font-medium desc">Total Surat Diterima</p>
			<h1 class="m-0 text-3xl font-semibold text-second">{{ $total_letters }}</h1>
		</div>
	</div>
	
	<div class="card-dashboard-wrapper mt-[20px]">
		<div class="flex sm:flex-row flex-col gap-3 justify-between">
			<h6 class="text-2xl font-semibold text-second mb-0">Grafik Total Surat Diterima</h6>
			<div class="category1 item">
				<button id="dropdownDefaultButton" onclick="showItems('category1')" data-dropdown-toggle="dropdown" class="flex w-max btn-dropdown category-name active" type="button">
					Tahun ini
					<svg class="w-2.5 h-2.5 ms-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
						<path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
					</svg>
				</button>
				<!-- Dropdown menu -->
				<div id="dropdown" class="z-30 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
					<ul class="py-2 text-sm ps-0" aria-labelledby="dropdownDefaultButton">
						<li>
							<button onclick="showItems('category2')" class="link-dropdown category-name">Bulan ini</button>
						</li>
						<li>
							<button onclick="showItems('category3')" class="link-dropdown category-name">Minggu ini</button>
						</li>

					</ul>
				</div>
			</div>
			<div class="category2 item" style="display: none">
				<button id="dropdownDefaultButton2" onclick="showItems('category2')" data-dropdown-toggle="dropdown2" class="flex btn-dropdown category-name active" type="button">
					Bulan ini
					<svg class="w-2.5 h-2.5 ms-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
						<path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
					</svg>
				</button>
				<!-- Dropdown menu -->
				<div id="dropdown2" class="z-30 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
					<ul class="py-2 text-sm ps-0" aria-labelledby="dropdownDefaultButton2">
						<li>
							<button onclick="showItems('category3')" class="link-dropdown category-name">Minggu ini</button>
						</li>
						<li>
							<button onclick="showItems('category1')" class="link-dropdown category-name">Tahun ini</button>
						</li>

					</ul>
				</div>
			</div>
			<div class="category3 item" style="display: none">
				<button id="dropdownDefaultButton3" onclick="showItems('category3')" data-dropdown-toggle="dropdown3" class="flex btn-dropdown category-name active" type="button">
					Minggu ini
					<svg class="w-2.5 h-2.5 ms-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
						<path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
					</svg>
				</button>
				<!-- Dropdown menu -->
				<div id="dropdown3" class="z-30 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
					<ul class="py-2 text-sm ps-0" aria-labelledby="dropdownDefaultButton">
						<li>
							<button onclick="showItems('category1')" class="link-dropdown category-name">Tahun ini</button>
						</li>
						<li>
							<button onclick="showItems('category2')" class="link-dropdown category-name">Bulan ini</button>
						</li>

					</ul>
				</div>
			</div>

		</div>
		<div class="category-content mt-[32px]">
			<div class="category1 item">
				<div class="" id="chart1"></div>
			</div>
			<div class="category2 item" style="display: none">
				<div class="" id="chart2"></div>
			</div>
			<div class="category3 item" style="display: none">
				<div class="" id="chart3"></div>
			</div>
		</div>
	</div>	
</div>

@endsection

@push('js')
	<script>
		let letter_yearly = <?= json_encode($letter_yearly); ?>;
		let letter_monthly = <?= json_encode($letter_monthly); ?>;
		let letter_weekly = <?= json_encode($letter_weekly); ?>;

		document.addEventListener('DOMContentLoaded', function() {
			var showCategory = 'category1';
			var showAllCategory = document.querySelector(`.category-name[data-category="${showCategory}"]`);
			showAllCategory.classList.add('active');
			showCategory.style.display = 'flex';
			showItems(showCategory); // Panggil fungsi showItems() dengan kategori 'category1' sebagai default
		});

		function showItems(category) {
			// Menghapus kelas "active" dari semua kategori
			var categories = document.getElementsByClassName('.category-name');
			for (var i = 0; i < categories.length; i++) {
				categories[i].classList.remove('active');
			}

			// Menambahkan kelas "active" ke kategori yang dipilih
			var selectedCategory = event.target;
			if (!selectedCategory.classList.contains('active')) {
				selectedCategory.classList.add('active');
			}

			// Menampilkan item-item yang memiliki kategori yang sama dengan kategori yang dipilih
			var items = document.getElementsByClassName('item');
			for (var j = 0; j < items.length; j++) {
				items[j].style.display = 'none';
				if (items[j].classList.contains(category)) {
					items[j].style.display = 'block';
				}
			}
		}

		let options1 = {
			chart: {
				type: 'bar',
				height: 215
			},
			plotOptions: {
				bar: {
					horizontal: false,
					columnWidth: 26,
					endingShape: 'rounded',
					startingShape: 'rounded',
					rounded:'50%',
					borderRadius: 5,
					// borderRadiusApplication: 'end',
				},
			},
			colors:['#5F84E9E5'],

			series: [{
				name: 'prestasi',
				data: letter_yearly
			}],
			xaxis: {
				categories: ['Jan','Feb','Mar','Apr','Mei','Jun','Jul', 'Aug','Sep', 'Okt', 'Nov', 'Des']
			},
			yaxis: {
				categories: [10, 20, 30, 40, 50]
			}
		}

		let options2 = {
			chart: {
				type: 'bar',
				height: 215
			},
			plotOptions: {
				bar: {
					horizontal: false,
					columnWidth: 26,
					endingShape: 'rounded',
					startingShape: 'rounded',
					rounded:'50%',
					borderRadius: 5,
					// borderRadiusApplication: 'end',
				},
			},
			colors:['#5F84E9E5'],

			series: [{
				name: 'prestasi',
				data: letter_monthly
			}],
			xaxis: {
				categories: ['Minggu 1','Minggu 2','Minggu 3','Minggu 4']
			},
			yaxis: {
				categories: [10, 20, 30, 40, 50]
			}
		}

		let options3 = {
			chart: {
				type: 'bar',
				height: 215
			},
			plotOptions: {
				bar: {
					horizontal: false,
					columnWidth: 26,
					endingShape: 'rounded',
					startingShape: 'rounded',
					rounded:'50%',
					borderRadius: 5,
					// borderRadiusApplication: 'end',
				},
			},
			colors:['#5F84E9E5'],

			series: [{
				name: 'prestasi',
				data: letter_weekly
			}],
			xaxis: {
				categories: ['Senin','Selasa','Rabu','Kamis','Jumat','Sabtu','Minggu']
			},
			yaxis: {
				categories: [10, 20, 30, 40, 50]
			}
		}

		let chart = new ApexCharts(document.querySelector("#chart1"), options1);
		let chart2 = new ApexCharts(document.querySelector("#chart2"), options2);
		let chart3= new ApexCharts(document.querySelector("#chart3"), options3);

		chart.render();
		chart2.render();
		chart3.render();
	</script>
@endpush

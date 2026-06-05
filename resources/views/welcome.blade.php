@extends('layout.headerfooter')

@section('konten')
@php
    // Ambil data total koleksi dari API
    $api_url = 'https://opac.lib.ibrahimy.ac.id/api/statistik_api.php?token=lib180597';

    function getApiData($url) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }

    $api_response = getApiData($api_url);
    if ($api_response !== false && $api_response !== null) {
        $api_data = json_decode($api_response, true);
        $total_biblio = $api_data['data']['total_biblio'] ?? 0;
        $total_item   = $api_data['data']['total_item'] ?? 0;
    } else {
        $total_biblio = 0;
        $total_item   = 0;
    }

    // Statistik per lokasi
    $lokasi_list = ['PA', 'PI', 'FIK'];
    $data_lokasi_item = [];
    $total_all_item = 0;

    foreach ($lokasi_list as $lok) {
        $res = getApiData($api_url.'&lokasi='.$lok);
        $json = json_decode($res, true);
        $item = $json['data']['total_item'] ?? 0;
        $data_lokasi_item[$lok] = $item;
        $total_all_item += $item;
    }
    
    
$anggota_api = 'https://opac.lib.ibrahimy.ac.id/api/statistik_anggota.php?token=lib180597';
$anggota_response = getApiData($anggota_api);

if ($anggota_response !== false && $anggota_response !== null) {
    $anggota_data = json_decode($anggota_response, true);
    $total_member   = $anggota_data['data']['total_member'] ?? 0;
    $active_member  = $anggota_data['data']['active_member'] ?? 0;
} else {
    $total_member  = 0;
    $active_member = 0;
}
@endphp
	<!--
	=============================================
		Hero Banner
	==============================================
	-->
	<div class="hero-banner-eight pt-200 lg-pt-150 pb-225 xl-pb-150 lg-pb-150 md-pb-120 sm-pb-20 
		position-relative z-1"
		style="min-height:100vh; display:flex; align-items:center;">
		
		<div class="container position-relative">
			<div class="row">
				<div class="col-lg-6 col-md-8">
					<h1 class="hero-heading text-white position-relative wow fadeInUp">Perpustakaan Ibrahimy</h1>
					<div class="row">
						<div class="col-xl-11">
							<p class="text-xl text-white pt-25 lg-pt-20 pb-40 lg-pb-30 md-pb-20 wow fadeInUp" data-wow-delay="0.1s">
								Membangun intelektual paripurna menuju pemberdayaan ummat.
							</p>
						</div>
					</div>
					<div class="d-lg-inline-flex align-items-center wow fadeInUp" data-wow-delay="0.2s">
						<ul class="style-none d-flex flex-wrap align-items-center">
							<li class="me-3 mt-10"><a href="/sejarah" class="btn-twentyOne">Selengkapnya</a></li>
							<li class="mt-10"><a href="/libtour" class="btn-twentytwo">Jelajahi</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>

		<div class="media-wrapper wow fadeInUp">
			<img src="assets/images/assets/menara.png" alt="" class="w-100">
			<img src="assets/images/assets/screen_26.png" alt="" class="shapes shape_01">
			<img src="assets/images/assets/screen_27.png" alt="" class="shapes shape_02">
		</div>
	</div>


	<!-- /.hero-banner-eight -->
	<!--
	=============================================
	    Text Feature Six
	==============================================
	-->
	<div class="text-feature-six position-relative mt-200 lg-mt-120"
	style="min-height:100vh; display:flex; align-items:center;"></div>
		<div class="container">
            <div class="position-relative pb-140 xl-pb-100 md-pb-60">
                <div class="row justify-content-center">
                    <div class="col-lg-5">
                        <div class="title-two mb-30">
                            {{-- <div class="upper-title">Keanggotaan</div> --}}
							<h2>Statistik Keanggotaan</h2>
						</div>
						<!-- /.title-two -->
                        <p class="text-lg mb-35 pe-xl-5 me-xl-4">Informasi jumlah anggota perpustakaan serta anggota yang masih aktif.</p>
                         <a href="https://opac.lib.ibrahimy.ac.id/" class="btn-thirteen tran3s me-5">Selengkapnya</a> 
                    </div>
                    <div class="col-lg-4 ms-auto mb-50">
                        <div class="ps-xl-5 ms-xxl-2 md-mt-60">
                            <div class="card-style-ten border-bottom mb-60 lg-mb-40">
                                <h4 class="fw-bold">Total Anggota Terdaftar</h4>
                                <!-- <p>Digital agency with top rated talented people provide quality.</p> -->
                                <div class="main-count d-inline-block position-relative fw-bold"><span class="counter"><?php echo number_format($total_member); ?></span></div>
                                <div>Semua anggota yang terdaftar dalam sistem</div>
                            </div>
                            <!-- /.card-style-ten -->
                            <div class="card-style-ten">
                                <h4 class="fw-bold">Total Anggota Aktif</h4>
                                <div class="main-count d-inline-block position-relative fw-bold"><span class="counter"><?php echo number_format($active_member); ?></span></div>
                                <div>Anggota dengan status aktif saat ini.</div>
                            </div>
                            <!-- /.card-style-ten -->
                        </div>
                    </div>
                </div>
                <div class="media-wrapper">
					<img src="assets/images/assets/hand.png" alt="" class="w-100">
					<img src="assets/images/assets/screen_14.png" alt="" class="shapes screen_01">
				</div>

				<img src="assets/images/shape/shape_15.png" alt="" class="shapes shape_01">
				<img src="assets/images/shape/shape_16.svg" alt="" class="shapes shape_02">
            </div>
        </div>
	</div>
	<!-- /.text-feature-six -->

	<!--
	=============================================
		Text Feature Two
	==============================================
	-->
	<div class="text-feature-two position-relative pt-110 lg-pt-80 pb-110 lg-pb-80"
		style="min-height:100vh; display:flex; align-items:center;">
		<div class="container">
			<div class="row align-items-center">
				<div class="col-xl-6 col-lg-7">
					<div class="title-one">
						<h2 class="text-white">Statistik Koleksi</h2>
                        <p class="text-lg mb-35 pe-xl-5 me-xl-4 text-white">Data koleksi perpustakaan yang terus diperbarui untuk mendukung pembelajaran dan penelitian.</p>

					</div>
					<!-- /.title-one -->
				</div>
				<div class="col-lg-5 ms-auto">
					<div class="row g-4">
						<div class="col-md-6">
							<div style="background:#ffffff; padding:25px; border-radius:16px; box-shadow:0 6px 20px rgba(0,0,0,0.06); position:relative; overflow:hidden;">
								<div style="width:12px; height:70%; background:#007bff; position:absolute; left:0; top:15%; border-radius:0 10px 10px 0;"></div>
								<div style="font-size:15px; font-weight: bold; color:#6c757d; margin-bottom:8px;">Total Eksemplar</div>
								<div style="font-size:34px; font-weight:700; color:#007bff;">{{ number_format($total_item) }}</div>
							</div>
						</div>

						<div class="col-md-6">
							<div style="background:#ffffff; padding:25px; border-radius:16px; box-shadow:0 6px 20px rgba(0,0,0,0.06); position:relative; overflow:hidden;">
								<div style="width:12px; height:70%; background:#28a745; position:absolute; left:0; top:15%; border-radius:0 10px 10px 0;"></div>
								<div style="font-size:15px; font-weight: bold; color:#6c757d; margin-bottom:8px;">Total Judul Koleksi</div>
								<div style="font-size:34px; font-weight:700; color:#28a745;">{{ number_format($total_biblio) }}</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="row g-4 mt-15">
				@foreach($data_lokasi_item as $lok => $jumlah)
					@php
						$color = [
							'PA' => '#007bff',
							'PI' => '#28a745',
							'FIK' => '#ffc107'
						][$lok];
						$persen = $total_all_item > 0 ? round(($jumlah / $total_all_item) * 100, 1) : 0;
					@endphp
					<div class="col-md-4">
						<div style="background:#ffffff; padding:25px; border-radius:16px; box-shadow:0 6px 20px rgba(0,0,0,0.06); position:relative; overflow:hidden;">
							<div style="width:12px; height:70%; background:{{ $color }}; position:absolute; left:0; top:15%; border-radius:0 10px 10px 0;"></div>
							<div style="font-size:16px; color:#6c757d; margin-bottom:5px;">Lokasi: <strong>{{ $lok }}</strong></div>
							<div style="font-size:34px; font-weight:700; color:{{ $color }};">{{ number_format($jumlah) }} Eksemplar</div>
							<div style="margin-top:5px; font-size:14px;"><strong>{{ $persen }}%</strong> dari total koleksi</div>

						</div>
						{{-- <div style="background:#ffffff; padding:25px; border-radius:16px; box-shadow:0 6px 20px rgba(0,0,0,0.06); border-left:10px solid {{ $color }};">
							<div style="font-size:16px; color:#6c757d;">Lokasi: <strong>{{ $lok }}</strong></div>
							<div style="font-size:30px; font-weight:700; color:{{ $color }};">{{ number_format($jumlah) }} Eksemplar</div>
							<div style="margin-top:10px; font-size:14px;"><strong>{{ $persen }}%</strong> dari total koleksi</div>
						</div> --}}
					</div>
				@endforeach
			</div>
		</div>
		<img src="images/lazy.svg" data-src="images/shape/shape_07.svg" alt="" class="lazy-img shapes shape_01">
		<img src="images/lazy.svg" data-src="images/shape/shape_08.svg" alt="" class="lazy-img shapes shape_02">
	</div>
	<!-- /.text-feature-two -->



	<!--jumlah anggota-->
<!--		<div class="block-feature-eight position-relative pt-130 lg-pt-80 pb-130 lg-pb-60">-->
<!--		<div class="container">-->
<!--<div class="container mt-5">-->
<!--    <h4 class="mb-4 text-center">-->
<!--        Statistik Keanggotaan-->
<!--        <br>-->
<!--        <small class="subtitle-section">-->
<!--            Informasi jumlah anggota perpustakaan serta anggota yang masih aktif.-->
<!--        </small>-->
<!--    </h4>-->

<!--    <div class="row g-4">-->

        <!-- Card Total Anggota -->
<!--        <div class="col-md-6">-->
<!--            <div style="-->
<!--                background:#ffffff;-->
<!--                padding:25px;-->
<!--                border-radius:16px;-->
<!--                box-shadow:0 6px 20px rgba(0,0,0,0.06);-->
<!--                position:relative;-->
<!--                overflow:hidden;-->
<!--            ">-->
<!--                <div style="-->
<!--                    width:12px;-->
<!--                    height:70%;-->
<!--                    background:#6f42c1;-->
<!--                    position:absolute;-->
<!--                    left:0;-->
<!--                    top:15%;-->
<!--                    border-radius:0 10px 10px 0;-->
<!--                "></div>-->

<!--                <div style="font-size:15px; color:#6c757d; margin-bottom:8px;">-->
<!--                    Total Anggota Terdaftar-->
<!--                </div>-->
<!--                <div style="font-size:34px; font-weight:700; color:#6f42c1;">-->
<!--                    <?php echo number_format($total_member); ?>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->

        <!-- Card Total Anggota Aktif -->
<!--        <div class="col-md-6">-->
<!--            <div style="-->
<!--                background:#ffffff;-->
<!--                padding:25px;-->
<!--                border-radius:16px;-->
<!--                box-shadow:0 6px 20px rgba(0,0,0,0.06);-->
<!--                position:relative;-->
<!--                overflow:hidden;-->
<!--            ">-->
<!--                <div style="-->
<!--                    width:12px;-->
<!--                    height:70%;-->
<!--                    background:#20c997;-->
<!--                    position:absolute;-->
<!--                    left:0;-->
<!--                    top:15%;-->
<!--                    border-radius:0 10px 10px 0;-->
<!--                "></div>-->

<!--                <div style="font-size:15px; color:#6c757d; margin-bottom:8px;">-->
<!--                    Total Anggota Aktif-->
<!--                </div>-->
<!--                <div style="font-size:34px; font-weight:700; color:#20c997;">-->
<!--                    <?php echo number_format($active_member); ?>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->

<!--    </div>-->
<!--</div>-->
<!--</div>-->
<!--</div>-->
<!--jumlah anggota-->
	<!--
	=============================================
		BLock Feature Eight
	==============================================
	-->
	<div class="block-feature-eight position-relative pt-130 lg-pt-80 pb-130 lg-pb-60">
		<div class="container">
			<div class="position-relative">
				<div class="title-two mb-20 lg-mb-10">
                    <h2>Layanan Digital</h2>
                </div>
                <!-- /.title-two -->
                <p class="text-lg mb-45 lg-mb-10">Beberapa layanan digital Perpustakaan Ibrahimy.</p>
				<div class="row">
					<div class="col-lg-4 d-flex wow fadeInUp">
						<div class="card-style-two vstack tran3s w-100 mt-30">
							<img src="assets/images/lazy.svg" data-src="assets/images/icon/icon_40.svg" alt="" class="lazy-img icon me-auto">
							<h4 class="fw-500 mt-30 mb-15">Online Public Access Catalog (OPAC)</h4>
							<p class="mb-25">Layanan ini memungkinkan pemustaka dapat mencari koleksi yang diinginkan yang ada di rak koleksi.</p>
							<a href="https://opac.lib.ibrahimy.ac.id/" class="arrow-btn tran3s mt-auto stretched-link"><img src="assets/images/lazy.svg" data-src="assets/images/icon/icon_09.svg" alt="" class="lazy-img"></a>
						</div>
						<!-- /.card-style-eleven -->
					</div>
					<div class="col-lg-4 d-flex wow fadeInUp" data-wow-delay="0.1s">
						<div class="card-style-two vstack tran3s w-100 mt-30">
							<img src="assets/images/lazy.svg" data-src="assets/images/icon/icon_08.svg" alt="" class="lazy-img icon me-auto">
							<h4 class="fw-500 mt-30 mb-15">Resource Guide</h4>
							<p class="mb-25">Pemustaka dapat mengakses berbagai sumber referensi yang direkomendasikan sesuai dengan program studi terkait.</p>
							<a href="/resourceguide" class="arrow-btn tran3s mt-auto stretched-link"><img src="assets/images/lazy.svg" data-src="assets/images/icon/icon_09.svg" alt="" class="lazy-img"></a>
						</div>
						<!-- /.card-style-eleven -->
					</div>
					<div class="col-lg-4 d-flex wow fadeInUp" data-wow-delay="0.2s">
						<div class="card-style-two vstack tran3s w-100 mt-30">
							<img src="assets/images/lazy.svg" data-src="assets/images/icon/icon_07.svg" alt="" class="lazy-img icon me-auto">
							<h4 class="fw-500 mt-30 mb-15">E-Repository</h4>
							<p class="mb-25">Pemustaka dapat mengakses berbagai macam data, dokumen, dan hasil penelitian.</p>
							<a href="http://repository.ibrahimy.ac.id/" class="arrow-btn tran3s mt-auto stretched-link"><img src="assets/images/lazy.svg" data-src="assets/images/icon/icon_09.svg" alt="" class="lazy-img"></a>
						</div>
						<!-- /.card-style-eleven -->
					</div>
				</div>
				<div class="section-btn md-mt-40">
					<a href="http://digilib.ibrahimy.ac.id/" class="btn-thirteen tran3">Selengkapnya</a>
				</div>
				<!-- /.section-subheading -->
			</div>
		</div>
        <img src="assets/images/lazy.svg" data-src="assets/images/shape/shape_16.svg" alt="" class="lazy-img shapes shape_01">
	</div>
	<!-- /.block-feature-eight -->
			<!--
	=====================================================
		FAQ Section Two
	=====================================================
	-->
	<div class="faq-section-two position-relative mt-180 lg-mt-100 pb-150 lg-pb-80">
		<div class="container">
			<div class="position-relative">
				<div class="title-one mb-40">
					<h2>Jam Layanan</h2>
					<p class="text-lg pt-15 lg-pt-10">Perpustakaan Ibrahimy</p>
				</div>
				<!-- /.title-one -->
				<div class="row">
					<div class="col-12">
						<div class="accordion accordion-style-two mt-15" id="accordionOne">
							<div class="accordion-item">
								<h2 class="accordion-header">
									<button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
										Perpustakaan Pusat
									</button>
								</h2>
								<div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#accordionOne">
									<div class="accordion-body">
										<div class="row">
											<div class="col-lg-6">
												<h6>Lokasi</h6>
												<p class="mb-50">L:II Masjid Jami' Ibrahimy, PP. Salafiyah Syafi'iyah Sukorejo Situbondo</p>
												<h6>Sabtu-Rabu</h6>
												<ul class="style-none pt-20 pb-30">
													<li>08.00 - 16.30</li>
													<li>20.00 - 23.00</li>
												</ul>
												<h6>Kamis</h6>
												<ul class="style-none pt-20 pb-30">
													<li>08.00 - 16.30</li>
												</ul>
												<h6>Jum'at</h6>
												<ul class="style-none pt-20 pb-30">
													<li>20.30 - 22.00</li>
												</ul>
											</div>
											<div class="col-lg-6 d-flex">
												<div class="media-wrapper ms-auto me-auto w-100 d-flex align-items-center justify-content-center position-relative" style="background-image: url(assets/images/media/img_01.jpg);">
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="accordion-item">
								<h2 class="accordion-header">
									<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
										Perpustakaan Putri
									</button>
								</h2>
								<div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionOne">
									<div class="accordion-body">
										<div class="row">
											<div class="col-lg-6">
												<h6>Lokasi</h6>
												<p class="mb-50">Area Pondok Putri Pusat, PP. Salafiyah Syafi'iyah Sukorejo Situbondo</p>
												<h6>Sabtu-Rabu</h6>
												<ul class="style-none pt-20 pb-30">
													<li>08.00 - 16.30</li>
													<li>20.00 - 23.00</li>
												</ul>
												<h6>Kamis</h6>
												<ul class="style-none pt-20 pb-30">
													<li>08.00 - 16.30</li>
												</ul>
												<h6>Jum'at</h6>
												<ul class="style-none pt-20 pb-30">
													<li>20.30 - 22.00</li>
												</ul>
											</div>
											<div class="col-lg-6 d-flex">
												<div class="media-wrapper ms-auto me-auto w-100 d-flex align-items-center justify-content-center position-relative" style="background-image: url(assets/images/media/img_02.jpg);">
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="accordion-item">
								<h2 class="accordion-header">
									<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="true" aria-controls="collapseThree">
										Perpustakaan FIK Ibrahimy
									</button>
								</h2>
								<div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionOne">
									<div class="accordion-body">
										<div class="row">
											<div class="col-lg-6">
												<h6>Lokasi</h6>
												<p class="mb-50">Gedung Fakultas Ilmu Kesehatan Area Kampus Putri, PP. Salafiyah Syafi'iyah Sukorejo Situbondo</p>
												<h6>Sabtu-Kamis</h6>
												<ul class="style-none pt-20 pb-30">
													<li>08.00 - 16.30</li>
												</ul>
											</div>
											<div class="col-lg-6 d-flex">
												<div class="media-wrapper ms-auto me-auto w-100 d-flex align-items-center justify-content-center position-relative" style="background-image: url(assets/images/media/img_03.jpg);">
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<!-- /.accordion-style-two -->
					</div>
				</div>
				<!-- <div class="section-btn sm-mt-40">
					<a href="project-v2.html" class="btn-nine rounded-circle d-inline-flex align-items-center justify-content-center tran3s"><i class="bi bi-arrow-up-right"></i></a>
				</div> -->
			</div>
		</div>
		<img src="assets/images/lazy.svg" data-src="assets/images/shape/shape_06.svg" alt="" class="lazy-img shapes shape_01">
		<img src="assets/images/lazy.svg" data-src="assets/images/shape/shape_06.svg" alt="" class="lazy-img shapes shape_02">
	</div>
	<!-- /.faq-section-two -->

{{-- <!-- Statistik Koleksi -->
<div class="container mt-5">
    <h4 class="mb-4 text-center">
        Statistik Koleksi Perpustakaan
        <br>
        <small class="subtitle-section">Data koleksi perpustakaan yang terus diperbarui untuk mendukung pembelajaran dan penelitian.</small>
    </h4>

    <div class="row g-4">
        <div class="col-md-6">
            <div style="background:#ffffff; padding:25px; border-radius:16px; box-shadow:0 6px 20px rgba(0,0,0,0.06); position:relative; overflow:hidden;">
                <div style="width:12px; height:70%; background:#007bff; position:absolute; left:0; top:15%; border-radius:0 10px 10px 0;"></div>
                <div style="font-size:15px; color:#6c757d; margin-bottom:8px;">Total Eksemplar</div>
                <div style="font-size:34px; font-weight:700; color:#007bff;">{{ number_format($total_item) }}</div>
            </div>
        </div>

        <div class="col-md-6">
            <div style="background:#ffffff; padding:25px; border-radius:16px; box-shadow:0 6px 20px rgba(0,0,0,0.06); position:relative; overflow:hidden;">
                <div style="width:12px; height:70%; background:#28a745; position:absolute; left:0; top:15%; border-radius:0 10px 10px 0;"></div>
                <div style="font-size:15px; color:#6c757d; margin-bottom:8px;">Total Judul Koleksi</div>
                <div style="font-size:34px; font-weight:700; color:#28a745;">{{ number_format($total_biblio) }}</div>
            </div>
        </div>
    </div>
</div>

<!-- Statistik Berdasarkan Lokasi -->
<div class="container mt-5">
    <h4 class="mb-4 text-center">
        Statistik Per Lokasi
        <br>
        <small class="subtitle-section">Distribusi eksemplar berdasarkan lokasi koleksi.</small>
    </h4>

    <div class="row g-4">
        @foreach($data_lokasi_item as $lok => $jumlah)
            @php
                $color = [
                    'PA' => '#007bff',
                    'PI' => '#28a745',
                    'FIK' => '#ffc107'
                ][$lok];
                $persen = $total_all_item > 0 ? round(($jumlah / $total_all_item) * 100, 1) : 0;
            @endphp
            <div class="col-md-4">
                <div style="background:#ffffff; padding:25px; border-radius:16px; box-shadow:0 6px 20px rgba(0,0,0,0.06); border-left:10px solid {{ $color }};">
                    <div style="font-size:16px; color:#6c757d;">Lokasi: <strong>{{ $lok }}</strong></div>
                    <div style="font-size:30px; font-weight:700; color:{{ $color }};">{{ number_format($jumlah) }} Eksemplar</div>
                    <div style="margin-top:10px; font-size:14px;"><strong>{{ $persen }}%</strong> dari total koleksi</div>
                </div>
            </div>
        @endforeach
    </div>
</div>
 --}}

	<!--
	=====================================================
		BLock Feature Three
	=====================================================
	-->
	<div class="block-feature-three blog-section-four position-relative mt-180 lg-mt-80">
		<div class="container">
			<div class="position-relative">
				<div class="row">
					<div class="col-lg-8">
						<div class="title-two mb-70 lg-mb-50">
							<h2>Berita</h2>
						</div>
						<!-- /.title-two -->
                        @if ($berita)
                            <div class="block-one pt-45 lg-pt-30 pb-20 ps-3 ps-xl-5 pe-xl-5 pe-3 position-relative border-30 wow fadeInUp" style="
                            background: url('{{ asset('storage/gambar/' . $berita->gambar) }}') no-repeat center;
                            background-size: cover;
                            height: 731px;
                            max-height: 731px;
                            width: 100%;">
                                <div class="row">
                                    <div class="col-lg-5">
                                        <div class="tag d-inline-block border-30 fw-500 text-uppercase mb-15">{{ $berita->penulis }}</div>
                                        <div class="date text-dark"><span class="fw-500">{{ Carbon\Carbon::parse($berita->created_at)->isoFormat('D MMMM Y')  }}</div>
                                    </div>
                                    <div class="col-lg-7">
                                        <h3 class="block-title d-inline-block position-relative" style="background-color: rgba(255, 255, 255, 0.7); padding: 0.5rem 1rem; border-radius: 0.5rem; color: #0e3e2f;" ><a href="{{ asset('/berita-'.$berita->slug.'') }}">{{ Str::words($berita->judul, 10, '...') }}</a></h3>
                                    </div>
                                </div>
                            </div>
						<!-- /.block-one -->
                        @endif
                    </div>
					<div class="col-lg-4">
                        @if ($berita2)
						<div class="block-three border-30 ps-lg-4 ps-3 pe-lg-4 pe-3 pt-40 lg-pt-30 pb-30 md-mt-30 wow fadeInUp" data-wow-delay="0.2s">
							<div class="date">{{ Carbon\Carbon::parse($berita2->created_at)->isoFormat('D MMMM Y')  }}</div>
							<h3 class="block-title d-inline-block position-relative mt-20 mb-80 lg-mb-50"><a href="{{ asset('/berita-'.$berita2->slug.'') }}">{{ $berita2->judul }}</a></h3>
							<div class="d-flex align-items-center justify-content-between">
								<div class="tag text-uppercase fw-500">{{ $berita2->penulis }}</div>
								<a href="{{ asset('/berita-'.$berita2->slug.'') }}" class="round-btn rounded-circle d-flex align-items-center justify-content-center tran3s"><i class="bi bi-arrow-up-right"></i></a>
							</div>
						</div>
                        @endif
						<!-- /.block-three -->
                        @if ($berita3)
						<div class="block-four border-30 ps-lg-4 ps-3 pe-lg-4 pe-3 pt-15 pb-30 mt-45 lg-mt-30 wow fadeInUp" data-wow-delay="0.2s" style="
                        background: url('{{ asset('storage/gambar/' . $berita3->gambar) }}') no-repeat center;
                        background-size: cover;
                        height: 472px;
                        max-height: 472px;
                        width: 100%;">
							<h3 class="block-title d-inline-block position-relative mt-20 mb-250 lg-mb-150 sm-mb-100" style="background-color: rgba(255, 255, 255, 0.7); padding: 0.5rem 1rem; border-radius: 0.5rem; color: #0e3e2f;"><a href="{{ asset('/berita-'.$berita3->slug.'') }}">{{ Str::words($berita3->judul, 8, '...') }}</a></h3>
							<div class="d-flex align-items-center justify-content-between">
								<div class="tag text-uppercase fw-500">{{$berita3->penulis}}</div>
								<a href="{{ asset('/berita-'.$berita3->slug.'') }}" class="round-btn rounded-circle d-flex align-items-center justify-content-center tran3s"><i class="bi bi-arrow-up-right"></i></a>
							</div>
						</div>
                        @endif
						<!-- /.block-four -->
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- /.block-feature-three -->


@endsection

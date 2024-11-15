@extends('layouts.main')

@section('title', 'Dashboard')

@section('content')

<div class="content">
	<div class="container-xxl">

				<div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
						<div class="flex-grow-1">
								<h4 class="fs-18 fw-semibold m-0">Dashboard</h4>
						</div>
				</div>

				<!-- start row -->
				<div class="row">
						<div class="col-md-12 col-xl-12">
								<div class="row g-3">

										<div class="col-md-6 col-xl-3">
												<div class="card">
														<div class="card-body">
																<div class="d-flex align-items-center">
																		<div class="fs-14 mb-1">Daromadlar</div>
																</div>

																<div class="d-flex align-items-baseline mb-2">
																		<div class="fs-22 mb-0 me-2 fw-semibold text-black">0 UZS</div>
																		<div class="me-auto">
																				<span class="text-primary d-inline-flex align-items-center">
																						15%
																						<i data-feather="trending-up" class="ms-1" style="height: 22px; width: 22px;"></i>
																				</span>
																		</div>
																</div>
																<div id="website-visitors" class="apex-charts"></div>
														</div>
												</div>
										</div>

										<div class="col-md-6 col-xl-3">
												<div class="card">
														<div class="card-body">
																<div class="d-flex align-items-center">
																		<div class="fs-14 mb-1">Buyurtmalar</div>
																</div>

																<div class="d-flex align-items-baseline mb-2">
																		<div class="fs-22 mb-0 me-2 fw-semibold text-black">0</div>
																		<div class="me-auto">
																				<span class="text-danger d-inline-flex align-items-center">
																						10%
																						<i data-feather="trending-down" class="ms-1" style="height: 22px; width: 22px;"></i>
																				</span>
																		</div>
																</div>
																<div id="conversion-visitors" class="apex-charts"></div>
														</div>
												</div>
										</div>

										<div class="col-md-6 col-xl-3">
												<div class="card">
														<div class="card-body">
																<div class="d-flex align-items-center">
																		<div class="fs-14 mb-1">Jami mijozlar</div>
																</div>

																<div class="d-flex align-items-baseline mb-2">
																		<div class="fs-22 mb-0 me-2 fw-semibold text-black">0 </div>
																		<div class="me-auto">
																				<span class="text-success d-inline-flex align-items-center">
																						25%
																						<i data-feather="trending-up" class="ms-1" style="height: 22px; width: 22px;"></i>
																				</span>
																		</div>
																</div>
																<div id="session-visitors" class="apex-charts"></div>
														</div>
												</div>
										</div>

										<div class="col-md-6 col-xl-3">
												<div class="card">
														<div class="card-body">
																<div class="d-flex align-items-center">
																		<div class="fs-14 mb-1">Aktiv mijozlar</div>
																</div>

																<div class="d-flex align-items-baseline mb-2">
																		<div class="fs-22 mb-0 me-2 fw-semibold text-black">0</div>
																		<div class="me-auto">
																				<span class="text-success d-inline-flex align-items-center">
																						4%
																						<i data-feather="trending-up" class="ms-1" style="height: 22px; width: 22px;"></i>
																				</span>
																		</div>
																</div>
																<div id="active-users" class="apex-charts"></div>
														</div>
												</div>
										</div>
								</div>
						</div> <!-- end sales -->
				</div> <!-- end row -->


		</div> <!-- container-fluid -->
	</div> 
@endsection


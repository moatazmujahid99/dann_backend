@extends('admin.admin_master')
@section('admin')

<div class="page-wrapper">
			<div class="page-content">

					<div class="row row-cols-1 row-cols-md-2 row-cols-xl-4">
						<div class="col">
							<div class="card radius-10 bg-gradient-deepblue">
							 <div class="card-body">
								<div class="d-flex align-items-center">
									<h5 class="mb-0 text-white">0</h5>
									<div class="ms-auto">
                                        <i class='bx bx-cart fs-3 text-white'></i>
									</div>
								</div>
								<div class="progress my-3 bg-light-transparent" style="height:3px;">
									<div class="progress-bar bg-white" role="progressbar" style="width: 3%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
								</div>
								<div class="d-flex align-items-center text-white">
									<p class="mb-0">Total Orders</p>
									<p class="mb-0 ms-auto">+0.0%<span><i class='bx bx-up-arrow-alt'></i></span></p>
								</div>
							</div>
						  </div>
						</div>
						<div class="col">
							<div class="card radius-10 bg-gradient-orange">
							<div class="card-body">
								<div class="d-flex align-items-center">
									<h5 class="mb-0 text-white">0.0 EGP </h5>
									<div class="ms-auto">
                                        <i class='bx bx-money fs-3 text-white'></i>
									</div>
								</div>
								<div class="progress my-3 bg-light-transparent" style="height:3px;">
									<div class="progress-bar bg-white" role="progressbar" style="width: 3%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
								</div>
								<div class="d-flex align-items-center text-white">
									<p class="mb-0">Total Revenue</p>
									<p class="mb-0 ms-auto">+0.0%<span><i class='bx bx-up-arrow-alt'></i></span></p>
								</div>
							</div>
						  </div>
						</div>
						<div class="col">
							<div class="card radius-10 bg-gradient-ohhappiness">
							<div class="card-body">
								<div class="d-flex align-items-center">
									<h5 class="mb-0 text-white">0</h5>
									<div class="ms-auto">
                                        <i class='bx bx-group fs-3 text-white'></i>
									</div>
								</div>
								<div class="progress my-3 bg-light-transparent" style="height:3px;">
									<div class="progress-bar bg-white" role="progressbar" style="width: 3%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
								</div>
								<div class="d-flex align-items-center text-white">
									<p class="mb-0">Customers</p>
									<p class="mb-0 ms-auto">+0.0%<span><i class='bx bx-up-arrow-alt'></i></span></p>
								</div>
							</div>
						</div>
						</div>
						<div class="col">
							<div class="card radius-10 bg-gradient-ibiza">
							 <div class="card-body">
								<div class="d-flex align-items-center">
									<h5 class="mb-0 text-white">0</h5>
									<div class="ms-auto">
                                        <i class='bx bx-envelope fs-3 text-white'></i>
									</div>
								</div>
								<div class="progress my-3 bg-light-transparent" style="height:3px;">
									<div class="progress-bar bg-white" role="progressbar" style="width: 3%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
								</div>
								<div class="d-flex align-items-center text-white">
									<p class="mb-0">Messages</p>
									<p class="mb-0 ms-auto">+0.0%<span><i class='bx bx-up-arrow-alt'></i></span></p>
								</div>
							</div>
						 </div>
						</div>
					</div><!--end row-->



{{-- Analytics - 2 --}}

<div class="row row-cols-1 row-cols-lg-2 row-cols-xl-3">
    <div class="col">
        <div class="card radius-10">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div>
                        <p class="mb-0 text-secondary">Net Sales</p>
                        <h4 class="my-1">0.0 EGP</h4>
                        <p class="mb-0 font-13 text-primary"><i class='bx bxs-up-arrow align-middle'></i>0 EGP Since last week</p>
                    </div>
                    <div class="widgets-icons bg-light-success text-primary ms-auto"><i class='bx bxs-wallet'></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col">
        <div class="card radius-10">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div>
                        <p class="mb-0 text-secondary">Page Followers</p>
                        <h4 class="my-1">0</h4>
                        <p class="mb-0 font-13 text-primary"><i class='bx bxs-up-arrow align-middle'></i>0% Since last week</p>
                    </div>
                    <div class="widgets-icons bg-light-warning text-primary ms-auto"><i class='bx bxs-group'></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="card radius-10">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div>
                        <p class="mb-0 text-secondary">Produt Reviews</p>
                        <h4 class="my-1">0</h4>
                        <p class="mb-0 font-13 text-primary"><i class='bx bxs-up-arrow align-middle'></i>0% Since last week</p>
                    </div>
                    <div class="widgets-icons bg-light-danger text-primary ms-auto"><i class='bx bxs-comment-detail'></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--end row-->






					  <div class="card radius-10">
						<div class="card-body">
							<div class="d-flex align-items-center">
								<div>
									<h5 class="mb-0">Order Summary</h5>
								</div>
								<div class="font-22 ms-auto"><i class="bx bx-dots-horizontal-rounded"></i>
								</div>
							</div>
							<hr>
							<div class="table-responsive">
<table class="table align-middle mb-0">
<thead class="table-light">
	<tr>
		<th>Order id</th>
		<th>Product</th>
		<th>Customer</th>
		<th>Date</th>
		<th>Price</th>
		<th>Status</th>
		<th>Action</th>
	</tr>
</thead>
<tbody>
	<tr>
		<td>#00001</td>
		<td>
			<div class="d-flex align-items-center">
				<div class="recent-product-img">
					<img src="{{ asset('backend/assets/images/icons/chair.png') }}" alt="">
				</div>
				<div class="ms-2">
					<h6 class="mb-1 font-14">Light Blue Chair</h6>
				</div>
			</div>
		</td>
		<td>Ali Mohamed</td>
		<td>12 June 2022</td>
		<td>EGP 64.00</td>
		<td>
			<div class="badge rounded-pill bg-light-info text-info w-100">In Progress</div>
		</td>
		<td>
			<div class="d-flex order-actions">	<a href="javascript:;" class=""><i class="bx bx-cog"></i></a>
				<a href="javascript:;" class="ms-4"><i class="bx bx-down-arrow-alt"></i></a>
			</div>
		</td>
	</tr>
	<tr>
		<td>#00002</td>
		<td>
			<div class="d-flex align-items-center">
				<div class="recent-product-img">
					<img src="{{ asset('backend/assets/images/icons/shoes.png') }}" alt="">
				</div>
				<div class="ms-2">
					<h6 class="mb-1 font-14">Green Sport Shoes</h6>
				</div>
			</div>
		</td>
		<td>Mohamed Elsayed</td>
		<td>14 June 2022</td>
		<td>EGP 45.00</td>
		<td>
			<div class="badge rounded-pill bg-light-success text-success w-100">Completed</div>
		</td>
		<td>
			<div class="d-flex order-actions">	<a href="javascript:;" class=""><i class="bx bx-cog"></i></a>
				<a href="javascript:;" class="ms-4"><i class="bx bx-down-arrow-alt"></i></a>
			</div>
		</td>
	</tr>
	<tr>
		<td>#00003</td>
		<td>
			<div class="d-flex align-items-center">
				<div class="recent-product-img">
					<img src="{{ asset('backend/assets/images/icons/headphones.png') }}" alt="">
				</div>
				<div class="ms-2">
					<h6 class="mb-1 font-14">Red Headphone 07</h6>
				</div>
			</div>
		</td>
		<td>Salma Ibrahim</td>
		<td>15 June 2022</td>
		<td>EGP 67.00</td>
		<td>
			<div class="badge rounded-pill bg-light-danger text-danger w-100">Cancelled</div>
		</td>
		<td>
			<div class="d-flex order-actions">	<a href="javascript:;" class=""><i class="bx bx-cog"></i></a>
				<a href="javascript:;" class="ms-4"><i class="bx bx-down-arrow-alt"></i></a>
			</div>
		</td>
	</tr>
	<tr>
		<td>#00004</td>
		<td>
			<div class="d-flex align-items-center">
				<div class="recent-product-img">
					<img src="{{ asset('backend/assets/images/icons/idea.png') }}" alt="">
				</div>
				<div class="ms-2">
					<h6 class="mb-1 font-14">Mini Laptop Device</h6>
				</div>
			</div>
		</td>
		<td>Omar Samir</td>
		<td>18 June 2022</td>
		<td>EGP 87.00</td>
		<td>
			<div class="badge rounded-pill bg-light-success text-success w-100">Completed</div>
		</td>
		<td>
			<div class="d-flex order-actions">	<a href="javascript:;" class=""><i class="bx bx-cog"></i></a>
				<a href="javascript:;" class="ms-4"><i class="bx bx-down-arrow-alt"></i></a>
			</div>
		</td>
	</tr>
	<tr>
		<td>#00005</td>
		<td>
			<div class="d-flex align-items-center">
				<div class="recent-product-img">
					<img src="{{ asset('backend/assets/images/icons/user-interface.png') }}" alt="">
				</div>
				<div class="ms-2">
					<h6 class="mb-1 font-14">Purple Mobile Phone</h6>
				</div>
			</div>
		</td>
		<td>Shadi Kamal</td>
		<td>20 June 2022</td>
		<td>EGP 75.00</td>
		<td>
			<div class="badge rounded-pill bg-light-info text-info w-100">In Progress</div>
		</td>
		<td>
			<div class="d-flex order-actions">	<a href="javascript:;" class=""><i class="bx bx-cog"></i></a>
				<a href="javascript:;" class="ms-4"><i class="bx bx-down-arrow-alt"></i></a>
			</div>
		</td>
	</tr>
	<tr>
		<td>#00006</td>
		<td>
			<div class="d-flex align-items-center">
				<div class="recent-product-img">
					<img src="{{ asset('backend/assets/images/icons/watch.png') }}" alt="">
				</div>
				<div class="ms-2">
					<h6 class="mb-1 font-14">Smart Hand Watch</h6>
				</div>
			</div>
		</td>
		<td>Assem Gamal</td>
		<td>22 June 2022</td>
		<td>EGP 80.00</td>
		<td>
			<div class="badge rounded-pill bg-light-danger text-danger w-100">Cancelled</div>
		</td>
		<td>
			<div class="d-flex order-actions">	<a href="javascript:;" class=""><i class="bx bx-cog"></i></a>
				<a href="javascript:;" class="ms-4"><i class="bx bx-down-arrow-alt"></i></a>
			</div>
		</td>
	</tr>

									</tbody>
								</table>
							</div>
						</div>
					</div>

			</div>
		</div>


@endsection


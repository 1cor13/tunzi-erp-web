@php( $page_name = 'No Content' )
<!-- Page Header -->
<div class="page-header">
	<div class="row">
		<div class="col-sm-12">
			<h3 class="page-title">{{ $page_name }}</h3>
			<ul class="breadcrumb">
				<li class="breadcrumb-item">
					<a href="{{ route('home') }}">
						<i class="la la-home"></i> Home
					</a>
				</li>
				<li class="breadcrumb-item active">{{ $page_name }}</li>
			</ul>
		</div>
	</div>
</div>
<!-- /Page Header -->

<!-- Content Starts -->
This page has no content
<!-- /Content End -->
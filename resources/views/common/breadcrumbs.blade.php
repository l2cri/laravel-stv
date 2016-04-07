@if ($breadcrumbs)
	<div class="breadcrumb-box">
		@foreach ($breadcrumbs as $breadcrumb)
			@if ($breadcrumb->url && !$breadcrumb->last)
				<a href="{{{ $breadcrumb->url }}}">{{{ $breadcrumb->title }}}</a>
			@else
				<span class="active">{{{ $breadcrumb->title }}}</span>
			@endif
		@endforeach
	</div>
@endif

<div id="companyList">
    @if($isLoading)
        <h1 class="p-12 text-center">{{ __('Lading...') }}</h1>
    @endif

    @if(!$isLoading)
        <div class="flex flex-col gap-3">
            @foreach($companies as $company)
                <x-company.card :company="$company"/>
            @endforeach
        </div>
        <div class="py-4">
            {{ $companies->links() }}
        </div>
    @endif

</div>

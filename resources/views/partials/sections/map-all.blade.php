<style>
    #map-all {
        width: 100%;
        height: 400px;
    }
</style>
<h2 class="text-center">Автосервисы в Одинцово на карте <span class="lead text-muted">({{ $catalog->count() }}) автосервиса</span></h2>
@include('partials.map-all', ['catalog' => $catalog])
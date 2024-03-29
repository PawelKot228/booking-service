import './bootstrap';

import Alpine from 'alpinejs';
import focus from '@alpinejs/focus';
import {Loader} from "@googlemaps/js-api-loader"
import dayjs from "dayjs";
import 'flowbite';
import 'boxicons';

window.Alpine = Alpine;
window.dayjs = dayjs;

Alpine.plugin(focus);
Alpine.start();

const loader = new Loader({
    apiKey: import.meta.env.VITE_GOOGLE_MAPS_KEY,
    version: "weekly",
    libraries: ["places"],
});

const googleMapsPlaceInput = document.getElementById("search-place-input");
if (googleMapsPlaceInput) {
    loader.load()
        .then(async (google) => {
            let autocomplete = new google.maps.places.Autocomplete(googleMapsPlaceInput, {
                fields: ["place_id", "geometry", "formatted_address", "name"],
            })

            google.maps.event.addListener(autocomplete, 'place_changed', function () {
                const place = autocomplete.getPlace();

                googleMapsPlaceInput.dataset.place_id = place.place_id;
                googleMapsPlaceInput.dataset.lat = place.geometry.location.lat();
                googleMapsPlaceInput.dataset.lng = place.geometry.location.lng();

                let store = Alpine.store('companySearchForm') ?? {};

                store.place_id = place?.place_id
                store.lat = place.geometry.location.lat()
                store.lng = place.geometry.location.lng()

                Alpine.store('companySearchForm', store)

                let select = document.querySelector('#sortBySelect option[value="distance"]');
                select.disabled = false;
            });
        });
}


function fireLivewireCompanySearch() {
    let store = Alpine.store('companySearchForm') ?? {};

    let selectSort = document.getElementById('sortBySelect');

    store.sortBy = selectSort.value;

    console.log(selectSort.value)

    Livewire.emit('companyListRefresh', Alpine.store('companySearchForm') ?? {})
}

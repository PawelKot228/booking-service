import './bootstrap';

import Alpine from 'alpinejs';
import focus from '@alpinejs/focus';
import {Loader} from "@googlemaps/js-api-loader"
import 'flowbite';

window.Alpine = Alpine;

Alpine.plugin(focus);

Alpine.start();

const loader = new Loader({
    apiKey: import.meta.env.VITE_GOOGLE_MAPS_KEY,
    version: "weekly",
    libraries: ["places"],
});

loader.load()
    .then(async (google) => {
        let input = document.getElementById("search-place-input");
        let autocomplete = new google.maps.places.Autocomplete(input, {
            fields: ["place_id", "geometry", "formatted_address", "name"],
        })


        google.maps.event.addListener(autocomplete, 'place_changed', function () {
            const place = autocomplete.getPlace();

            input.dataset.place_id = place.place_id;
            input.dataset.lat = place.geometry.location.lat();
            input.dataset.lng = place.geometry.location.lng();

            let store = Alpine.store('companySearchForm')

            store.place_id = place.place_id
            store.lat = place.geometry.location.lat()
            store.lng = place.geometry.location.lng()

            Alpine.store('companySearchForm', store)
        });


    });

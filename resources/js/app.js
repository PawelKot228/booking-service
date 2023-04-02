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

    });


window.searchCompanyForm = function () {
    return {

        latitude: null,
        longitude: null,
        categories: [],
        subcategories: [],
        updateCoordinates() {

        },
        updateCategories() {

        },
        init() {

        }
    }
}

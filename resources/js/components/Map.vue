<template>
    <div>
        <label>Location</label>
        <gmap-autocomplete @place_changed="setPlace" class="form-control"></gmap-autocomplete>
        <gmap-map
            :center="location"
            :zoom="12"
            style="width: 500px; height: 300px"
        >
            <gmap-marker
                :position="location"
                :clickable="true"
                :draggable="true"
                @click="center=location"
                @place_changed="setPlace"
                @position_changed="markerDrag($event)"
            ></gmap-marker>
        </gmap-map>

        <input type="hidden" v-model="location.lat" name="lat">
        <input type="hidden" v-model="location.lng" name="lng">
    </div>
</template>

<script>
    import * as VueGoogleMaps from 'vue2-google-maps';
    import Vue from 'vue';

    Vue.use(VueGoogleMaps, {
        load: {
            key: 'AIzaSyCcAtFZoLdbP1iUlJ6R3uCfV_hsDWsLkTo',
            libraries: 'places' //// If you need to use place input
        }
    });

    export default {
        data () {
            return {
                location: {
                    lat: -26.2023,
                    lng: 28.0436
                },
                markers: [{
                    position: {lat: 10.0, lng: 10.0}
                }]
            }
        },
        mounted() {
            console.log('Component mounted.')
        },
        methods: {
            setPlace (place) {
                this.location = {
                    lat: place.geometry.location.lat(),
                    lng: place.geometry.location.lng()
                }
            },
            markerDrag(position) {
                this.location = {
                    lat: position.lat(),
                    lng: position.lng()
                }
            }
        }
    }
</script>

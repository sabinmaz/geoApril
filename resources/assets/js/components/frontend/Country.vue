<template>
   <div class="box-container">
       <div class="row">
           <div class="col-md-4">
               <ucard header="Provinces">
                   <template slot="content">
                       <div class="row">
                           <div class="col-md-12">
                               <input id='search' v-model="filter" :placeholder="$lang.messages['Search']" class="form-control">
                           </div>

                       </div>
                       <div class="row">
                        <div class="col-md-12">
                            <utable id="province-table"
                                    class=" "
                                    :fields="fields"
                                    :items="province"
                                    :filter="filter"

                                    :per-page="perPage"
                                    :current-page="currentPage">
                                <template slot="name" scope="item">
                                    <a v-bind:href="'/#/'+$route.params.country+'/' +item.item.name" >{{item.item.name}}</a>
                                </template>

                            </utable>
                        </div>
                       </div>
                       <div class="row">
                           <div class="col-md-12">
                               <upagination size="md"  :total-rows="this.province.length"
                                            :per-page="perPage"
                                            v-model="currentPage"></upagination>
                           </div>
                       </div>
                   </template>
               </ucard>
           </div>
           <div class="col-md-8">
               <div class="row">
                   <div class="col-md-6">
                       <div class="pull-left">
                           <div class="box">
                               <h3 class="text-center">{{this.country.iso2}}</h3>
                               <p class="text-uppercase">
                                   <slot v-if="$lang.messages['iso2']">{{$lang.messages['iso2']}}</slot>
                                   <slot v-else>iso2</slot>
                               </p>
                           </div>
                           <div class="box">
                               <h3 class="text-center">{{this.country.iso3}}</h3>
                               <p class="text-uppercase">
                                   <slot v-if="$lang.messages['iso3']">{{$lang.messages['iso3']}}</slot>
                                   <slot v-else>iso3</slot>
                               </p>
                           </div>
                       </div>
                       <div class="pull-left">
                           <div class="box">
                               <h3 class="text-center">{{this.country.country_code}}</h3>
                               <p class="text-uppercase">
                                   <slot v-if="$lang.messages['Dail Code']">{{$lang.messages['Dail Code']}}</slot>
                                   <slot v-else>Dail Code</slot>
                               </p>
                           </div>
                           <div class="box">
                               <h3 class="text-center">{{this.country.currency}}</h3>
                               <p class="text-uppercase">
                                   <slot v-if="$lang.messages['Currency']">{{$lang.messages['Currency']}}</slot>
                                   <slot v-else>Currency</slot>
                               </p>
                           </div>
                       </div>
                       <div class="pull-left">
                           <div class="box">
                               <h3 class="text-center">{{this.country.latitude}}</h3>
                               <p class="text-uppercase">
                                   <slot v-if="$lang.messages['Latitude']">{{$lang.messages['Latitude']}}</slot>
                                   <slot v-else>Latitude</slot>
                               </p>
                           </div>
                           <div class="box">
                               <h3 class="text-center">{{this.country.longitude}}</h3>
                               <p class="text-uppercase">
                                   <slot v-if="$lang.messages['Longitude']">{{$lang.messages['Longitude']}}</slot>
                                   <slot v-else>Longitude</slot>
                               </p>
                           </div>
                       </div>
                   </div>
                   <div class="col-md-6">

                       <div class="input-group from-group">
                           <span class="input-group-addon">
                               <slot v-if="$lang.messages['Capital']">{{$lang.messages['Capital']}}</slot>
                                   <slot v-else>Capital</slot>
                           </span>
                           <label class="form-control">{{this.country.capital}}</label>
                       </div>
                       <div class="input-group from-group">
                           <span class="input-group-addon">
                                 <slot v-if="$lang.messages['Area']">{{$lang.messages['Area']}}</slot>
                                   <slot v-else>Area</slot>
                           </span>
                           <label class="form-control text-right">{{this.country.area}}</label>
                           <span class="input-group-addon right-addon"> KM<sup>2</sup></span>
                       </div>
                       <div class="input-group from-group">
                           <span class="input-group-addon">
                                 <slot v-if="$lang.messages['Population']">{{$lang.messages['Population']}}</slot>
                                   <slot v-else>Population</slot>
                           </span>
                           <label class="form-control text-right">{{this.country.population}}</label>
                           <span class="input-group-addon right-addon"> Million</span>
                       </div>
                       <div class="input-group from-group">
                           <span class="input-group-addon">
                               <slot v-if="$lang.messages['GDP']">{{$lang.messages['GDP']}}</slot>
                                   <slot v-else>GDP</slot></span>
                           <label class="form-control text-right">{{this.country.gdp}}</label>
                           <span class="input-group-addon right-addon">USD</span>
                       </div>



                   </div>
               </div>
               <div class="row">
                   <div class="col-md-12 box-container">
                       <google-map
                               :center="center"
                               :zoom="8"
                               map-type-id="roadmap"
                               style="width: 100%; height: 400px"
                               :marker="markers"


                       >

                       </google-map>

                   </div>
               </div>
           </div>



       </div>


   </div>
</template>
<script>
    import utable from '../materials/table.vue';
    import upagination from '../materials/pagination.vue';
    import ucard from '../materials/card.vue';
    import {load, Map} from 'vue-google-maps';


    export default{
        components:{utable,upagination,ucard,'googleMap': Map},
        data()
        {
            return {
                country: {},
                province: [],
                center: {lat: 0, lng: 0},
                lat: '',
                lng: '',
                markers: [],
                fields: {
                    name: {label: 'Province', sortable: true},
                },
                currentPage: 1,
                perPage: 10,
                filter: null,


            }
        },

        created() {
            //  console.log( )); // outputs 'yay'

            var self = this;
            axios.get('/api/'+this.$route.params.country)
                .then(function (response)
                {
                    self.country=response.data;
                    // console.log(response);
                   console.log(self.country);
                    var center=new google.maps.LatLng(self.country.latitude, self.country.longitude);
                    self.center={lat: Number(self.country.latitude), lng: Number(self.country.longitude)};
                    self.markers=[{position: {lat: self.country.latitude ,lng: self.country.longitude}}];
                    console.log(self.center);
                    axios.get('/api/'+self.country.iso2+'/provinces')
                        .then(function(response)
                        {
                            //console.log(_.toArray(response.data));
                            self.province=_.toArray(response.data);
                            // console.log(_.toArray(response.data));
                        }) .catch(function(error)
                    {
                        console.log(error);
                    });
                })
                .catch(function(error)
                {
                    console.log(error);
                })



            //console.log(this.$route.params.country);
        }
    }
</script>
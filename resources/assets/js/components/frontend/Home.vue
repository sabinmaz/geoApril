<template>
   <div class="box-container">
       <div class="row">
           <div class="col-md-4">
               <ucard header="Countries" class="mb-2">
                   <template slot="content">
                    <div class="row">
                        <input id='search' v-model="filter" :placeholder="$lang.messages['Search']" class="form-control">
                    </div>
                   <div class="row">
                       <div class="col-md-12">
                           <utable id="country-table"
                                   class=" "
                                   :fields="fields"
                                   :items="countries"
                                   :filter="filter"

                                   :per-page="perPage"
                                   :current-page="currentPage">
                               <template slot="country_name" scope="item">
                                   <a v-bind:href="'/#/' +item.item.country_name" >{{item.item.country_name}}</a>
                               </template>

                           </utable>
                       </div>
                           <div class="col-md-12">
                               <upagination size="md"  :total-rows="this.countries.length"
                                            :per-page="perPage"
                                            v-model="currentPage"></upagination>
                           </div>

                   </div>
                   </template>
               </ucard>
           </div>
           <div class="col-md-8">
               <google-map
                       :center="{lat:0 ,lng:0}"
                       :zoom="1"
                       map-type-id="terrain"
                       style="width: 100%; height: 500px"
                       scrollwheel: false

               >

               </google-map>
              <!--<div class="embed-container">-->
                  <!--<iframe-->
                          <!--width="100%"-->
                          <!--height="600"-->
                          <!--frameborder="0"-->
                          <!--scrolling="no"-->
                          <!--marginheight="0"-->
                          <!--marginwidth="0"-->
                          <!--title="CountryMap"-->
                          <!--src="//www.arcgis.com/apps/Embed/index.html?webmap=b834a68d7a484c5fb473d4ba90d35e71&amp;extent=20.3858,37.8096,24.104,38.082&amp;zoom=true&amp;scale=true&amp;disable_scroll=true&amp;theme=light&amp;marker=30;-3.5;;;;"></iframe>-->
              <!--</div>-->

           </div>
       </div>

   </div>

</template>

<script>
  import utable from '../materials/table.vue';
  import upagination from '../materials/pagination.vue';
  import ucard from '../materials/card.vue';
  import {load, Map} from 'vue-google-maps'

  load({
      key: 'AIzaSyBzlLYISGjL_ovJwAehh6ydhB56fCCpPQw',
      v: '3.26',
      libraries:'places'
  })


  //import mp from 'http://www.openlayers.org/api/OpenLayers.js';
    export default {
        components: {utable,upagination,ucard,'googleMap': Map},
        data()
        {
            return{
                filter:null,
                countries:[],
                fields: {
                    country_name: {label: 'Country', sortable: true},
                    iso2: {label: 'ISO2', sortable: true},
                    iso3: {label: 'ISO3', sortable: true}
                },
                currentPage: 1,
                perPage: 10,
                center: { lat: 48.8538302, lng: 2.2982161 }
            }
        },
       created()
            {

                var self=this;
                axios.get('/api/countries-min')
                    .then(function (response)
                    {
                        self.countries=response.data;
                        // console.log(response);
                         // console.log(self.countries);
                    })
                    .catch(function(error)
                    {
                        console.log(error);
                    })



            }
    }
</script>

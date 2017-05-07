<template>
    <div class="box-container">
        <div class="row">
            <div class="col-md-4">
                <ucard header="Communies">
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
                                        :items="communies"
                                        :filter="filter"

                                        :per-page="perPage"
                                        :current-page="currentPage">
                                    <template slot="name" scope="item">
                                        <a v-bind:href="'/#/'+$route.params.country+'/'+$route.params.province+'/' +item.item.name" >{{item.item.name}}</a>
                                    </template>

                                </utable>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <upagination size="md"  :total-rows="this.communies.length"
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

                        <div class="input-group from-group">
                            <span class="input-group-addon">
                                <slot v-if="this.$lang.messages['Latitude']">{{this.$lang.messages['Latitude']}}</slot>
                                <slot v-else>Latitude</slot>
                            </span>
                            <label class="form-control text-right">{{this.lat}}</label>
                        </div>
                        <div class="input-group from-group">
                             <span class="input-group-addon">
                                <slot v-if="this.$lang.messages['Logitude']">{{this.$lang.messages['Longitude']}}</slot>
                                <slot v-else>Longitude</slot>
                            </span>
                            <label class="form-control text-right">{{this.lng}}</label>
                        </div>
                        <div class="col-md-12 box-container">
                            <google-map
                                    :center="center"
                                    :zoom="10"
                                    map-type-id="roadmap"
                                    style="width: 100%; height: 400px"
                                    :viewport="viewport"



                            >
                                <!--<google-marker-->
                                        <!--v-for="m in markers"-->
                                        <!--:position="m.position"-->
                                        <!--:clickable="true"-->
                                        <!--:draggable="true"-->
                                        <!--@click="center=m.position"-->
                                <!--&gt;</google-marker>-->
                            </google-map>

                        </div>
                    </div>
                    <div class="col-md-6">

                        <ucard header="SDF">
                            <template slot="content">

                                <div class="row">
                                    <div class="col-md-12">
                                        <utable id="sdf-table"
                                                class=" "
                                                :fields="sdf_fields"
                                                :items="sdf"
                                                :filter="filter"

                                                :per-page="perPage"
                                                :current-page="currentPage">
                                            <template slot="name" scope="item">
                                                {{item.item.name}}
                                            </template>

                                        </utable>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <upagination size="md"  :total-rows="this.sdf.length"
                                                     :per-page="perPage"
                                                     v-model="currentPage"></upagination>
                                    </div>
                                </div>
                            </template>
                        </ucard>
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
        components:{utable,upagination,ucard,'googleMap':Map},
        data()
        {
            return {
                country: {},
                province: {},
                communies:[],
                sdf:[],
                center: {lat: 0, lng: 0},
                viewport:{},

                lat: '',
                lng: '',
                markers: [],
                fields: {
                    name: {label: 'Commune', sortable: true},

                },
                sdf_fields: {
                    list: {label: 'SDF', sortable: true},
                    listnumber: {label: 'Value', sortable: true},

                },
                currentPage: 1,
                perPage: 10,
                filter: null,


            }
        },

        created() {
            //  console.log( )); // outputs 'yay'

            var self = this;
           // this.country=this.$route.params.country;
            axios.get('/api/'+this.$route.params.country)
                .then(function (response)
                {
                    self.country=response.data;

                    axios.get('/api/'+self.country.iso2+'/'+self.$route.params.province+'/communies')
                        .then(function(response)
                        {
                            console.log(self.country);
                            //console.log(_.toArray(response.data));
                            self.communies=_.toArray(response.data);
                            //console.log(_.toArray(response.data));
                        }) .catch(function(error)
                    {
                        console.log(error);
                    });
                    axios.get('https://cap-bi.umva.org/index.php?option=com_api&task=execute&anyparam=demo-network')
                        .then(function(response)
                        {
                            //console.log('sggsdaf');
                           // console.log(response.data.data);
                            ////console.log(_.toArray(response.data));
                           // self.sdf=_.toArray(response.data.data);
                            //console.log(_.toArray(response.data));
                        }) .catch(function(error)
                    {
                        console.log(error);
                    });
//                    axios.get('/api/sdf/'+self.$route.params.province)
//                        .then(function(response)
//                        {
//                           // console.log(self.country);
//                            //console.log(_.toArray(response.data));
                           self.sdf=_.toArray(response.data);
//                            //console.log(_.toArray(response.data));
//                        }) .catch(function(error)
//                    {
//                        console.log(error);
//                    });

                    axios.get('https://maps.googleapis.com/maps/api/geocode/json?address='+self.$route.params.province+',+'+self.country.country_name+'&key=AIzaSyBzlLYISGjL_ovJwAehh6ydhB56fCCpPQw')
                        .then(function (response)
                    {
                        self.lat=response.data.results[0].geometry.location.lat;
                        self.lng=response.data.results[0].geometry.location.lng;
                        self.center={lat: Number(self.lat), lng: Number(self.lng)};
                        //self.viewport=response.data.results[0].geometry.viewport;

                        self.markers= self.markers=[{position: response.data.results[0].geometry.location}];;
                       // console.log(response.data.results[0]);
                       // console.log(resonse)
                    }).catch(function(error)
                    {
                      console.log(error);
                    })
                })
                .catch(function(error)
                {
                    console.log(error);
                })
//            axios.get('/api/'+this.$route.params.country/+this.$route.params.province)
//                .then(function (response)
//                {
//                    self.country=response.data;
//                    // console.log(response);
//                    // console.log(self.countries);
//                })
//                .catch(function(error)
//                {
//                    console.log(error);
//                })


            //console.log(this.$route.params.country);
        }
    }
</script>
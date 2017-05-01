<template>
   <div class="container">
       <div class="row">
           <div class="col-md-4">
               <div class="row">
                  <div class="col-md-12">
                     <label for="search">{{$lang.messages['Country']}}</label> <input id='search' v-model="filter" :placeholder="$lang.messages['Date']"></div>
               </div>
               <div class="row">
                   <div class="col-md-12">
                       <utable id="country-table"
                               class="table-hover "
                               :fields="fields"
                               :items="countries"
                               :filter="filter"

                       :per-page="perPage"
                               :current-page="currentPage">
                           <template slot="country_name" scope="item">
                               <a v-bind:href="'/' +item.item.country_name" >{{item.item.country_name}}</a>
                           </template>

                       </utable>
                   </div>
                   <div class="col-md-12">
                        <upagination size="md"  :total-rows="this.countries.length"
                                     :per-page="perPage"
                                     v-model="currentPage"></upagination>
                   </div>
               </div>
           </div>

       </div>
   </div>

</template>

<script>
  import utable from './materials/table.vue';
  import upagination from './materials/pagination.vue';
    export default {
        components: {utable,upagination},
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

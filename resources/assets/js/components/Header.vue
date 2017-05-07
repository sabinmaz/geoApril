<template>
  <div class="header">
    <div class="container">
      <div class="row">

        <div class="col-md-12">

          <img src="/images/geo-logo.png" width="80px" class="pull-left" style="margin:5px" />
          <p class="logo">UMVA GEO
                        <span style="font-size:18px;">
                          {{$route.params['country']}}
            <!--<?php  $route = Route::current();-->
                                <!--if( array_key_exists('country',$route->parameters))-->
                                    <!--{-->
                                        <!--echo ' - '.$route->parameters['country'];-->
                                    <!--}-->
                            <!--?>-->

                            </span>
          </p>
        </div>



      </div> <!-- closes .row -->
    </div> <!-- closes .container-fluid -->
    <div class="breadcrumb-container">
      <div class="container">
        <div class="row">
          <div class="col-md-8">
            <ol class="breadcrumb">
              <router-link tag="li" to="/" exact><a class="text-uppercase"><span class="glyphicon glyphicon-home"></span></a></router-link>
              <router-link tag="li" v-for="(param,index) in $route.params" :key="index" :to="{name: index}">
               <a class="text-uppercase">{{param}}</a>
              </router-link>
             <!--<router-link tag="li" to='/' exact><a>Home</a></router-link>-->
              <!--{{path=''}}-->
                <!--<router-link tag="li"  v-for="param in $route.params" :to="{path: path=path+'/'+param}" ><a>{{param}}</a></router-link>-->


            </ol>
          </div>
          <div class="col-md-4">
            <form class="form-horizontal pull-right">
              <div class="form-inline">
                <label class="control-label label-white">{{this.$lang.messages['Language']}} :</label>
                <select v-on:change="changeLang()" v-model="language" class="form-control btn btn-primary">
                  <option value="en">English</option>
                  <option value="fr">French</option>
                  <option value="nl">Dutch</option>
                  <option value="es">Spanish</option>
                  <option value="np">Nepali</option>
                  <option value="rn">Kirundi</option>
                </select>
              </div>
            </form>

          </div>
        </div>



      </div>
    </div> <!-- closes .country-title -->
  </div> <!-- closes .header -->

</template>

<script>

    export default {

        data()
            {
                return{
                   language:'en',
                    path:'',
                    filter:null
                }
            },
        created() {
           // this.$lang.setLang('fr');
             console.log(this.$lang.getLang());
        },
        methods:
            {
                changeLang()
                {
                    this.$lang.setLang(this.language);


                }
            }
    }
</script>

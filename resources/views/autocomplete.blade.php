<!DOCTYPE html>
<html>
<head>
    <title>Autocomplete Vue js using Laravel</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" >
    <script src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.5.16/vue.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.18.0/axios.min.js"></script>
   
</head>
<body>


<div class="container" id="app">
    <div class="row">
        <div class="col-sm-8">
            <h1>Autocomplete Vue js using Laravel</h1>
            <div class="panel panel-default">
				<div class="panel-body">
         
           
                <div class="panel-heading">Please Enter for Search</div>
                <div class="panel-body">
                    <autocomplete></autocomplete>
                </div>
            </div>
        
    </div>
</div>


<script type="text/javascript">
    Vue.component('autocomplete', {
      template: '<div><input type="text" placeholder="what are you looking for?" v-model="searchquery" v-on:keyup="autoComplete" class="form-control"><div class="panel-footer" v-if="data_results.length"><ul class="list-group"><li class="list-group-item" v-for="result in data_results">@{{ result.name }}</li></ul></div></div>',
      data: function () {
        return {
          searchquery: '',
          data_results: []
        }
      },
      methods: {
        autoComplete(){
        this.data_results = [];
        if(this.searchquery.length > 2){
         axios.get('/index.php/searchajax',{params: {searchquery: this.searchquery}}).then(response => {
            console.log(response);
          this.data_results = response.data;
         });
        }
       }
      },
    })


    const app = new Vue({
        el: '#app'
    });
</script>


</body>
</html>

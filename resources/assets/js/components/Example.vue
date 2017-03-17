<template>
    <div>
        <button v-click="test">test</button>
    </div>
</template>

<script>
    export default {
        data(){
            return{
                token :''
            }
        },
        mounted() {
            _this = this;
            axios.post('/oauth/token',{
                grant_type :'password',
                client_id :'1',
                client_secret: 'YCOdGX2LpaygGqmO19VTedP3JrJXI8kSSZMhaYEG',
                username :'syd_8906@126.com',
                password:'123456',
                scope : ''
            }).then(function (response) {
                _this.token = response.data.access_token;
                console.log(response);
            }).catch(function (error) {
                console.log(error);
            })
        },
        methods:{
            test(){
                axios.get('')
            }
        }
    }
</script>

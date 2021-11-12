<template>
    <div class="col-sm-4" style="padding:0px">
        <img class="main-show"  :src="product_images[0]">
		<div class="col-sm-12 show-live">
            <button class = "btnImgLiveShow" v-for="(product_image,index) in product_images" :key="index" :data="product_image" onmouseover="showDetail(this)" onmouseout="outDetail(this)">
                <img class="image-viewer" v-bind:src="product_image">
            </button>
        </div>
    </div>
</template>

<script>
import axios from 'axios';
export default {
    props: {
        id : {type: Number}
    }
    ,data(){
        return {
            product_images : []
        }
    },
    mounted() {
        this.get_product_images();
    },
    methods:{
        get_product_images(){
            axios.get('/getproductimages/'+this.id).then(res => {
                this.product_images = res.data;
            });
        }
    }
}
</script>
<style scoped>
    .btnImgLiveShow {
        padding:0px;
        width: 24%;
        border:none;
    }
    .image-viewer{
        width:100%;
        height:100%;
        object-fit: cover;
    }
    .show-live{
        display:flex;
        justify-content : space-between;
        padding : 0px;
        padding-top: 10px;
    }
    .main-show{
        width: 100%;
        height: 60%; 
        object-fit: cover;
        border: 2px solid black;
    }
</style>


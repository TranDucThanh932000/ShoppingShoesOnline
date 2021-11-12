<template>
    <div class = "form-group">
        <div style ="padding:10px 0px">
            <h4 style="display : inline">Vui lòng chọn khu vực</h4>
            <button id = "close-form-muahang" onclick="close_form_muahang()"><span>x</span></button>
        </div>
        <select id="province" name="province_id" v-model = "province_id" class="form-control">
            <option value="null">Vui lòng chọn thành phố</option>
            <option v-for="province in provinces" :key="province.id" :value="province.id">{{province.name}}</option>
        </select>

        <select id="district" name="district_id" v-show="province_id != null" v-model = "district_id" class="form-control">
            <option value="null">Vui lòng chọn quận huyện</option>
            <option v-for="district in districts" :key="district.id" :value="district.id">{{district.name}}</option>
        </select>

        <select id="ward" name="ward_id" v-show="district_id != null" v-model = "ward_id" class="form-control">
            <option value="null">Vui lòng chọn phường xã</option>
            <option v-for="ward in wards" :key="ward.id" :value="ward.id">{{ward.name}}</option>
        </select>
    </div>
</template>

<script>
import axios from 'axios';
export default {
    data(){
        return {
            provinces : [],
            province_id : null,
            districts : [],
            district_id : null,
            wards : [],
            ward_id : null
        }
    },
    mounted(){
        this.getProvinces();
    },
    methods:{
        getProvinces(){
            axios.get('/location/provinces').then(res => {
                this.provinces = res.data;
            });
        },
        getDistricts(){
            axios.get('/location/province/'+ this.province_id+"/districts").then(res => {
                this.districts = res.data;
            })
        },
        getWards(){
            axios.get('/location/district/'+this.district_id+'/wards').then(res => {
                this.wards = res.data;
            })
        }
    },
    watch:{
        province_id(){
            this.getDistricts();
        },
        district_id(){
            this.getWards();
        }
    }
}
</script>
<style scoped>
    #close-form-muahang{
        float:right;
        margin-top: -5px;
    }

</style>

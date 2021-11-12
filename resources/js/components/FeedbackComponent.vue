<template>
  <div>
    <input
      type="number"
      style="visibility: hidden"
      name="product_id"
      :value="product_id"
    />

    <div v-if="userSession != ''" class="col-sm-12" style="margin-top:15px;margin-bottom:15px;">
        <button @click="starChoose(1)" class="star-rate star-default"><img v-bind:style="changeBackGr1" src="https://cdn3.iconfinder.com/data/icons/basic-user-interface-5/64/star_stars_space_shape_rate_rating_feedback-512.png" alt=""></button>
        <button @click="starChoose(2)" class="star-rate"><img v-bind:style="changeBackGr2" src="https://cdn3.iconfinder.com/data/icons/basic-user-interface-5/64/star_stars_space_shape_rate_rating_feedback-512.png" alt=""></button>
        <button @click="starChoose(3)" class="star-rate"><img v-bind:style="changeBackGr3" src="https://cdn3.iconfinder.com/data/icons/basic-user-interface-5/64/star_stars_space_shape_rate_rating_feedback-512.png" alt=""></button>
        <button @click="starChoose(4)" class="star-rate"><img v-bind:style="changeBackGr4" src="https://cdn3.iconfinder.com/data/icons/basic-user-interface-5/64/star_stars_space_shape_rate_rating_feedback-512.png" alt=""></button>
        <button @click="starChoose(5)" class="star-rate"><img v-bind:style="changeBackGr5" src="https://cdn3.iconfinder.com/data/icons/basic-user-interface-5/64/star_stars_space_shape_rate_rating_feedback-512.png" alt=""></button>
    </div>
    
    <textarea v-if="userSession != ''"
      name="feedback"
      id=""
      cols="30"
      rows="10"
      v-model="feedback" placeholder="Nhận xét sản phẩm"
    ></textarea>
    <button v-if="userSession != ''"
      class="btn btn-danger"
      @click="feedBack()"
      style="float: right;margin-top:5px;"
    >
      Gửi
    </button>
    <div class="col-sm-12" style="text-align:center;padding: 15px 0px;">
        <form action="/login" method="get">
            <input type="text" name="id" :value="product_id" style="visibility: hidden;">
            <button v-if="userSession == ''"
            class="btn btn-danger"
            >
            Đăng nhập để đánh giá sản phẩm
            </button>
        </form>
    </div>
    <div v-html="content" class="col-sm-12" style="padding-left:0px;padding-right:0px"></div>
    <div class="col-sm-12" style="margin-bottom: 20px;padding-right:0px;"  v-for="(fb, index) in listFeedback" :key="index" v-if="index < feedBacksToShow">
      <div class="col-sm-3">
        <img :src="fb.avatar" alt="" />
      </div>
      <div class="col-sm-9" style="height : 200px;">
        <h4>{{ fb.name }}</h4>
        <p>{{ fb.feedback }}</p>
        <p style="position:absolute;bottom :0px;right:0px;margin-bottom:0px;">
          <i>{{ fb.created_at }}</i>
        </p>
      </div>
    </div>
    <div class="col-sm-12 text-center" v-if="feedBacksToShow + 5 <= listFeedback.length">
        <button class="btn btn-primary" @click="feedBacksToShow += 5">Hiện thêm đánh giá</button>
    </div>
    <div class="col-sm-12 text-center" v-else-if="listFeedback.length % 5 != 0"> 
        <button class="btn btn-primary" v-bind:style="classHidden" @click="lastChild()">Hiện thêm đánh giá</button>
    </div>
  </div>
</template>

<script>
import axios from "axios";
export default {
  props: {
    id: Number,
  },
  data() {
    return {
      content: "",
      feedback: "",
      product_id: this.id,
      avatar_current : '',
      name_current : '',
      created_at : '',
      listFeedback: [],
      feedBacksToShow : 5,
      feedBackIndex : 0,
      classHidden:'',
      star : 1,
      changeBackGr1 : '',
      changeBackGr2 : '',
      changeBackGr3 : '',
      changeBackGr4 : '',
      changeBackGr5 : '',
      userSession : ''
    };
  },
  mounted() {
    this.getFeedbacks();
    this.getStar();
  },
  methods: {
    lastChild(){
        this.feedBacksToShow += (this.listFeedback.length % 5);
        this.classHidden = {
            display:'none'
        };
    },
    getFeedbacks() {
      axios.get("/feedback/" + this.id).then((res) => {
        this.listFeedback = res.data;
      });
    },
    feedBack() {
        axios
            .get(
            "/feedback?product_id=" +
                this.product_id +
                "&feedback=" +
                this.feedback+
                "&star="+
                this.star
            )
            .then((res) => {
                this.avatar_current = res.data.avatar;
                this.created_at = res.data.created_at;
                this.name_current = res.data.name;
                this.content =
                '<div class="col-sm-12" style="margin-bottom: 20px;padding-left:0px;padding-right:0px;">'+
                    '<div class="col-sm-3" style="padding-left: 0px;">'+
                        '<img src="'+this.avatar_current+'" style="width: 100%;height: 200px;object-fit: cover;border-radius: 5px;" alt="" />'+
                    '</div>'+
                    '<div class="col-sm-9" style="height: 200px;padding-left:0px;">'+
                        '<h4 style="margin-top: 0px;">'+this.name_current+'</h4>'+
                        '<p>'+this.feedback+'</p>'+
                        '<p style="position:absolute;bottom :0px;right:0px;margin-bottom:0px;">'+
                            '<i>'+this.created_at+'</i>'+
                        '</p>'+
                    '</div>'+
                '</div>'
                    +
                    this.content;
                this.feedback = '';
            });
    },
    starChoose(number){
        this.star = number;
        switch(number){
            case 1 : {
                this.star = 1;
                this.changeBackGr1 = {
                    backgroundColor : 'yellow'
                }
                this.changeBackGr2 = {
                    backgroundColor : 'white'
                }
                this.changeBackGr3 = {
                    backgroundColor : 'white'
                }
                this.changeBackGr4 = {
                    backgroundColor : 'white'
                }
                this.changeBackGr5 = {
                    backgroundColor : 'white'
                }
                break;
            }
            case 2 : {
                this.star = 2;
                this.changeBackGr1 = {
                    backgroundColor : 'yellow'
                }
                this.changeBackGr2 = {
                    backgroundColor : 'yellow'
                }
                this.changeBackGr3 = {
                    backgroundColor : 'white'
                }
                this.changeBackGr4 = {
                    backgroundColor : 'white'
                }
                this.changeBackGr5 = {
                    backgroundColor : 'white'
                }
                break;
            }
            case 3 : {
                this.star = 3;
                this.changeBackGr1 = {
                    backgroundColor : 'yellow'
                }
                this.changeBackGr2 = {
                    backgroundColor : 'yellow'
                }
                this.changeBackGr3 = {
                    backgroundColor : 'yellow'
                }
                this.changeBackGr4 = {
                    backgroundColor : 'white'
                }
                this.changeBackGr5 = {
                    backgroundColor : 'white'
                }
                break;
            }
            case 4 : {
                this.star = 4;
                this.changeBackGr1 = {
                    backgroundColor : 'yellow'
                }
                this.changeBackGr2 = {
                    backgroundColor : 'yellow'
                }
                this.changeBackGr3 = {
                    backgroundColor : 'yellow'
                }
                this.changeBackGr4 = {
                    backgroundColor : 'yellow'
                }
                this.changeBackGr5 = {
                    backgroundColor : 'white'
                }
                break;
            }
            case 5 : {
                this.star = 5;
                this.changeBackGr1 = {
                    backgroundColor : 'yellow'
                }
                this.changeBackGr2 = {
                    backgroundColor : 'yellow'
                }
                this.changeBackGr3 = {
                    backgroundColor : 'yellow'
                }
                this.changeBackGr4 = {
                    backgroundColor : 'yellow'
                }
                this.changeBackGr5 = {
                    backgroundColor : 'yellow'
                }
                break;
            }
        }
    },
    getStar(){
        axios.get('/get-star?product_id='+this.id)
        .then(res => {
            this.star = res.data.star;
            this.userSession = res.data.user;
            this.starChoose(this.star);
        })
    }
  },
};
</script>

<style scoped>
h4 {
  margin-top: 0px;
}
div {
  padding-left: 0px;
}
img {
  width: 100%;
  height: 200px;
  object-fit: cover;
  border-radius: 5px;
}
textarea{
    border: 2px solid black;
}

.star-rate {
    border: none;
}

.star-rate img {
    width: 30px;
    height:30px;
}
.star-default img{
    background-color: yellow;
}
</style>
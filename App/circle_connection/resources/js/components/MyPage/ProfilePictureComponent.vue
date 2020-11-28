<template>
  <modal name="profile-picture-modal" :resizable="true" :adaptive="true" width="90%">
    <div class="text-center mb-2">
      <img :src="'/storage/profile_picture/' + user.picture_url" class="profile">
    </div>
    <form @submit.prevent="upload">
      <div>

        <input @change="selectedFile" type="file" name="file">
        <button @click="upload" type="submit" >アップロード</button>
        <!-- TODO: 画像のトリミングを出来るようにしたい -->
        <!--        <vue-cropper  ref="cropper" :img="uploadFile"></vue-cropper>-->
      </div>
    </form>
  </modal>
</template>

<script>
/** @see https://github.com/Agontuk/vue-cropperjs */
// import VueCropper from 'vue-cropperjs';
// import 'cropperjs/dist/cropper.css';

export default {
  data() {
    return {
      isError: false,
      uploadFile: null,
      user: {}
    }
  },
  created() {
    axios.get('/api/me')
      .then((res) => {
        this.user = res.data;
      })
      .catch((error) => {
        console.log(error)
      });
  },
  methods: {
    selectedFile: function(e) {
      e.preventDefault();
      var files = e.target.files;
      this.uploadFile = files[0];
    },
    upload() {
      var formData = new FormData();
      formData.append('picture', this.uploadFile);
      var config = {
        headers: {
          'content-type': 'multiport/form-data'
        }
      };
      axios.post('/api/user/update_picture',formData, config)
        .then((res) => {
          console.log(res);
        }).catch((error) => {
        console.log(error);
      });
    }
  },
  // components: {
  // 	VueCropper
  // }
}
</script>

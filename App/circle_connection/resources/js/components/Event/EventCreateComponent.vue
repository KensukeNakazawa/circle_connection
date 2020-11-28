<template>
  <div class="">
    <form @submit.prevent='submit'>

      <div class="form-group row">
        <label for="title" class="col-md-4 col-form-label text-md-right">タイトル</label>
        <div class="col-md-6">
         <input id="title" type="text" class="form-control"
                required v-model="title">
        </div>
      </div>

      <div class="form-group row">
        <label for="content" class="col-md-4 col-form-label text-md-right">活動内容</label>
        <div class="col-md-6">
          <textarea id="content" class="form-control" required v-model="content"></textarea>
        </div>
      </div>

      <div class="form-group row">
        <label for="meeting_place" class="col-md-4 col-form-label text-md-right">集合場所</label>
        <div class="col-md-6">
          <input id="meeting_place" type="text" class="form-control"
                 required v-model="meeting_place">
        </div>
      </div>

      <div class="form-group row">
        <label for="place" class="col-md-4 col-form-label text-md-right">活動場所</label>
        <div class="col-md-6">
          <input id="place" type="text" class="form-control" required v-model="place">
        </div>
      </div>

      <div class="form-group row">
        <label for="start_time" class="col-md-4 col-form-label text-md-right">開始時間</label>
        <div class="col-md-6">
          <input id="start_time" type="datetime-local" class="form-control" required v-model="start_time">
        </div>
      </div>

      <div class="form-group row">
        <label for="end_time" class="col-md-4 col-form-label text-md-right">終了時間</label>
        <div class="col-md-6">
          <input id="end_time" type="datetime-local" class="form-control" required v-model="end_time">
        </div>
      </div>

      <div class="form-group row">
        <label for="number_of_person" class="col-md-4 col-form-label text-md-right">募集人数</label>
        <div class="col-md-6">
          <input id="number_of_person" type="number" class="form-control"
                 required v-model="number_of_persons">
        </div>
      </div>

      <div class="form-group row">
        <label for="fee" class="col-md-4 col-form-label text-md-right">参加費</label>
        <div class="col-md-6">
          <input id="fee" type="number" class="form-control" required v-model="fee">
        </div>
      </div>

      <div class="form-group">
        <button type="submit" class="btn btn-primary w-100">
            イベントを作成する
        </button>
      </div>

    </form>
  </div>
</template>

<script>
  export default {
    data () {
      return {
        user: {},
        circle_id: '',
        title: '',
        content: '',
        meeting_place: '',
        place : '',
        start_time: '',
        end_time: '',
        number_of_persons: '',
        fee: '',
        picture: '',
      };
    },
    created () {
      this.$store.commit("setLoading", true);
      axios.get('/api/me')
        .then((res) => {
          this.user = res.data;
        })
        .catch((error) => {
          this.isError = true;
        });
    },
    methods: {
        submit() {
          axios.post('/api/events', {
            circle_id: this.user.id,
            title: this.title,
            content: this.content,
            meeting_place: this.meeting_place,
            place: this.place,
            start_time: this.start_time,
            end_time: this.end_time,
            number_of_persons: this.number_of_persons,
            fee: this.fee
          }).then((res) => {
              this.$router.push({name: 'events'});
            })
            .catch(function (error) {
              console.log(error);
            });
        }
      }
  }
</script>>

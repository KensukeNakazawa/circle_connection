<template>
  <div class="card">
    <div class="card-body">
      <div class="card-title">
        {{ profile_user.name }}
      </div>
      <p class="card-text">{{ profile_user.grade }}</p>
      <p class="card-text">{{ profile_user.content }}</p>
      <p class="card-text">{{ profile_user.place }}</p>
      <router-link v-bind:to="{name: 'profiles.show', params: {profile_user_id: profile_user.id}}">
        <i class="card-link">プロフィールを見る</i>
      </router-link>
    </div>
  </div>
</template>

<script>
export default {
  props: ['profile_user']
}
</script>

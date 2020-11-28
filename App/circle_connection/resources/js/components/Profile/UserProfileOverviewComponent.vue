<template>
  <div class="card">
    <div class="card-body">
      <div class="card-title">
        {{ profile_user.name }}
      </div>
      <p class="card-text">{{ profile_user.grade }}</p>
      <p class="card-text">{{ profile_user.facalty }}</p>
      <p class="card-text">{{ profile_user.hometown }}</p>
      <p class="card-text">{{ profile_user.gender }}</p>
      <p class="card-text">{{ profile_user.picture_url }}</p>
      {{ profile_user.id }}
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

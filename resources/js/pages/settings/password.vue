<template>
  <card :title="$t('your_password')" class="mx-auto w-full md:w-1/2">
    <form @submit.prevent="update" @keydown="form.onKeydown($event)">
      <alert-success :form="form" :message="$t('password_updated')" />

      <!-- Password -->
      <div class="flex-between mb-3">
        <label for="password">{{ $t("new_password") }}</label>
        <div>
          <input
            v-model="form.password"
            :class="{ 'is-invalid': form.errors.has('password') }"
            class="input"
            type="password"
            name="password"
            id="password"
          />
          <Error :form="form" field="password" />
        </div>
      </div>

      <!-- Password Confirmation -->
      <div class="flex-between mb-3">
        <label for="password_confirmation">{{ $t("confirm_password") }}</label>
        <div class="col-md-7">
          <input
            v-model="form.password_confirmation"
            :class="{ 'is-invalid': form.errors.has('password_confirmation') }"
            class="input"
            type="password"
            id="password_confirmation"
            name="password_confirmation"
          />
          <Error :form="form" field="password_confirmation" />
        </div>
      </div>

      <!-- Submit Button -->
      <div class="flex-center">
        <v-button :loading="form.busy" type="success">
          {{ $t("update") }}
        </v-button>
      </div>
    </form>
  </card>
</template>

<script>
import Form from "vform";

export default {
  scrollToTop: false,

  metaInfo() {
    return { title: this.$t("settings") };
  },

  data: () => ({
    form: new Form({
      password: "",
      password_confirmation: ""
    })
  }),

  methods: {
    async update() {
      await this.form.patch("/api/settings/password");

      this.form.reset();
    }
  }
};
</script>

<template>
  <card :title="$t('your_info')" class="mx-auto w-full md:w-1/2">
    <form @submit.prevent="update" @keydown="form.onKeydown($event)">
      <alert-success :form="form" :message="$t('info_updated')" />

      <!-- Name -->
      <div class="flex-between mb-3">
        <label for="name">{{
          $t("name")
        }}</label>
        <div class="col-md-7">
          <input
            v-model="form.name"
            :class="{ 'is-invalid': form.errors.has('name') }"
            class="input"
            type="text"
            id="name"
            name="name"
          />
          <Error :form="form" field="name" />
        </div>
      </div>

      <!-- Email -->
      <div class="flex-between mb-3">
        <label for="email">{{
          $t("email")
        }}</label>
        <div class="col-md-7">
          <input
            v-model="form.email"
            :class="{ 'is-invalid': form.errors.has('email') }"
            class="input"
            type="email"
            id="email"
            name="email"
          />
          <Error :form="form" field="email" />
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
import { mapGetters } from "vuex";

export default {
  scrollToTop: false,

  metaInfo() {
    return { title: this.$t("settings") };
  },

  data: () => ({
    form: new Form({
      name: "",
      email: ""
    })
  }),

  computed: mapGetters({
    user: "auth/user"
  }),

  created() {
    // Fill the form with user data.
    this.form.keys().forEach(key => {
      this.form[key] = this.user[key];
    });
  },

  methods: {
    async update() {
      const { data } = await this.form.patch("/api/settings/profile");

      this.$store.dispatch("auth/updateUser", { user: data });
    }
  }
};
</script>

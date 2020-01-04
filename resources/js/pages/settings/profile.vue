<template>
  <card :title="$t('your_info')" class="mx-auto w-full md:w-1/2">
    <form @submit.prevent="update" @keydown="form.onKeydown($event)">
      <alert-success :form="form" :message="$t('info_updated')" />

      <!-- Name -->
      <div class="flex-between mb-3">
        <label class="text-body sm:mr-3" for="first_name">{{
          $t("first_name")
        }}</label>
        <div>
          <input
            v-model="form.firstName"
            :class="{ 'is-invalid': form.errors.has('firstName') }"
            class="input"
            type="text"
            id="first_name"
            name="firstName"
          />
          <Error :form="form" field="firstName" />
        </div>
      </div>
      <div class="flex-between mb-3">
        <label class="text-body sm:mr-3" for="last_name">{{
          $t("last_name")
        }}</label>
        <div>
          <input
            v-model="form.lastName"
            :class="{ 'is-invalid': form.errors.has('lastName') }"
            class="input"
            type="text"
            id="last_name"
            name="lastName"
          />
          <Error :form="form" field="lastName" />
        </div>
      </div>

      <!-- Email -->
      <div class="flex-between mb-3">
        <label class="text-body sm:mr-3" for="email">{{ $t("email") }}</label>
        <div>
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
        <Button primary :loading="form.busy">
          {{ $t("update") }}
        </Button>
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
      lastName: "",
      firstName: "",
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

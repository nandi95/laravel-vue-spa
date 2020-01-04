<template>
  <card :title="$t('your_password')" class="mx-auto w-full md:w-1/2">
    <form @submit.prevent="update" @keydown="form.onKeydown($event)">
      <alert-success :form="form" :message="$t('password_updated')" />

      <!-- Old Password -->
      <div class="flex-between mb-3">
        <label class="text-body sm:mr-3">{{ $t("old_password") }}</label>
        <div>
          <PasswordField
            :custom-class="
              'input' + (form.errors.has('oldPassword') ? ' is-invalid' : '')
            "
            v-model="form.oldPassword"
            name-id="old_password"
          />
          <Error :form="form" field="oldPassword" />
        </div>
      </div>

      <!-- Password -->
      <div class="flex-between mb-3">
        <label class="text-body sm:mr-3">{{ $t("new_password") }}</label>
        <div>
          <PasswordField
            :custom-class="
              'input' + (form.errors.has('password') ? ' is-invalid' : '')
            "
            v-model="form.password"
            name-id="password"
          />
          <Error :form="form" field="password" />
        </div>
      </div>

      <!-- Password Confirmation -->
      <div class="flex-between mb-3">
        <label class="text-body sm:mr-3" for="password_confirmation">{{
          $t("confirm_password")
        }}</label>
        <div>
          <PasswordField
            :custom-class="
              'input' +
                (form.errors.has('password_confirmation') ? ' is-invalid' : '')
            "
            v-model="form.password_confirmation"
            name-id="password_confirmation"
          />
          <Error :form="form" field="password_confirmation" />
        </div>
      </div>

      <!-- Submit Button -->
      <div class="flex-center">
        <Button primary :loading="form.busy" type="success">
          {{ $t("update") }}
        </Button>
      </div>
    </form>
  </card>
</template>

<script>
import Form from "vform";
import PasswordField from "../../components/PasswordField";

export default {
  components: { PasswordField },
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

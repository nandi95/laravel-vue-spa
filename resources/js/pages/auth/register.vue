<template>
  <div class="row">
    <div class="col-lg-8 m-auto">
      <card :title="$t('register')">
        <div v-if="mustVerifyEmail" class="alert alert-success" role="alert">
          {{ $t("verify_email_address") }}
        </div>
        <form
          v-else
          @submit.prevent="register"
          @keydown="form.onKeydown($event)"
        >
          <!-- Name -->
          <div class="flex-between mb-3">
            <label for="first_name">{{ $t("first_name") }}</label>
            <div>
              <input
                v-model="form.firstName"
                :class="{ 'is-invalid': form.errors.has('firstName') }"
                class="input"
                type="text"
                name="first_name"
                id="first_name"
              />
              <Error :form="form" field="first_name" />
            </div>
          </div>
          <div class="flex-between mb-3">
            <label for="last_name">{{ $t("last_name") }}</label>
            <div>
              <input
                v-model="form.lastName"
                :class="{ 'is-invalid': form.errors.has('lastName') }"
                class="input"
                type="text"
                name="last_name"
                id="last_name"
              />
              <Error :form="form" field="last_name" />
            </div>
          </div>

          <!-- Email -->
          <div class="flex-between mb-3">
            <label for="email">{{ $t("email") }}</label>
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

          <!-- Password -->
          <div class="flex-between mb-3">
            <label for="password">{{ $t("password") }}</label>
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
            <label for="password_confirmation">{{
              $t("confirm_password")
            }}</label>
            <div>
              <input
                v-model="form.password_confirmation"
                :class="{
                  'is-invalid': form.errors.has('password_confirmation')
                }"
                class="input"
                type="password"
                name="password_confirmation"
                id="password_confirmation"
              />
              <Error :form="form" field="password_confirmation" />
            </div>
          </div>

          <div class="flex-between">
            <!-- Submit Button -->
            <Button :loading="form.busy">
              {{ $t("register") }}
            </Button>

            <!-- GitHub Register Button -->
            <login-with-github />
          </div>
        </form>
      </card>
    </div>
  </div>
</template>

<script>
import Form from "vform";
import LoginWithGithub from "~/components/LoginWithGithub";

export default {
  middleware: "guest",

  components: {
    LoginWithGithub
  },

  metaInfo() {
    return { title: this.$t("register") };
  },

  data: () => ({
    form: new Form({
      firstName: "",
      lastName: "",
      email: "",
      password: "",
      password_confirmation: ""
    }),
    mustVerifyEmail: false
  }),

  methods: {
    async register() {
      // Register the user.
      const { data } = await this.form.post("/api/register");

      // Must verify email fist.
      if (data.status) {
        this.mustVerifyEmail = true;
      } else {
        // Log in the user.
        const {
          data: { token }
        } = await this.form.post("/api/login");

        // Save the token.
        this.$store.dispatch("auth/saveToken", { token });

        // Update the user.
        await this.$store.dispatch("auth/updateUser", { user: data });

        // Redirect home.
        this.$router.push({ name: "home" });
      }
    }
  }
};
</script>

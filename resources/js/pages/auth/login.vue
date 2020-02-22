<template>
  <div class="flex-center">
    <div class="w-8/12">
      <card :title="$t('login')">
        <form @submit.prevent="login" @keydown="form.onKeydown($event)">
          <!-- Email -->
          <div class="flex-between mb-3">
            <label class="w-3/12">{{ $t("email") }}</label>
            <div class="w-7/12">
              <input
                v-model="form.email"
                :class="{ 'is-invalid': form.errors.has('email') }"
                class="input"
                type="email"
                name="email"
              />
              <Error :form="form" field="email" />
            </div>
          </div>

          <!-- Password -->
          <div class="flex-between mb-3">
            <label class="w-3/12">{{ $t("password") }}</label>
            <div class="w-7/12">
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

          <!-- Remember Me -->
          <div class="flex-between w-full mb-3">
            <checkbox v-model="remember" name="remember">
              {{ $t("remember_me") }}
            </checkbox>

            <router-link
              :to="{ name: 'password.request' }"
              class="small ml-auto my-auto"
            >
              {{ $t("forgot_password") }}
            </router-link>
          </div>

          <div class="flex-around">
            <!-- Submit Button -->
            <Button primary :loading="form.busy">
              {{ $t("login") }}
            </Button>

            <!-- GitHub Login Button -->
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
import PasswordField from "../../components/PasswordField";

export default {
  middleware: "guest",
  components: {
    PasswordField,
    LoginWithGithub
  },
  metaInfo() {
    return { title: this.$t("login") };
  },
  data: () => ({
    form: new Form({
      email: "",
      password: ""
    }),
    remember: false
  }),
  methods: {
    async login() {
      // Submit the form.
      const { data } = await this.form.post("/api/login");

      // Save the token.
      this.$store.dispatch("auth/saveToken", {
        token: data.token,
        remember: this.remember
      });

      // Fetch the user.
      await this.$store.dispatch("auth/fetchUser");

      // Login successful, redirect to where user came from, or home.
      let route = { name: "home" };
      if (this.$store.getters["auth/hasPreLoginRoute"]) {
        route = this.$store.state.auth.preLoginRoute;
        this.$store.dispatch("auth/setPreLoginRoute", null);
      }
      this.$router.push(route);
    }
  }
};
</script>
